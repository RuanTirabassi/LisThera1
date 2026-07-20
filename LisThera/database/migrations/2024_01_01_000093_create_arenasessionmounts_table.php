<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('arenasessionmounts', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('arenasessionid');
            $t->unsignedBigInteger('horseid')->nullable();
            $t->unsignedBigInteger('mounttypeid')->nullable();
            $t->dateTime('mountedat')->nullable();
            $t->dateTime('dismountedat')->nullable();
            $t->text('notes')->nullable();
            $t->foreign('arenasessionid')->references('id')->on('arenasessions')->onDelete('cascade');
            $t->foreign('horseid')->references('id')->on('horses')->onDelete('set null');
            $t->foreign('mounttypeid')->references('id')->on('mounttypes')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('arenasessionmounts'); }
};
