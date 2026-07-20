<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('auditlogs', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('userid')->nullable();
            $t->string('action', 100);
            $t->string('tablename', 100)->nullable();
            $t->unsignedBigInteger('recordid')->nullable();
            $t->json('oldvalue')->nullable();
            $t->json('newvalue')->nullable();
            $t->dateTime('createdat')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('auditlogs'); }
};
