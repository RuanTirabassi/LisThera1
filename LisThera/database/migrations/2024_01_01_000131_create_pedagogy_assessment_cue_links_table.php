<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pedagogy_assessment_cue_links', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('pedagogy_assessment_id');
            $t->unsignedBigInteger('session_memory_cue_event_id');
            $t->text('professional_justification')->nullable();
            $t->unsignedTinyInteger('intensity_score')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->foreign('pedagogy_assessment_id')->references('id')->on('pedagogy_assessments')->onDelete('cascade');
            $t->foreign('session_memory_cue_event_id')->references('id')->on('session_memory_cue_events')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('pedagogy_assessment_cue_links'); }
};
