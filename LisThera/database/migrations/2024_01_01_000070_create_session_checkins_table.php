<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('session_checkins', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->dateTime('scheduled_at')->useCurrent();
            $t->unsignedBigInteger('practitioner_id')->nullable();
            $t->text('practitioner_obs')->nullable();
            $t->integer('practitioner_height_cm')->nullable();
            $t->decimal('practitioner_weight_pre', 5, 2)->nullable();
            $t->string('practitioner_pressure_pre', 20)->nullable();
            $t->decimal('practitioner_temp_pre', 4, 1)->nullable();
            $t->enum('practitioner_mood_pre', ['Calmo','Agitado','Ansioso','Agressivo','Sonolento'])->default('Calmo');
            $t->boolean('practitioner_use_sensor')->default(false);
            $t->enum('is_authorized_to_ride', ['yes','no'])->default('yes');
            $t->text('denial_reason')->nullable();
            $t->text('cancellation_reason')->nullable();
            $t->enum('practitioner_mood_post', ['Calmo','Agitado','Ansioso','Agressivo','Sonolento'])->default('Calmo');
            $t->decimal('practitioner_weight_post', 5, 2)->nullable();
            $t->string('practitioner_pressure_post', 20)->nullable();
            $t->decimal('practitioner_temp_post', 4, 1)->nullable();
            $t->string('mongo_ref_id', 255)->nullable();
            $t->timestamp('created_at')->nullable();
            $t->timestamp('updated_at')->nullable();
            $t->foreign('practitioner_id')->references('id')->on('practitioners');
        });
    }
    public function down(): void { Schema::dropIfExists('session_checkins'); }
};
