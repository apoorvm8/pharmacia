<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('retailerName', 60);
            $table->string('shopName', 60);
            $table->string('email');
            $table->string('password');
            $table->string('mobileNo', 10)->unique();
            $table->string('otp', 6)->nullable();
            $table->string('fireBaseToken')->nullable();
            $table->boolean('isVerified')->default(0);
            $table->smallInteger('verificationStatus')->default(0);
            $table->string('gstNo', 20)->nullable();
            $table->string('gstNoImage', 255)->nullable();
            $table->string('drugNo', 100)->nullable();
            $table->string('drugNoImage', 255)->nullable();
            $table->smallInteger('gstVerificationStatus')->default(0);
            $table->smallInteger('drugVerificationStatus')->default(0);
            $table->boolean('userBlacklist')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
