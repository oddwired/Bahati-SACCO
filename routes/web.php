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

Route::group(["prefix"=> "admin"], function(){

    /* Auth routes */

    Route::get('login', "Auth\Admin\AuthController@index");
    Route::post('login', "Auth\Admin\AuthController@login");
    Route::post('logout', "Auth\Admin\AuthController@logout");

    /* Authenticated routes */
    Route::group(["middleware"=> ["auth.admin"]], function (){

        Route::get('/', "Admin\AdminController@index");

        /* Members */
        Route::get('members', "Admin\MembersController@index");
        Route::post('register-member', "Auth\Member\AuthController@register");

        /* Conductors */
        Route::get('conductors', "Admin\ConductorsController@index");
        Route::post('register-conductor', "Auth\Conductor\AuthController@register");

    });
});

/*MEMBER routes*/

Route::group(["prefix"=> "member"], function(){

    /* Auth routes */

    Route::get('login', "Auth\Member\AuthController@index");
    Route::post('login', "Auth\Member\AuthController@login");
    Route::post('logout', "Auth\Member\AuthController@logout");

    Route::get('forgot-password', "Auth\Member\AuthController@forgotPassword");
    Route::post('forgot-password', "Auth\Member\AuthController@sendResetLink");

    /* Authenticated routes */
    Route::group(["middleware"=> ["auth.member"]], function(){
        Route::get("/", "Member\MemberController@index");

        Route::get('vehicles', 'Member\MemberController@myVehicles');
        Route::post('add-vehicle', 'VehiclesController@create');
        Route::get("reports", "ReportsController@getTripRecordsForMember");
    });
});

/*CONDUCTOR routes*/

Route::group(["prefix"=> "conductor"], function(){

    /* Auth routes */

    Route::get('login', "Auth\Conductor\AuthController@index");
    Route::post('login', "Auth\Conductor\AuthController@login");
    Route::post('logout', "Auth\Conductor\AuthController@logout");

    Route::get('forgot-password', "Auth\Conductor\AuthController@forgotPassword");
    Route::post('forgot-password', "Auth\Conductor\AuthController@sendResetLink");

    /* Authenticated routes */
    Route::group(["middleware"=> ["auth.conductor"]], function(){
        Route::get("/", "Conductor\ConductorController@index");

        Route::get("reports", "ReportsController@getTripsRecordedByConductor");
        Route::post("record-trip", "TripController@logTrip");
    });
});