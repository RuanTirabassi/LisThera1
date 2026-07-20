<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('horses', function (Blueprint $t) {
            $t->id();
            $t->string('name', 100);
            $t->string('breed', 100)->nullable();
            $t->date('birthdate')->nullable();
            $t->string('rfidtoken', 100)->nullable()->unique();
            $t->text('notes')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('horses'); }
};
