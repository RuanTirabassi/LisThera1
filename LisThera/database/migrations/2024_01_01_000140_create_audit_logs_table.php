<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('audit_logs', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('user_id');
            $t->unsignedBigInteger('role_id');
            $t->enum('action', ['create','read','update','delete','login','logout']);
            $t->string('table_name', 100);
            $t->unsignedBigInteger('record_id')->nullable();
            $t->string('ip_address', 45)->nullable();
            $t->string('user_agent', 255)->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->foreign('user_id')->references('id')->on('users');
            $t->foreign('role_id')->references('id')->on('roles');
        });
    }
    public function down(): void { Schema::dropIfExists('audit_logs'); }
};
