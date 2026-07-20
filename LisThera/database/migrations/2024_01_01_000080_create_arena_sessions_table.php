<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('arena_sessions', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('session_checkin_id');
            $t->unsignedBigInteger('arena_id')->nullable();
            $t->enum('status', ['ready','in_progress','finished','aborted'])->default('ready');
            $t->dateTime('started_at')->nullable();
            $t->dateTime('ended_at')->nullable();
            $t->unsignedBigInteger('started_by');
            $t->unsignedBigInteger('ended_by')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->foreign('session_checkin_id')->references('id')->on('session_checkins')->onDelete('cascade');
            $t->foreign('arena_id')->references('id')->on('arenas')->onDelete('set null');
            $t->foreign('started_by')->references('id')->on('therapists')->onDelete('restrict');
            $t->foreign('ended_by')->references('id')->on('therapists')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('arena_sessions'); }
};
