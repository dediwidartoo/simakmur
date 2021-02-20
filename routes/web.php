<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/users', 'web\UserController@users');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/users', 'Web\UserController@users')->name('users');
    Route::get('/products', 'Web\ProductController@index')->name('product.index');
    Route::post('/products', 'Web\ProductController@toko')->name('product.toko');
    Route::get('/produk/{id}', 'Web\ProductController@show')->name('product.show');
    Route::post('/products/update', 'Web\ProductController@update')->name('product.update');
});