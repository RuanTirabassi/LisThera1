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
            $table->string('entity_type', 50)->comment('horse, therapist, volunteer, equipment...');
            $table->unsignedBigInteger('entity_id');
            $table->string('role_in_session', 100)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_arena_entities');
    }
};
