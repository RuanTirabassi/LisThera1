<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('psychology_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained('practitioners')->onDelete('cascade');
            $table->foreignId('arena_session_id')->constrained('arena_sessions')->onDelete('cascade');
            $table->foreignId('therapist_id')->constrained('therapists')->onDelete('restrict');
            $table->date('assessment_date');
            // Escala Vineland (VABS)
            $table->tinyInteger('vabs_communication')->nullable()->comment('Score 1-5');
            $table->tinyInteger('vabs_socialization')->nullable()->comment('Score 1-5');
            $table->tinyInteger('vabs_daily_living')->nullable()->comment('Score 1-5');
            $table->tinyInteger('vabs_motor_skills')->nullable()->comment('Score 1-5');
            // Indicadores comportamentais
            $table->tinyInteger('interaction_with_horse')->nullable()->comment('1=Avoids 5=Proactive');
            $table->tinyInteger('touch_acceptance')->nullable()->comment('1=Rejects 5=Accepts');
            $table->tinyInteger('impulse_control')->nullable()->comment('1=Poor 5=Excellent');
            $table->tinyInteger('instruction_following')->nullable()->comment('1=Does not follow 5=Consistently follows');
            $table->text('current_medication')->nullable();
            $table->text('main_complaints')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psychology_assessments');
    }
};
