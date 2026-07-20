<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('breeds', function (Blueprint $t) {
            $t->unsignedInteger('id')->autoIncrement();
            $t->string('name', 100)->unique();
        });
    }
    public function down(): void { Schema::dropIfExists('breeds'); }
};
