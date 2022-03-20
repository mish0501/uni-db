<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionType::insert(
            [
                ['name' => 'ATM'],
                ['name' => 'Charge'],
                ['name' => 'Check'],
                ['name' => 'Deposit'],
                ['name' => 'Online'],
                ['name' => 'POS'],
                ['name' => 'Transfer'],
                ['name' => 'Withdrawal']
            ]
        );
    }
}
