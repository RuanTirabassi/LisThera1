<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('horse_clinical_notes', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('horse_id');
            $t->date('note_date');
            $t->text('description');
            $t->timestamp('created_at')->nullable();
            $t->foreign('horse_id')->references('id')->on('horses')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('horse_clinical_notes'); }
};
