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
Route::group(['prefix' => 'auth'],function(){
    Route::post('login', 'AuthController@login'); # Me Logueo
    Route::post('signup', 'AuthController@signup'); # Creo un usuario(Users)
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', '    AuthController@logout'); # Salgo

    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'user'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'User\UserController@index');
        // Route::get('mostrar', 'User\UserController@show');
        // Route::post('crear', 'User\UserController@store'); # Creo un User
        // Route::put('modificar/{User}', 'User\UserController@update'); # Modifico un estudiante
    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'cliente'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'Cliente\ClienteController@index');
        // Route::get('mostrar', 'User\UserController@show');
        // Route::post('crear', 'User\UserController@store'); # Creo un User
        // Route::put('modificar/{User}', 'User\UserController@update'); # Modifico un estudiante
    });
});

