<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('practitioner_clinical_history', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('practitioner_id');
            $t->enum('pregnancy_planned', ['Sim', 'Não'])->nullable();
            $t->enum('pregnancy_peaceful', ['Sim', 'Não'])->nullable();
            $t->text('delivery')->nullable();
            $t->enum('has_siblings', ['Sim', 'Não'])->nullable();
            $t->text('siblings_relationship')->nullable();
            $t->text('household_members')->nullable();
            $t->timestamp('created_at')->nullable();
            $t->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('practitioner_clinical_history'); }
};
