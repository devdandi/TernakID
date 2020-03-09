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

Route::post('/daftar', 'ApiController@daftar_user');
Route::post('/login', 'ApiController@login_user');
Route::get('/product', 'ApiController@product');
// Route::post('/search', 'ApiController@search_product');
Route::post('/daftar-kios', 'ApiController@daftar_kios');

