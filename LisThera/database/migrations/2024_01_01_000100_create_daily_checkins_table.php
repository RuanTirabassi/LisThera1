<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('daily_checkins', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->date('check_date');
            $t->enum('check_period', ['inicio_jornada','fim_jornada']);
            $t->unsignedBigInteger('therapist_id');
            $t->decimal('therapist_weight', 5, 2)->nullable();
            $t->decimal('therapist_height', 5, 2)->nullable();
            $t->string('therapist_pressure', 20)->nullable();
            $t->decimal('therapist_temp', 4, 1)->nullable();
            $t->enum('therapist_mood', ['Normal','Cansado','Sonolento','Estressado','Irritavel','Indisposto'])->nullable();
            $t->boolean('therapist_use_sensor')->default(false);
            $t->text('therapist_obs')->nullable();
            $t->unsignedBigInteger('horse_id')->nullable();
            $t->enum('horse_appearance', ['Normal','Atento','Inquieto','Assustado','Letargico','Desconfortavel'])->nullable();
            $t->text('horse_observations')->nullable();
            $t->boolean('horse_use_sensor')->default(false);
            $t->timestamp('created_at')->nullable();
            $t->timestamp('updated_at')->nullable();
            $t->unique(['check_date','check_period','therapist_id','horse_id'], 'uq_daily_check');
            $t->foreign('therapist_id')->references('id')->on('therapists')->onDelete('cascade');
            $t->foreign('horse_id')->references('id')->on('horses')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('daily_checkins'); }
};
