<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('arena_session_mounts', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('arena_session_id');
            $t->unsignedInteger('mount_type_id');
            $t->dateTime('started_at');
            $t->dateTime('ended_at')->nullable();
            $t->unsignedBigInteger('changed_by_therapist_id')->nullable();
            $t->text('notes')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->foreign('arena_session_id')->references('id')->on('arena_sessions')->onDelete('cascade');
            $t->foreign('mount_type_id')->references('id')->on('mount_types')->onDelete('restrict');
            $t->foreign('changed_by_therapist_id')->references('id')->on('therapists')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('arena_session_mounts'); }
};
