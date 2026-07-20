<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_checkins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practitioner_id')->constrained('practitioners')->onDelete('cascade');
            $table->foreignId('therapist_id')->constrained('therapists')->onDelete('restrict');
            $table->foreignId('horse_id')->nullable()->constrained('horses')->onDelete('set null');
            $table->date('session_date');
            $table->enum('session_period', ['manha', 'tarde']);
            $table->enum('status', ['scheduled', 'confirmed', 'in_progress', 'completed', 'cancelled', 'no_show'])->default('scheduled');
            // Avaliacao pre-sessao do praticante
            $table->tinyInteger('practitioner_mood')->nullable()->comment('1-5');
            $table->tinyInteger('practitioner_pain_level')->nullable()->comment('0-10');
            $table->tinyInteger('practitioner_fatigue')->nullable()->comment('1-5');
            $table->text('practitioner_obs')->nullable();
            // Avaliacao pre-sessao do cavalo
            $table->enum('horse_appearance', ['Normal','Atento','Inquieto','Assustado','Letargico','Doente'])->nullable();
            $table->tinyInteger('horse_mood')->nullable()->comment('1-5');
            $table->text('horse_obs')->nullable();
            $table->foreignId('iot_device_id')->nullable()->constrained('iot_devices')->onDelete('set null');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_checkins');
    }
};
