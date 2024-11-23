<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

});

//Admin
Route::post('/nuevoProducto', [ProductoController::class, 'store']);
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy']);
Route::put('/productos/{producto}', [ProductoController::class, 'update']);

Route::apiResource('/productos', ProductoController::class);
Route::apiResource('/categorias', CategoriaController::class);
Route::get('/productos/{producto}', [ProductoController::class, 'show']);

//Users
Route::apiResource('/getUsersList', UserController::class);
Route::post('/newUser', [UserController::class, 'store']);
Route::delete('/getUser/{user}', [UserController::class, 'destroy']);
Route::get('/getUser/{user}', [UserController::class, 'show']);
Route::put('/getUser/{user}', [UserController::class, 'update']);

//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


