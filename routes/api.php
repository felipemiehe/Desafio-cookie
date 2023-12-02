<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PessoasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
// essa rota esta aqui para dar sucesso na requisição padrao do laravel quando não existe token la no authenticate.php
Route::get('firstpage',[AuthController::class, 'firstpage'])->name('firstpage');



Route::middleware('auth:sanctum')->group(function (){
    Route::get('user',[AuthController::class, 'user']);
    Route::post('logout',[AuthController::class, 'logout']);
});


Route::get('/pessoas', [PessoasController::class, 'index' ]);
Route::prefix('/pessoa')->group(function(){
    Route::post('/criar', [PessoasController::class, 'criar']);
    Route::get('/achaum/{id}', [PessoasController::class, 'achaum']);
    Route::put('/{id}', [PessoasController::class, 'update']);
    Route::delete('/{id}', [PessoasController::class, 'destroy']);
});

