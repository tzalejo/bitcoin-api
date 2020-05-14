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
    Route::post('resetPassword', 'AuthController@resetPassword'); # Para reenviar password
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', '    AuthController@logout'); # Salgo
    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'user'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'User\UserController@index');
    });
});

# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'cliente'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'Cliente\ClienteController@index');
        Route::get('mostrar/{cliente}', 'Cliente\ClienteController@show');
        Route::post('crear', 'Cliente\ClienteController@store'); # Creo un Cliente
        Route::put('modificar/{cliente}', 'Cliente\ClienteController@update');
    });
});
# Group de ruta con prefijo alumnos, agrego cors a las rutas
Route::group(['prefix' => 'proveedor'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'Proveedor\ProveedorController@index');
        Route::post('crear', 'Proveedor\ProveedorController@store'); # Creo un proveedor
        Route::put('modificar/{proveedor}', 'Proveedor\ProveedorController@update'); # Creo un proveedor
    });
});
# Group de ruta con prefijo formulario, agrego cors a las rutas
Route::group(['prefix' => 'formulario'], function () {
    # Rutas con middleware auth
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('', 'Formulario\FormularioController@index');
        // Route::get('mostrar', 'Formulario\FormularioController@show');
        Route::post('crear', 'Formulario\FormularioController@store'); # Creo un Formulario
        Route::put('modificar/{formulario}', 'Formulario\FormularioController@update'); # Modifico un estudiante
        Route::delete('borrar/{formulario}', 'Formulario\FormularioController@destroy');
    });
});

