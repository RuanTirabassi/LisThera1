<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sessioncheckins', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('practitionerid');
            $t->dateTime('checkedat')->nullable();
            $t->integer('bloodpressuresys')->nullable();
            $t->integer('bloodpressuredia')->nullable();
            $t->integer('heartrate')->nullable();
            $t->decimal('temperature', 4, 1)->nullable();
            $t->decimal('oxygensaturation', 5, 2)->nullable();
            $t->tinyInteger('painlevel')->nullable();
            $t->tinyInteger('mobilityrating')->nullable();
            $t->tinyInteger('moodrating')->nullable();
            $t->boolean('sessionauthorized')->default(true);
            $t->text('authorizationnotes')->nullable();
            $t->foreign('practitionerid')->references('id')->on('practitioners')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('sessioncheckins'); }
};
