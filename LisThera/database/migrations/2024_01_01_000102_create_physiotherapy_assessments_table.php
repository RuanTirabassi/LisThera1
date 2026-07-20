<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physiotherapy_assessments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('practitioner_id')
                  ->constrained('practitioners')
                  ->onDelete('cascade');

            $table->foreignId('arena_session_id')
                  ->constrained('arena_sessions')
                  ->onDelete('cascade');

            $table->foreignId('therapist_id')
                  ->constrained('therapists')
                  ->onDelete('restrict');

            $table->date('assessment_date');

            // Escala de Ashworth Modificada (tonus muscular)
            $table->tinyInteger('ashworth_upper_limb_right')->nullable();
            $table->tinyInteger('ashworth_upper_limb_left')->nullable();
            $table->tinyInteger('ashworth_lower_limb_right')->nullable();
            $table->tinyInteger('ashworth_lower_limb_left')->nullable();

            // GMFM (Gross Motor Function Measure)
            $table->tinyInteger('gmfm_lying_rolling')->nullable();
            $table->tinyInteger('gmfm_sitting')->nullable();
            $table->tinyInteger('gmfm_crawling_kneeling')->nullable();
            $table->tinyInteger('gmfm_standing')->nullable();
            $table->tinyInteger('gmfm_walking_running_jumping')->nullable();

            // MRC Scale (forca muscular)
            $table->tinyInteger('mrc_hip_flexors')->nullable();
            $table->tinyInteger('mrc_knee_extensors')->nullable();

            // Equilibrio
            $table->tinyInteger('static_balance')->nullable();
            $table->tinyInteger('dynamic_balance')->nullable();

            $table->text('clinical_notes')->nullable();

            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->softDeletes(); // deleted_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physiotherapy_assessments');
    }
};
