<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_checkins', function (Blueprint $table) {
            $table->id();
            $table->date('check_date');
            $table->enum('check_period', ['inicio_jornada', 'fim_jornada']);
            $table->foreignId('therapist_id')->constrained('therapists')->onDelete('cascade');
            $table->decimal('therapist_weight', 5, 2)->nullable();
            $table->decimal('therapist_height', 5, 2)->nullable();
            $table->string('therapist_pressure', 20)->nullable();
            $table->decimal('therapist_temp', 4, 1)->nullable();
            $table->enum('therapist_mood', ['Normal', 'Cansado', 'Sonolento', 'Estressado', 'Irritavel', 'Indisposto'])->nullable();
            $table->boolean('therapist_use_sensor')->default(false);
            $table->text('therapist_obs')->nullable();
            $table->foreignId('horse_id')->nullable()->constrained('horses')->onDelete('set null');
            $table->enum('horse_appearance', ['Normal', 'Atento', 'Inquieto', 'Assustado', 'Letargico', 'Desconfortavel'])->nullable();
            $table->text('horse_observations')->nullable();
            $table->boolean('horse_use_sensor')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->unique(['check_date', 'check_period', 'therapist_id', 'horse_id'], 'uq_daily_check');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_checkins');
    }
};
