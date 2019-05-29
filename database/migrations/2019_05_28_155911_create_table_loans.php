<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLoans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('member_id')->unsigned();
            $table->double('amount', 13, 2);
            $table->double('monthly_repayment_amount', 13,2);
            $table->integer('repayment_period');
            $table->integer('status')->default(1);
            $table->string('serial_number');

            // Bank details
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('bank_account_name');
            $table->string('bank_account_number');

            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
