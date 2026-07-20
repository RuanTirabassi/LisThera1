<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('session_arena_entities', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('arena_session_id');
            $t->enum('entity_type', ['practitioner','therapist','horse']);
            $t->unsignedBigInteger('entity_id');
            $t->string('rfid_tag', 50);
            $t->dateTime('entered_at');
            $t->dateTime('exited_at')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->unique(['arena_session_id','entity_type','entity_id'], 'uq_arena_session_entity');
            $t->foreign('arena_session_id')->references('id')->on('arena_sessions')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('session_arena_entities'); }
};
