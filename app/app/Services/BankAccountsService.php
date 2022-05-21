<?php

namespace App\Services;

use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use App\Models\CurrencyType;
use Exception;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BankAccountsService
{
    public static function getBankAccounts()
    {
        return BankAccount::with('client.user')
            ->with('currencyType:id,symbol')
            ->get();
    }

    public static function storeBankAccount(StoreBankAccountRequest $request)
    {
        try {
            DB::beginTransaction();

            $bankAccount = BankAccount::factory()
                ->state([
                    'client_id' => $request->client_id,
                    'currency_type_id' => $request->currency_type_id,
                    'interest_percentage' => $request->interest_percentage,
                    'cash' => 0,
                ])
                ->createOne();

            if ($bankAccount) {
                DB::commit();

                return Redirect::route('bankAccounts.index')
                    ->with('message', 'BankAccount created successfully')
                    ->with('type', 'success');
            }

            throw new Exception('BankAccount creation failed');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::route('bankAccounts.index')
                ->with('message', $e)
                ->with('type', 'error');
        }
    }

    public static function updateBankAccount(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        try {
            DB::beginTransaction();

            $bankAccount->update($request->validated());

            DB::commit();

            return Redirect::route('bankAccounts.index')
                ->with('message', 'BankAccount updated successfully')
                ->with('type', 'success');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::back()
                ->with('message', 'BankAccount update failed')
                ->with('type', 'error');
        }
    }

    public static function deleteBankAccount(BankAccount $bankAccount)
    {
        try {
            DB::beginTransaction();

            $bankAccount->delete();

            DB::commit();

            return Redirect::route('bankAccounts.index')
                ->with('message', 'BankAccount deleted successfully')
                ->with('type', 'success');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::route('bankAccounts.index')
                ->with('message', 'BankAccount delete failed')
                ->with('type', 'error');
        }
    }

    // UTIL

    public static function maskAccountNumber($accountNumber)
    {
        return substr($accountNumber, 0, -12) . '************';
    }

    public static function formatCash($cash, CurrencyType $currencyType)
    {
        if (strpos($cash, '-') == 0) {
            $minus = '- ';
            $cash = substr($cash, 1);
        }
        switch ($currencyType->id) {
            case CurrencyType::USD:
            case CurrencyType::EUR:
            case CurrencyType::GBP:
            case CurrencyType::JPY:
                return $minus . $currencyType->symbol . number_format($cash, 2);
            case CurrencyType::BGN:
                return $minus . number_format($cash, 2, ',', ' ') . ' ' . $currencyType->symbol;
            default:
                return $cash;
        }
    }
}
