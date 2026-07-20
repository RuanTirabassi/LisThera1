<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('psychologyassessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arena_session_id')
                  ->constrained('arenasessions')
                  ->onDelete('cascade');
            $table->foreignId('practitioner_id')
                  ->constrained('practitioners')
                  ->onDelete('cascade');
            $table->foreignId('therapist_id')
                  ->constrained('therapists')
                  ->onDelete('cascade');

            // Domínios clínicos de psicologia
            $table->tinyInteger('emotional_regulation')->nullable()->comment('1-5');
            $table->tinyInteger('behavioral_response')->nullable()->comment('1-5');
            $table->tinyInteger('social_interaction')->nullable()->comment('1-5');
            $table->tinyInteger('attention_focus')->nullable()->comment('1-5');
            $table->tinyInteger('communication')->nullable()->comment('1-5');
            $table->tinyInteger('motivation_engagement')->nullable()->comment('1-5');
            $table->tinyInteger('anxiety_level')->nullable()->comment('1-5 (1=baixo, 5=alto)');
            $table->tinyInteger('frustration_tolerance')->nullable()->comment('1-5');

            $table->text('observations')->nullable();
            $table->text('goals_next_session')->nullable();
            $table->enum('overall_progress', ['regressed', 'stable', 'improved', 'significantly_improved'])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psychologyassessments');
    }
};
