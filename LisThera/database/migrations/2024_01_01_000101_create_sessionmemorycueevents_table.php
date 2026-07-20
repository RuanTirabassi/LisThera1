<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sessionmemorycueevents', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('arenasessionid');
            $t->unsignedBigInteger('memorycuetemplateid')->nullable();
            $t->dateTime('recordedat')->nullable();
            $t->text('notes')->nullable();
            $t->foreign('arenasessionid')->references('id')->on('arenasessions')->onDelete('cascade');
            $t->foreign('memorycuetemplateid')->references('id')->on('memorycuetemplates')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('sessionmemorycueevents'); }
};
