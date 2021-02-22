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
})->middleware('guest');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/users', 'web\UserController@users');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', 'Web\UserController@users')->name('data.users');
    Route::resource('product', 'Web\ProductController');
    // Route::get('/products', 'Web\ProductController@index')->name('product.index');
    // Route::post('/products', 'Web\ProductController@store')->name('product.store');
    // Route::get('/produk/{id}', 'Web\ProductController@show')->name('product.show');
    // Route::post('/products/update', 'Web\ProductController@update')->name('product.update');
});
