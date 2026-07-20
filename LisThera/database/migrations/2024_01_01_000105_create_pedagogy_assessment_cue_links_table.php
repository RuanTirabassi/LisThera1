<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedagogy_assessment_cue_links', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedagogy_assessment_id')
                  ->constrained('pedagogy_assessments')
                  ->onDelete('cascade');

            $table->foreignId('session_memory_cue_event_id')
                  ->constrained('session_memory_cue_events')
                  ->onDelete('cascade');

            $table->text('professional_justification')
                  ->nullable()
                  ->comment('Technical/clinical justification for keeping this cue in the final assessment');

            $table->unsignedTinyInteger('intensity_score')->nullable();

            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedagogy_assessment_cue_links');
    }
};
