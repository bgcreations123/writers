<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpesaStkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_stk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MerchantRequestID')->nullable();
            $table->string('CheckoutRequestID')->nullable();
            $table->string('ResultCode')->nullable();
            $table->string('ResultDesc')->nullable();
            $table->string('Amount')->nullable();
            $table->string('MpesaReceiptNumber')->nullable();
            $table->string('TransactionDate')->nullable();
            $table->string('PhoneNumber')->nullable();
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
        Schema::dropIfExists('mpesa_stk');
    }
}
