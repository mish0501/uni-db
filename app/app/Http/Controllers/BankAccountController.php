<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\Client;
use App\Models\CurrencyType;
use App\Services\BankAccountsService;
use Inertia\Inertia;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('BankAccounts/Index', [
            'bankAccounts' => BankAccountsService::getBankAccounts(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('BankAccounts/Create', [
            'clients' => Client::with('user')->get(),
            'currencyTypes' => CurrencyType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankAccountRequest $request)
    {
        return BankAccountsService::storeBankAccount($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        return Inertia::render('BankAccounts/Show', [
            'bankAccount' => $bankAccount->load([
                'transactions.transactionType',
                'transactions.employee.user',
                'client.user:id,name'
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        return Inertia::render('BankAccounts/Edit', [
            'bankAccount' => $bankAccount->load('client.user', 'currencyType'),
            'clients' => Client::with('user')->get(),
            'currencyTypes' => CurrencyType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankAccountRequest  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        return BankAccountsService::updateBankAccount($request, $bankAccount);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        return BankAccountsService::deleteBankAccount($bankAccount);
    }
}
