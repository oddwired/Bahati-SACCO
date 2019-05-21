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

Route::get('/', function () {
    return view('welcome');
});

/* Password reset routes */

Route::get('/password-reset/{reset_code}', "Auth\ResetPasswordController@index");
Route::post('/password-reset/{reset_code}', "Auth\ResetPasswordController@reset");

/* ADMIN routes */

Route::group(["prefix"=> "admin", "middleware"=> ["auth.admin"]], function(){

    /* Auth routes */

    Route::get('login', "Auth\Admin\AuthController@index");
    Route::post('login', "Auth\Admin\AuthController@login");
    Route::get('logout', "Auth\Admin\AuthController@logout");
});

/*MEMBER routes*/

Route::group(["prefix"=> "member", "middleware"=> ["auth.member"]], function(){

    /* Auth routes */

    Route::get('login', "Auth\Member\AuthController@index");
    Route::post('login', "Auth\Member\AuthController@login");
    Route::get('logout', "Auth\Member\AuthController@logout");

});

/*CONDUCTOR routes*/

Route::group(["prefix"=> "conductor", "middleware"=> ["auth.conductor"]], function(){

    /* Auth routes */

    Route::get('login', "Auth\Conductor\AuthController@index");
    Route::post('login', "Auth\Conductor\AuthController@login");
    Route::get('logout', "Auth\Conductor\AuthController@logout");
});