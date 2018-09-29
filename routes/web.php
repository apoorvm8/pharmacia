<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain('{admin}.pharmacia.me')->group(function() {
    Route::get('/home','AdminController@index')->name('admin.dashboard');
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    //The controller for the medicine 
    Route::prefix('medicine')->group(function() {
        Route::get('/view', 'MedicineController@index')->name('medicine.view');
        Route::get('/add', 'MedicineController@create')->name('medicine.add');
        Route::get('/edit/{id}', 'MedicineController@edit')->name('medicine.edit');
        Route::get('/delete', 'MedicineController@showDeleteView')->name('medicine.deleteView');
        Route::get('/detail/{id}', 'MedicineController@show')->name('medicine.detail');

        Route::post('/add', 'MedicineController@store')->name('medicine.add.submit');
        Route::put('/edit/{id}', 'MedicineController@update')->name('medicine.edit.submit');
        Route::delete('/delete/{id}', 'MedicineController@destroy')->name('medicine.delete.submit');
    });

    //The controller for the content
    Route::prefix('content')->group(function() {
        Route::get('/view', 'ContentController@index')->name('content.view');
        Route::get('/add', 'ContentController@create')->name('content.add');
        Route::get('/edit/{id}', 'ContentController@edit')->name('content.edit');  
        Route::get('/delete', 'ContentController@showDeleteView')->name('content.deleteView');    
        Route::get('/detail/{id}', 'ContentController@contentDetail')->name('content.detail');

        Route::post('/add', 'ContentController@store')->name('content.add.submit');
        Route::put('/edit/{id}', 'ContentController@update')->name('content.edit.submit');
        Route::delete('/delete/{id}', 'ContentController@destroy')->name('content.delete.submit');
    });

    // The controller for the medicine articles
    Route::prefix('article')->group(function() {
        Route::get('/view', 'ArticlesController@index')->name('article.view');
        Route::get('/add', 'ArticlesController@create')->name('article.add');
        Route::get('/edit/{id}', 'ArticlesController@edit')->name('article.edit');  
        Route::get('/delete', 'ArticlesController@showDeleteView')->name('article.deleteView');
        Route::get('/detail/{id}', 'ArticlesController@show')->name('article.detail');

        Route::post('/add', 'ArticlesController@store')->name('article.add.submit');
        Route::post('/view', 'ArticlesController@articleType')->name('article.type.submit');
        Route::put('/edit/{id}', 'ArticlesController@update')->name('article.edit.submit');
        Route::put('/detail/{id}', 'ArticlesController@disable')->name('article.disable.submit');
        Route::delete('/delete/{id}', 'ArticlesController@destroy')->name('article.delete.submit');
    
    });

    // The controller for the Users
    Route::prefix('users')->group(function() {
        Route::get('/verified', 'UsersController@verifiedUsers')->name('users.verified');
        Route::get('/unverified', 'UsersController@unverifiedUsers')->name('users.unverified');
        Route::get('/intermediate', 'UsersController@intermediateUsers')->name('users.intermediate');
        Route::get('/blacklist', 'UsersController@blacklistUsers')->name('users.blacklist');
        Route::get('/orders/{id}', 'UsersController@userOrders')->name('users.order');   
        // PUT
        Route::put('/unverified', 'UsersController@findUnverifiedUpdate')->name('users.unverified.update');
       
        // Route::put('/verified', 'UsersController')
    });

    // The controller for the Orders
    Route::prefix('orders')->group(function() {
        Route::get('/byVerified', 'OrdersController@byVerifiedUsers')->name('orders.byVerified');
        Route::get('/byUnverified', 'OrdersController@byUnverifiedUsers')->name('orders.byUnverified');
        Route::get('/byIntermediate', 'OrdersController@byIntermediateUsers')->name('orders.byIntermediate');
        Route::get('/detail/{id}', 'OrdersController@show')->name('orders.detail');
    });
});

Route::get('/', 'PagesController@index');
Route::post('/', 'PagesController@index_email')->name('email.submit');
Auth::routes();

// Routes for the admin



Route::get('/home', 'HomeController@index')->name('home');

