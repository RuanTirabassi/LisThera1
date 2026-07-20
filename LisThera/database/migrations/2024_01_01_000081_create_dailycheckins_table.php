<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('dailycheckins', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('therapistid')->nullable();
            $t->unsignedBigInteger('horseid')->nullable();
            $t->date('checkindate');
            $t->text('notes')->nullable();
            $t->foreign('therapistid')->references('id')->on('therapists')->onDelete('set null');
            $t->foreign('horseid')->references('id')->on('horses')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('dailycheckins'); }
};
