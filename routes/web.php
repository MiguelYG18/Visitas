<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\DNIController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});
Route::resources([
    'home'=>DasboardController::class,
    'users'=>UserController::class,
    'areas'=>AreaController::class,
]);
//Validación de la API
Route::post('/users/create/add-consulta', [DNIController::class, 'consultarDNI']);
