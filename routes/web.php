<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CounterController;

// ── Public ──────────────────────────────────────
Route::get('/',       fn() => redirect('/login'));
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ── Admin (only logged-in admins) ────────────────
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard',        [AdminController::class, 'dashboard']);
    Route::get('/students',         [AdminController::class, 'students']);
    Route::get('/students/create',  [AdminController::class, 'createStudentForm']);
    Route::post('/students/create', [AdminController::class, 'createStudent']);
});

// ── Student (only logged-in students) ────────────
Route::middleware('student')->prefix('student')->group(function () {
    Route::get('/dashboard',            [CounterController::class, 'index']);
    Route::post('/counters',            [CounterController::class, 'store']);
    Route::post('/counters/{id}/increment', [CounterController::class, 'increment']);
    Route::post('/counters/{id}/decrement', [CounterController::class, 'decrement']);
    Route::post('/counters/{id}/reset',     [CounterController::class, 'reset']);
    Route::delete('/counters/{id}',         [CounterController::class, 'destroy']);
});