<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('horseclinicalnotes', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('horseid');
            $t->text('note');
            $t->dateTime('notedat')->nullable();
            $t->foreign('horseid')->references('id')->on('horses')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('horseclinicalnotes'); }
};
