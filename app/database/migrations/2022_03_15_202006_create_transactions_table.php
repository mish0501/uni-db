<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 10,  2);
            $table->foreignId('currency_type_id')->references('id')->on('currency_types');
            $table->foreignId('bank_account_id')->references('id')->on('bank_accounts');
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->foreignId('transaction_type_id')->references('id')->on('transaction_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
