<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('physiotherapy_assessments', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('practitioner_id');
            $t->unsignedBigInteger('arena_session_id');
            $t->unsignedBigInteger('therapist_id');
            $t->date('assessment_date');
            $t->tinyInteger('ashworth_upper_limb_right')->nullable();
            $t->tinyInteger('ashworth_upper_limb_left')->nullable();
            $t->tinyInteger('ashworth_lower_limb_right')->nullable();
            $t->tinyInteger('ashworth_lower_limb_left')->nullable();
            $t->tinyInteger('gmfm_lying_rolling')->nullable();
            $t->tinyInteger('gmfm_sitting')->nullable();
            $t->tinyInteger('gmfm_crawling_kneeling')->nullable();
            $t->tinyInteger('gmfm_standing')->nullable();
            $t->tinyInteger('gmfm_walking_running_jumping')->nullable();
            $t->tinyInteger('mrc_hip_flexors')->nullable();
            $t->tinyInteger('mrc_knee_extensors')->nullable();
            $t->tinyInteger('static_balance')->nullable();
            $t->tinyInteger('dynamic_balance')->nullable();
            $t->text('clinical_notes')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->timestamp('deleted_at')->nullable();
            $t->foreign('practitioner_id')->references('id')->on('practitioners');
            $t->foreign('arena_session_id')->references('id')->on('arena_sessions');
            $t->foreign('therapist_id')->references('id')->on('therapists');
        });
    }
    public function down(): void { Schema::dropIfExists('physiotherapy_assessments'); }
};
