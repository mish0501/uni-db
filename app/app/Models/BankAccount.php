<?php

namespace App\Models;

use App\Services\BankAccountsService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number', 'interest_percentage', 'cash', 'currency_type_id', 'client_id',
    ];

    protected function accountNumber(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => BankAccountsService::maskAccountNumber($value),
        );
    }

    protected function cash(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => BankAccountsService::formatCash($value, $this->currencyType()->first()),
        );
    }

    public function currencyType()
    {
        return $this->belongsTo(CurrencyType::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($bakAccount) {
            $bakAccount->transactions()->each(function ($transaction) {
                $transaction->delete();
            });
        });
    }
}
