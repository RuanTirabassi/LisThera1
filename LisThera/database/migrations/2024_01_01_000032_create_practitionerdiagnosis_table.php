<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('practitionerdiagnosis', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('practitionerid');
            $t->unsignedBigInteger('diagnosisreferenceid');
            $t->date('diagnoseddate')->nullable();
            $t->text('notes')->nullable();
            $t->foreign('practitionerid')->references('id')->on('practitioners')->onDelete('cascade');
            $t->foreign('diagnosisreferenceid')->references('id')->on('diagnosisreference');
        });
    }
    public function down(): void { Schema::dropIfExists('practitionerdiagnosis'); }
};
