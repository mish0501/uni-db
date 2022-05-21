<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $position_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Position $position
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereUserId($value)
 * @mixin \Eloquent
 * @package App\Models
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'position_id',
    ];

    protected $appends = ['bank_accounts'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'employee_id');
    }

    public function bankAccounts(): Attribute
    {
        return new Attribute(
            get: fn () => BankAccount::join('transactions', 'transactions.bank_account_id', '=', 'bank_accounts.id')
                ->where('transactions.employee_id', $this->id)
                ->select('bank_accounts.*')
                ->groupBy('bank_accounts.id')
                ->with('currencyType')
                ->with('client.user:id,name')
                ->get()

        );
    }
}
