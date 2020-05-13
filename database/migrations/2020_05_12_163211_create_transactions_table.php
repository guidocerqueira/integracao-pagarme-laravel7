<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
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
            $table->integer('transaction_code');
            $table->foreignId('user_id');
            $table->string('status');
            $table->string('authorization_code')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('authorized_amount')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->integer('refunded_amount')->nullable();
            $table->integer('installments')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('subscription_code')->nullable();
            $table->string('postback_url')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_last_digits')->nullable();
            $table->string('card_first_digits')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('boleto_url')->nullable();
            $table->string('boleto_barcode')->nullable();
            $table->dateTime('boleto_expiration_date')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
}
