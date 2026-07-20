<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('practitioners', function (Blueprint $t) {
            $t->id();
            $t->string('fullname', 255);
            $t->date('birthdate')->nullable();
            $t->string('rfidtoken', 100)->nullable()->unique();
            $t->string('phonenumber', 30)->nullable();
            $t->string('address', 255)->nullable();
            $t->text('notes')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('practitioners'); }
};
