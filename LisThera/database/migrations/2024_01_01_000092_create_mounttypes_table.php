<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mounttypes', function (Blueprint $t) {
            $t->id();
            $t->string('name', 100);
            $t->text('description')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('mounttypes'); }
};
