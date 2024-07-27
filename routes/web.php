<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\DNIController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitanteController;


//La vista de log
Route::get('/',[AuthController::class,'login']);
//Evitar los datos del login
Route::post('login',[AuthController::class,'AuthLogin']);
//Cerrar sesion
Route::get('logout',[AuthController::class,'Logout']);

Route::group(['middleware'=>'admin','prefix'=>'admin'],function(){
    Route::get('panel',[DasboardController::class,'dashboard']);
    Route::resources([
        'users'=>UserController::class,
        'areas'=>AreaController::class
    ]);
    //Validación de la API
    Route::post('/users/create/add-consulta', [DNIController::class, 'consultarDNI']);
});
Route::group(['middleware'=>'vigilante','prefix'=>'vigilante'],function(){
    Route::get('panel',[DasboardController::class,'dashboard']);
    Route::resources([
        'visitors'=> VisitanteController::class
    ]);
    //Validación de la API
    Route::post('/visitors/create/add-consulta', [DNIController::class, 'consultarDNI']);
    //Reportes
    Route::get('panel/reporte', [DasboardController::class, 'reporte']);
});


