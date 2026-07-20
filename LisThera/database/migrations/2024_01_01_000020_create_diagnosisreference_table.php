<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('diagnosisreference', function (Blueprint $t) {
            $t->id();
            $t->string('code', 20)->nullable();
            $t->string('name', 255);
            $t->text('description')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('diagnosisreference'); }
};
