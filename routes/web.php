<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginUser;


use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\UserController;

Route::post('/ValidarUsuarioContrasena', [loginUser::class, 'loginUserAcces']);
Route::get('/usuarioactivo', [loginUser::class, 'usuarioactivo']);
Route::get('/logout', [loginUser::class, 'logout']);
Route::post('/token_activo', [loginUser::class, 'token_activo']);
Route::get('/InformacionUsuario', [loginUser::class, 'inormacionUsuario']);

Route::resource('/tasks', TaskController::class);
Route::resource('/companies', CompanyController::class);
Route::resource('/users', UserController::class);

Route::get('{any?}', function() {
    return view('application');
})->where('any', '.*');