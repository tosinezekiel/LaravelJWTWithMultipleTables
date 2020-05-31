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


Route::post('/login','UserController@login')->name('login');;
Route::post('/adminlogin','AdminController@login')->name('adminlogin');;
// Route::get('/products','ProductController@index');

Route::group(['middleware' => ['auth:users','jwt.auth']], function () {
    Route::get('/products','ProductController@index');
});

Route::group(['middleware' => ['auth:admins','jwt.auth']], function () {
    Route::get('/investments','InvestmentController@index');
});

Route::group(['middleware' => ['auth:users','jwt.auth']], function () {
    Route::get('/loguser','UserController@getUser');
});
