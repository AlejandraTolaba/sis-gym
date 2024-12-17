<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('dni',8);
            $table->string('photo')->nullable();
            $table->date('birthdate');
            $table->string('gender',1);
            $table->string('address');
            $table->string('phone_number');
            $table->string('contact_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('state',10)->default('activo');
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
        Schema::dropIfExists('teachers');
    }
}
