<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('therapists', function (Blueprint $t) {
            $t->id();
            $t->string('fullname', 255);
            $t->string('specialization', 100)->nullable();
            $t->string('registrationnumber', 50)->nullable();
            $t->string('phonenumber', 30)->nullable();
            $t->string('email', 255)->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('therapists'); }
};
