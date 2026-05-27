<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterController;

Route::get('/',  [CounterController::class, 'index']);
Route::post('/increment', [CounterController::class, 'increment']);
Route::post('/decrement', [CounterController::class, 'decrement']);
Route::post('/reset',     [CounterController::class, 'reset']);
