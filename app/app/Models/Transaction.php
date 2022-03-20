<?php

namespace App\Models;

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
