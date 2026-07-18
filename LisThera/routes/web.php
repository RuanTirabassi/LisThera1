<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\SessionCheckinController;
use App\Http\Controllers\ArenaSessionController;
use App\Http\Controllers\MemoryCueController;

// ─── Autenticação ──────────────────────────────────────────────────────────────
Route::get('/',      [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Área autenticada ──────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Praticantes
    Route::resource('practitioners', PractitionerController::class)
         ->only(['index', 'create', 'store', 'show', 'edit', 'update']);

    // Triagem (session checkin)
    Route::prefix('checkins')->name('checkins.')->group(function () {
        Route::get('/',         [SessionCheckinController::class, 'index'])->name('index');
        Route::get('/create',   [SessionCheckinController::class, 'create'])->name('create');
        Route::post('/',        [SessionCheckinController::class, 'store'])->name('store');
        Route::get('/{id}',     [SessionCheckinController::class, 'show'])->name('show');
    });

    // Sessões de arena
    Route::prefix('sessions')->name('sessions.')->group(function () {
        Route::get('/',           [ArenaSessionController::class, 'index'])->name('index');
        Route::get('/create',     [ArenaSessionController::class, 'create'])->name('create');
        Route::post('/',          [ArenaSessionController::class, 'store'])->name('store');
        Route::get('/{id}',       [ArenaSessionController::class, 'show'])->name('show');
        Route::patch('/{id}/end', [ArenaSessionController::class, 'end'])->name('end');
    });

    // Memory Cues (API JSON usada pelo painel em tempo real)
    Route::prefix('api/cues')->name('cues.')->group(function () {
        Route::get('/templates',        [MemoryCueController::class, 'templates'])->name('templates');
        Route::post('/',                [MemoryCueController::class, 'store'])->name('store');
        Route::get('/session/{id}',     [MemoryCueController::class, 'bySession'])->name('bySession');
    });
});
