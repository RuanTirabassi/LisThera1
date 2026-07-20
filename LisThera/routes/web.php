<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\PsychologyAssessmentController;
use App\Http\Controllers\PsychologyAssessmentCueLinkController;
use App\Http\Controllers\AssessmentsController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Praticantes
Route::resource('practitioners', PractitionerController::class);

// Sessões
Route::resource('sessions', SessionController::class);

// Check-ins
Route::resource('checkins', CheckinController::class);

// Central de Avaliações
Route::get('/assessments', [AssessmentsController::class, 'index'])->name('assessments.index');

// Avaliações – Psicologia
Route::resource('psychology', PsychologyAssessmentController::class);

// Memory Cues da Avaliação Psicológica
Route::resource('psychology.cues', PsychologyAssessmentCueLinkController::class)
    ->except(['show'])
    ->parameters(['cues' => 'cue']);

// Avaliações – Pedagogia (rotas preparadas para quando o controller existir)
// Route::resource('pedagogy', PedagogyAssessmentController::class);

// Avaliações – Fisioterapia (rotas preparadas para quando o controller existir)
// Route::resource('physiotherapy', PhysiotherapyAssessmentController::class);
