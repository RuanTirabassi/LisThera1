<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('session_memory_cue_events', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('arena_session_id');
            $t->unsignedBigInteger('arena_entity_id')->nullable();
            $t->unsignedBigInteger('therapist_id');
            $t->unsignedBigInteger('memory_cue_template_id');
            $t->dateTime('recorded_at')->useCurrent();
            $t->unsignedBigInteger('arena_session_mount_id')->nullable();
            $t->foreign('arena_session_id')->references('id')->on('arena_sessions')->onDelete('cascade');
            $t->foreign('arena_entity_id')->references('id')->on('session_arena_entities')->onDelete('set null');
            $t->foreign('therapist_id')->references('id')->on('therapists')->onDelete('cascade');
            $t->foreign('memory_cue_template_id')->references('id')->on('memory_cue_templates')->onDelete('restrict');
            $t->foreign('arena_session_mount_id')->references('id')->on('arena_session_mounts')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('session_memory_cue_events'); }
};
