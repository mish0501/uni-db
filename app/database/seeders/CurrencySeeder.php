<?php

namespace Database\Seeders;

use App\Models\CurrencyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrencyType::insert(
            [
                [
                    'name' => 'USD',
                    'symbol' => '$',
                ],
                [
                    'name' => 'EUR',
                    'symbol' => '€',
                ],
                [
                    'name' => 'GBP',
                    'symbol' => '£',
                ],
                [
                    'name' => 'JPY',
                    'symbol' => '¥',
                ],
                [
                    'name' => 'BGN',
                    'symbol' => 'лв',
                ]
            ]
        );
    }
}
