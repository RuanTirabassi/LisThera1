<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arena_session_mounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arena_session_id')->constrained('arena_sessions')->onDelete('cascade');
            $table->foreignId('mount_type_id')->constrained('mount_types')->onDelete('restrict');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->foreignId('changed_by_therapist_id')->nullable()->constrained('therapists')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arena_session_mounts');
    }
};
