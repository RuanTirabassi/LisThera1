<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iot_devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_uid', 100)->unique();
            $table->string('label', 100)->nullable();
            $table->enum('type', ['heart_rate', 'accelerometer', 'temperature', 'other'])->default('other');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iot_devices');
    }
};
