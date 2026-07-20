<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('iot_devices', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->enum('device_type', ['esp32_s3'])->default('esp32_s3');
            $t->string('mac_address', 17)->unique();
            $t->unsignedBigInteger('arena_id')->nullable();
            $t->boolean('is_active')->default(true);
            $t->dateTime('last_seen_at')->nullable();
            $t->string('firmware_version', 50)->nullable();
            $t->text('notes')->nullable();
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->timestamp('updated_at')->nullable();
            $t->foreign('arena_id')->references('id')->on('arenas')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('iot_devices'); }
};
