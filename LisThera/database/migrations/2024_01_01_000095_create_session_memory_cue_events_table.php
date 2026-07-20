<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_memory_cue_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arena_session_id')->constrained('arena_sessions')->onDelete('cascade');
            $table->foreignId('arena_entity_id')->nullable()->constrained('session_arena_entities')->onDelete('set null');
            $table->foreignId('therapist_id')->constrained('therapists')->onDelete('cascade');
            $table->foreignId('memory_cue_template_id')->constrained('memory_cue_templates')->onDelete('restrict');
            $table->dateTime('recorded_at')->useCurrent();
            $table->foreignId('arena_session_mount_id')->nullable()->constrained('arena_session_mounts')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_memory_cue_events');
    }
};
