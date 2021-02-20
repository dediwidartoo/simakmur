<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users','Api\UserController@users');
Route::get('user/{id}','Api\UserController@user');

Route::post('auth/login','Api\UserController@login');
Route::post('auth/register','Api\UserController@register');

Route::post('auth/update/{iduser}','Api\UserController@updateUser');
Route::get('auth/logout/{iduser}','Api\UserController@logout');

Route::get('produk','Api\ProdukController@produk');
Route::get('produk/{id}','Api\ProdukController@produkid');

Route::post('transaksi','Api\TransactionController@toko');
Route::get('transaksi-user/{userId}/{status?}','Api\TransactionController@userTransaction');
Route::get('transaksi/{code}','Api\TransactionController@byCode');
Route::post('upload/{code}','Api\TransactionController@upload');