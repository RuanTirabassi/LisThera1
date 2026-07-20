<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('practitioner_guardians', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('practitioner_id');
            $t->string('name', 255);
            $t->date('birth_date')->nullable();
            $t->string('address', 255)->nullable();
            $t->string('profession', 255)->nullable();
            $t->string('phone', 50)->nullable();
            $t->timestamp('created_at')->nullable();
            $t->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('practitioner_guardians'); }
};
