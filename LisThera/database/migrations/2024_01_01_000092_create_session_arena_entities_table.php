<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_arena_entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arena_session_id')->constrained('arena_sessions')->onDelete('cascade');
            $table->enum('entity_type', ['practitioner', 'therapist', 'horse']);
            $table->unsignedBigInteger('entity_id');
            $table->string('rfid_tag', 50);
            $table->dateTime('entered_at');
            $table->dateTime('exited_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->unique(['arena_session_id', 'entity_type', 'entity_id'], 'uq_arena_session_entity');
            $table->index('rfid_tag', 'idx_arena_entities_rfid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_arena_entities');
    }
};
