<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arena_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_checkin_id')->constrained('session_checkins')->onDelete('cascade');
            $table->foreignId('arena_id')->nullable()->constrained('arenas')->onDelete('set null');
            $table->enum('status', ['ready','in_progress','finished','aborted'])->default('ready');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->foreignId('started_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('ended_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arena_sessions');
    }
};
