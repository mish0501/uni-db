<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CurrencyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CurrencyType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CurrencyType whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CurrencyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CurrencyType whereUpdatedAt($value)
 */
class CurrencyType extends Model
{
    use HasFactory;

    const USD = 1;
    const EUR = 2;
    const GBP = 3;
    const JPY = 4;
    const BGN = 5;

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
