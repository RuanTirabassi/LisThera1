<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('userroles', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('userid');
            $t->unsignedBigInteger('roleid');
            $t->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $t->foreign('roleid')->references('id')->on('roles')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('userroles'); }
};
