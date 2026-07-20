<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedagogy_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained('practitioners')->onDelete('cascade');
            $table->foreignId('arena_session_id')->constrained('arena_sessions')->onDelete('cascade');
            $table->foreignId('therapist_id')->constrained('therapists')->onDelete('restrict');
            $table->date('assessment_date');
            // Dominios cognitivos e pedagogicos
            $table->tinyInteger('visual_perception')->nullable()->comment('0-4');
            $table->tinyInteger('sustained_attention')->nullable()->comment('0-4');
            $table->tinyInteger('working_memory')->nullable()->comment('0-4');
            $table->tinyInteger('logical_reasoning')->nullable()->comment('0-4');
            $table->enum('literacy_level', ['pre_syllabic','syllabic','alphabetic'])->nullable();
            $table->tinyInteger('math_literacy')->nullable()->comment('0-4');
            $table->tinyInteger('spatial_organization')->nullable()->comment('0-4');
            $table->tinyInteger('motor_planning')->nullable()->comment('0-4');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedagogy_assessments');
    }
};
