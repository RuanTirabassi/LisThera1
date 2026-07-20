<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sessionarenaentities', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('arenasessionid');
            $t->string('entitytype', 50);
            $t->unsignedBigInteger('entityid');
            $t->foreign('arenasessionid')->references('id')->on('arenasessions')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('sessionarenaentities'); }
};
