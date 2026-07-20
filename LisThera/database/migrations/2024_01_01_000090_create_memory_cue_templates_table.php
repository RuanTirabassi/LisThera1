<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('memory_cue_templates', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('therapist_id');
            $t->string('cue_key', 50);
            $t->string('cue_label', 20);
            $t->string('category', 50)->nullable();
            $t->enum('polarity', ['positive','negative','neutral'])->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamp('created_at')->nullable();
            $t->timestamp('updated_at')->nullable();
            $t->unique(['therapist_id','cue_key'], 'uq_template_owner_key');
            $t->foreign('therapist_id')->references('id')->on('therapists')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('memory_cue_templates'); }
};
