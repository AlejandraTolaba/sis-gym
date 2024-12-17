<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('dni',8);
            $table->date('birthdate');
            $table->string('gender',1);
            $table->string('address');
            $table->string('phone_number');
            $table->string('contact_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->boolean('certificate')->default(false);
            $table->date('certificate_date')->nullable();
            $table->string('observations')->nullable();
            // $table->date('discharge_date');
            $table->string('state',10)->default('activo');
            $table->float('balance')->default(0);
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
        Schema::dropIfExists('students');
    }
}
