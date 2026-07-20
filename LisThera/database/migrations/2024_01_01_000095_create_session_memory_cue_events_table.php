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
            $table->foreignId('memory_cue_template_id')->constrained('memory_cue_templates')->onDelete('restrict');
            $table->foreignId('registered_by')->constrained('users')->onDelete('restrict');
            $table->dateTime('occurred_at');
            $table->unsignedTinyInteger('intensity')->nullable()->comment('1-5');
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_memory_cue_events');
    }
};
