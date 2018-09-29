<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userId');
            $table->foreign('userId')->references('id')->on('users');
            $table->mediumText('houseNo');
            $table->mediumText('streetName');
            $table->string('city', 150);
            $table->string('state', 150);
            $table->string('pincode', 6);
            $table->string('landmark', 255)->nullable();    
            $table->double("totalAmount", 10, 2)->default(0);
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
        Schema::dropIfExists('orders');
    }
}
