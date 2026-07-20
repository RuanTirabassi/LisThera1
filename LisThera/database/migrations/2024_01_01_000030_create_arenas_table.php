<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('arenas', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->string('name', 50)->unique();
            $t->text('description')->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->timestamp('updated_at')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('arenas'); }
};
