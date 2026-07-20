<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('practitionerguardians', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('practitionerid');
            $t->string('fullname', 255);
            $t->string('relationship', 100)->nullable();
            $t->string('phonenumber', 30)->nullable();
            $t->string('email', 255)->nullable();
            $t->foreign('practitionerid')->references('id')->on('practitioners')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('practitionerguardians'); }
};
