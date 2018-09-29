<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::domain('{mobile}.pharmacia.me')->group(function() {
    Route::prefix('api')->group(function() {
        Route::post('/register', 'PassportController@register')->name('api.register');
        Route::post('/verifyOtp', 'OtpController@verifyOtp')->name('api.verifyOtp');
        Route::post('/login', 'PassportController@login')->name('api.login');
        Route::post('/refresh', 'PassportController@refresh')->name('api.refresh');
        Route::post('/logout', 'PassportController@logout')->middleware('auth:api');
        Route::get('/redirect/{service}', 'PassportController@redirect');
        Route::get('/callback/{service}', 'PassportController@callback');
        
        Route::put('/changePassword', 'PassportController@changePassword')->middleware('auth:api');
        Route::post('/forgotPasswordPartOne', 'PassportController@forgotPasswordPartOne')->name('api.forgotPassword.mobile');
        Route::post('/forgotPasswordPartTwo', 'PassportController@forgotPasswordPartTwo')->name('api.forgotPassword.otp');
        Route::put('/forgotPasswordPartThree', 'PassportController@forgotPasswordPartThree')->name('api.forgotPassword');
        Route::get('/getDetail', 'PassportController@getDetail')->middleware('auth:api');
        Route::get('/getAllMedicines', 'PassportUsersController@getAllMedicines');
        Route::get('/getSingleMedicine/{id}', 'PassportUsersController@getSingleMedicine');

        // Api for the Gst and Drug
        Route::put('/users/gstDrug', 'PassportUsersController@uploadGstDrug')->middleware('auth:api');  
        // Route::put('/users/gstDrug', 'PassportUsersController@uploadGstDrug');

        // Orders
        Route::post('/order', 'PassportUsersController@order');
    }); 
});





