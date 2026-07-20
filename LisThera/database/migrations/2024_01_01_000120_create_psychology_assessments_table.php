<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('psychology_assessments', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('practitioner_id');
            $t->unsignedBigInteger('arena_session_id');
            $t->unsignedBigInteger('therapist_id');
            $t->date('assessment_date');
            $t->tinyInteger('vabs_communication')->nullable();
            $t->tinyInteger('vabs_socialization')->nullable();
            $t->tinyInteger('vabs_daily_living')->nullable();
            $t->tinyInteger('vabs_motor_skills')->nullable();
            $t->tinyInteger('interaction_with_horse')->nullable();
            $t->tinyInteger('touch_acceptance')->nullable();
            $t->tinyInteger('impulse_control')->nullable();
            $t->tinyInteger('instruction_following')->nullable();
            $t->text('current_medication')->nullable();
            $t->text('main_complaints')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $t->timestamp('deleted_at')->nullable();
            $t->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $t->foreign('arena_session_id')->references('id')->on('arena_sessions')->onDelete('cascade');
            $t->foreign('therapist_id')->references('id')->on('therapists')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('psychology_assessments'); }
};
