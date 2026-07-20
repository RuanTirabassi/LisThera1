<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('iotdevices', function (Blueprint $t) {
            $t->id();
            $t->string('name', 100);
            $t->string('devicetype', 100)->nullable();
            $t->string('serialnumber', 100)->nullable()->unique();
            $t->boolean('isactive')->default(true);
        });
    }
    public function down(): void { Schema::dropIfExists('iotdevices'); }
};
