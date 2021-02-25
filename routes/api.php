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
//user
Route::get('users','Api\UsersApiController@users');
Route::get('user/{id}','Api\UsersApiController@user');

Route::post('auth/login','Api\UsersApiController@login');
Route::post('auth/register','Api\UsersApiController@register');

Route::post('auth/update/{iduser}','Api\UsersApiController@updateUser');
Route::get('auth/logout/{iduser}','Api\UsersApiController@logout');

//produk
Route::get('produk','Api\ProdukController@produk');
Route::get('produk/{id}','Api\ProdukController@product');

//transaksi
Route::get('transaksi','Api\TransactionApiController@index');
Route::post('transaksi','Api\TransactionApiController@store');
Route::get('transaksi/{code}','Api\TransactionApiController@detail');
Route::get('transaksi-user/{iduser}/{status?}','Api\TransactionApiController@byUser');

Route::post('upload/{code}','Api\TransactionApiController@upload');
Route::get('notification/{userid}','Api\NotificationApiController@byUser');