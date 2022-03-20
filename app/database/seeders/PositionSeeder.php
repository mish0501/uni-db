<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::insert(
            [
                ['name' => 'Financial Analyst'],
                ['name' => 'Personal Financial Adviser'],
                ['name' => 'Relationship Manager'],
                ['name' => 'Accountant'],
                ['name' => 'Auditor'],
                ['name' => 'Branch Manager'],
                ['name' => 'Loan Officer'],
                ['name' => 'Bank Teller'],
                ['name' => 'Treasurer'],
            ]
        );
    }
}
