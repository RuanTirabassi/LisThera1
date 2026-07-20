<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('arenasessions', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('practitionerid')->nullable();
            $t->unsignedBigInteger('therapistid')->nullable();
            $t->unsignedBigInteger('arenaid')->nullable();
            $t->dateTime('startedat')->nullable();
            $t->dateTime('endedat')->nullable();
            $t->text('notes')->nullable();
            $t->foreign('practitionerid')->references('id')->on('practitioners')->onDelete('set null');
            $t->foreign('therapistid')->references('id')->on('therapists')->onDelete('set null');
            $t->foreign('arenaid')->references('id')->on('arenas')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('arenasessions'); }
};
