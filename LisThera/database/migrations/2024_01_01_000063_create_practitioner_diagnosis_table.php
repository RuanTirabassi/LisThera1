<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('practitioner_diagnosis', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('practitioner_id');
            $t->unsignedBigInteger('diagnosis_id');
            $t->unique(['practitioner_id', 'diagnosis_id'], 'uq_pract_diag');
            $t->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
            $t->foreign('diagnosis_id')->references('id')->on('diagnosis_reference')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('practitioner_diagnosis'); }
};
