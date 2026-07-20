<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\ArenaSessionController;
use App\Http\Controllers\SessionCheckinController;
use App\Http\Controllers\MemoryCueController;
use App\Http\Controllers\PsychologyAssessmentController;

// Auth
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', fn() => redirect()->route('dashboard'));

// Praticantes
Route::get('/practitioners',         [PractitionerController::class, 'index'])->name('practitioners.index');
Route::get('/practitioners/create',  [PractitionerController::class, 'create'])->name('practitioners.create');
Route::post('/practitioners',        [PractitionerController::class, 'store'])->name('practitioners.store');
Route::get('/practitioners/{practitioner}', [PractitionerController::class, 'show'])->name('practitioners.show');
Route::get('/practitioners/{practitioner}/edit', [PractitionerController::class, 'edit'])->name('practitioners.edit');
Route::put('/practitioners/{practitioner}',      [PractitionerController::class, 'update'])->name('practitioners.update');

// Sessions
Route::get('/sessions',              [ArenaSessionController::class, 'index'])->name('sessions.index');
Route::get('/sessions/create',       [ArenaSessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions',             [ArenaSessionController::class, 'store'])->name('sessions.store');
Route::get('/sessions/{session}',    [ArenaSessionController::class, 'show'])->name('sessions.show');
Route::post('/sessions/{session}/finish', [ArenaSessionController::class, 'finish'])->name('sessions.finish');

// Check-ins
Route::get('/checkins',              [SessionCheckinController::class, 'index'])->name('checkins.index');
Route::get('/checkins/create',       [SessionCheckinController::class, 'create'])->name('checkins.create');
Route::post('/checkins',             [SessionCheckinController::class, 'store'])->name('checkins.store');
Route::get('/checkins/{checkin}',    [SessionCheckinController::class, 'show'])->name('checkins.show');

// Memory Cues
Route::get('/cues',                  [MemoryCueController::class, 'index'])->name('cues.index');
Route::get('/cues/{cue}',            [MemoryCueController::class, 'show'])->name('cues.show');

// Psicologia
Route::get('/psychology/{practitioner}/report', [PsychologyAssessmentController::class, 'report'])->name('psychology.report');
Route::get('/sessions/{session}/psychology',    [PsychologyAssessmentController::class, 'create'])->name('psychology.create');
Route::post('/sessions/{session}/psychology',   [PsychologyAssessmentController::class, 'store'])->name('psychology.store');
