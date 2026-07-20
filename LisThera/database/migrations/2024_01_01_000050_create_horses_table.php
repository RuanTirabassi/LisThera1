<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('horses', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->string('rfid_tag', 50)->nullable()->unique();
            $t->string('name', 255);
            $t->unsignedInteger('breed_id');
            $t->unsignedInteger('coat_color_id');
            $t->unsignedInteger('gait_type_id');
            $t->integer('withers_height_cm')->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamp('created_at')->nullable();
            $t->timestamp('updated_at')->nullable();
            $t->foreign('breed_id')->references('id')->on('breeds');
            $t->foreign('coat_color_id')->references('id')->on('coat_colors');
            $t->foreign('gait_type_id')->references('id')->on('gait_types');
        });
    }
    public function down(): void { Schema::dropIfExists('horses'); }
};
