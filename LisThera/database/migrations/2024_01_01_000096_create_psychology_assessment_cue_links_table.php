<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('psychology_assessment_cue_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psychology_assessment_id')
                  ->constrained('psychology_assessments')
                  ->cascadeOnDelete();
            $table->foreignId('memory_cue_template_id')
                  ->nullable()
                  ->constrained('memory_cue_templates')
                  ->nullOnDelete();
            $table->string('cue_label', 120)->nullable()->comment('Rótulo personalizado do cue');
            $table->text('cue_description')->nullable()->comment('Descrição / instrução do cue');
            $table->enum('cue_type', ['visual', 'auditivo', 'tátil', 'verbal', 'outro'])->default('visual');
            $table->unsignedTinyInteger('intensity')->nullable()->comment('Intensidade 1-5');
            $table->text('therapist_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psychology_assessment_cue_links');
    }
};
