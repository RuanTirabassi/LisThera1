<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\SessionCheckinController;
use App\Http\Controllers\ArenaSessionController;
use App\Http\Controllers\MemoryCueController;

// ─── Redireciona raiz para dashboard ──────────────────────────────────────────
Route::get('/', fn () => redirect()->route('dashboard'));

// ─── Rotas abertas para teste (sem autenticação) ───────────────────────────────

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Praticantes
Route::resource('practitioners', PractitionerController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update']);

// Triagem (session checkin)
Route::prefix('checkins')->name('checkins.')->group(function () {
    Route::get('/',        [SessionCheckinController::class, 'index'])->name('index');
    Route::get('/create',  [SessionCheckinController::class, 'create'])->name('create');
    Route::post('/',       [SessionCheckinController::class, 'store'])->name('store');
    Route::get('/{id}',    [SessionCheckinController::class, 'show'])->name('show');
});

// Sessões de arena
Route::prefix('sessions')->name('sessions.')->group(function () {
    Route::get('/',           [ArenaSessionController::class, 'index'])->name('index');
    Route::get('/create',     [ArenaSessionController::class, 'create'])->name('create');
    Route::post('/',          [ArenaSessionController::class, 'store'])->name('store');
    Route::get('/{id}',       [ArenaSessionController::class, 'show'])->name('show');
    Route::patch('/{id}/end', [ArenaSessionController::class, 'end'])->name('end');
});

// Memory Cues
Route::prefix('cues')->name('cues.')->group(function () {
    Route::get('/', [MemoryCueController::class, 'index'])->name('index');
});

// Memory Cues API
Route::prefix('api/cues')->name('api.cues.')->group(function () {
    Route::get('/templates',    [MemoryCueController::class, 'templates'])->name('templates');
    Route::post('/',            [MemoryCueController::class, 'store'])->name('store');
    Route::get('/session/{id}', [MemoryCueController::class, 'bySession'])->name('bySession');
});
