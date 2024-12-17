<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionMethodOfPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscription_method_of_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inscription_id');
            $table->unsignedBigInteger('method_of_payment_id');
            $table->float('amount');
            $table->timestamps();
            $table->foreign('inscription_id')->references('id')->on('inscriptions');
            $table->foreign('method_of_payment_id')->references('id')->on('methods_of_payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscription_method_of_payment');
    }
}
