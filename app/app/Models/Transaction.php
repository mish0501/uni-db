<?php

namespace App\Models;

use App\Services\BankAccountsService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_account_id',
        'transaction_type_id',
        'currency_type_id',
        'value',
        'employee_id',
    ];

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => BankAccountsService::formatCash($value, $this->currencyType()->first()),
        );
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function currencyType()
    {
        return $this->belongsTo(CurrencyType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
