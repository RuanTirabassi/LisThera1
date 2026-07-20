<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pedagogy_assessments', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('practitioner_id');
            $t->unsignedBigInteger('arena_session_id');
            $t->unsignedBigInteger('therapist_id');
            $t->date('assessment_date');
            $t->tinyInteger('visual_perception')->nullable();
            $t->tinyInteger('sustained_attention')->nullable();
            $t->tinyInteger('working_memory')->nullable();
            $t->tinyInteger('logical_reasoning')->nullable();
            $t->enum('literacy_level', ['pre_syllabic','syllabic','alphabetic'])->nullable();
            $t->tinyInteger('math_literacy')->nullable();
            $t->tinyInteger('spatial_organization')->nullable();
            $t->tinyInteger('motor_planning')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $t->timestamp('deleted_at')->nullable();
            $t->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $t->foreign('arena_session_id')->references('id')->on('arena_sessions')->onDelete('cascade');
            $t->foreign('therapist_id')->references('id')->on('therapists')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('pedagogy_assessments'); }
};
