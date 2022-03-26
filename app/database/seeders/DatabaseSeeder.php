<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\Client;
use App\Models\CurrencyType;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $myUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $clientUsers = User::factory(10)->create();
        $clientUsers->add($myUser);

        $employeeUsers = User::factory(10)->create();
        $employeeUsers->add($myUser);

        $this->call([
            PositionSeeder::class,
            TransactionTypeSeeder::class,
            CurrencySeeder::class,
        ]);

        $currencyTypes = CurrencyType::all();
        $transactionTypes = TransactionType::all();
        $positions = Position::all();

        $employees = Employee::factory(10)
            ->state(new Sequence(
                fn ($sequence) => [
                    'user_id' => $employeeUsers->get($sequence->index)->id,
                    'position_id' => $positions->random()->id,
                ]
            ))
            ->create();

        $clients = Client::factory(10)
            ->state(new Sequence(
                fn ($sequence) => [
                    'user_id' => $clientUsers->get($sequence->index)->id,
                ]
            ))
            ->create();

        $bankAccounts = BankAccount::factory(10)
            ->state(new Sequence(
                fn ($sequence) => [
                    'client_id' => $clients->get($sequence->index)->id,
                    'currency_type_id' => $currencyTypes->random()->id,
                ]
            ))
            ->create();

        Transaction::factory(100)
            ->state(new Sequence(
                fn () => [
                    'bank_account_id' => $bankAccounts->random()->id,
                    'transaction_type_id' => $transactionTypes->random()->id,
                    'currency_type_id' => $currencyTypes->random()->id,
                    'employee_id' => $employees->random()->id,
                ]
            ))
            ->create();
    }
}
