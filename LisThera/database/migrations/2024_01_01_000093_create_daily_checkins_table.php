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
            $table->enum('check_period', ['inicio_jornada','fim_jornada']);
            $table->foreignId('therapist_id')->constrained('therapists')->onDelete('restrict');
            $table->decimal('therapist_weight', 5, 2)->nullable();
            $table->decimal('therapist_height', 5, 2)->nullable();
            $table->string('therapist_pressure', 20)->nullable();
            $table->decimal('therapist_temp', 4, 1)->nullable();
            $table->enum('therapist_mood', ['Normal','Cansado','Sonolento','Estressado','Irritavel','Indisposto'])->nullable();
            $table->boolean('therapist_use_sensor')->default(false);
            $table->text('therapist_obs')->nullable();
            $table->foreignId('horse_id')->nullable()->constrained('horses')->onDelete('set null');
            $table->enum('horse_appearance', ['Normal','Atento','Inquieto','Assustado','Letargico','Doente'])->nullable();
            $table->decimal('horse_weight', 6, 2)->nullable();
            $table->decimal('horse_temp', 4, 1)->nullable();
            $table->string('horse_heart_rate', 20)->nullable();
            $table->string('horse_respiratory_rate', 20)->nullable();
            $table->text('horse_obs')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_checkins');
    }
};
