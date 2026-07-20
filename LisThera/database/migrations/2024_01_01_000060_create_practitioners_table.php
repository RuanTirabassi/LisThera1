<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('practitioners', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->string('rfid_tag', 50)->nullable()->unique();
            $t->string('name', 255);
            $t->date('birth_date')->nullable();
            $t->enum('gender', ['Masculino', 'Feminino', 'Outro'])->nullable();
            $t->string('allergy', 255)->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamp('created_at')->nullable();
            $t->timestamp('updated_at')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('practitioners'); }
};
