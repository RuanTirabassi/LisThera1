<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memory_cue_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapist_id')->constrained('therapists')->onDelete('cascade');
            $table->string('cue_key', 50);
            $table->string('cue_label', 20);
            $table->string('category', 50)->nullable();
            $table->enum('polarity', ['positive', 'negative', 'neutral'])->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->unique(['therapist_id', 'cue_key'], 'uq_template_owner_key');
            $table->index(['therapist_id', 'polarity'], 'idx_mct_therapist_polarity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memory_cue_templates');
    }
};
