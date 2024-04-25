<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('registration_date');
            $table->date('expiration_date');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('method_of_payment_id');
            $table->integer('classes');
            $table->float('amount');
            $table->float('balance');
            $table->string('state')->default('activa');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('method_of_payment_id')->references('id')->on('methods_of_payment');
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
        Schema::dropIfExists('inscriptions');
    }
}
