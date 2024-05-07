<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\tituloController;

Route::get('/titulo', [tituloController::class, 'index']);

Route::get('/titulo/{id}', [tituloController::class, 'show']);

Route::post('/titulo', [tituloController::class, 'store']);

Route::put('/titulo/{id}', [tituloController::class, 'update']);

Route::patch('/titulo/{id}', [tituloController::class, 'updatePartial']);

Route::delete('/titulo/{id}', [tituloController::class, 'destroy']);