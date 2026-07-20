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
            $table->dateTime('scheduled_at')->nullable()->useCurrent();
            $table->foreignId('practitioner_id')->nullable()->constrained('practitioners')->onDelete('set null');
            $table->text('practitioner_obs')->nullable();
            $table->integer('practitioner_height_cm')->nullable();
            $table->decimal('practitioner_weight_pre', 5, 2)->nullable();
            $table->string('practitioner_pressure_pre', 20)->nullable();
            $table->decimal('practitioner_temp_pre', 4, 1)->nullable();
            $table->enum('practitioner_mood_pre', ['Calmo', 'Agitado', 'Ansioso', 'Agressivo', 'Sonolento'])->default('Calmo');
            $table->boolean('practitioner_use_sensor')->default(false);
            $table->enum('is_authorized_to_ride', ['yes', 'no'])->default('yes');
            $table->text('denial_reason')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->enum('practitioner_mood_post', ['Calmo', 'Agitado', 'Ansioso', 'Agressivo', 'Sonolento'])->default('Calmo');
            $table->decimal('practitioner_weight_post', 5, 2)->nullable();
            $table->string('practitioner_pressure_post', 20)->nullable();
            $table->decimal('practitioner_temp_post', 4, 1)->nullable();
            $table->string('mongo_ref_id', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_checkins');
    }
};
