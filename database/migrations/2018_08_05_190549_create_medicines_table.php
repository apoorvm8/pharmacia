<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medicineName', 80);
            $table->string('manufacturer', 80);
            $table->string('medicineType', 80);
            $table->string('remark', 100)->nullable();
            $table->string('medicineContent', 80);
            $table->double('cost', 10, 2);
            $table->double('discount', 10, 2)->default(0)->nullable();
            $table->integer('stock');
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
        Schema::dropIfExists('medicines');
    }
}
