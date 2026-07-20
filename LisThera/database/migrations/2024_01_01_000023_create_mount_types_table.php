<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mount_types', function (Blueprint $t) {
            $t->unsignedInteger('id')->autoIncrement();
            $t->string('code', 10)->unique();
            $t->string('name', 120)->unique();
            $t->string('group_label', 60)->nullable();
            $t->enum('complexity_level', ['basica', 'intermediaria', 'complexa'])->nullable();
            $t->text('description')->nullable();
            $t->boolean('is_active')->default(true);
            $t->timestamp('created_at')->useCurrent()->nullable();
            $t->timestamp('updated_at')->nullable();
        });
    }
    public function down(): void { Schema::dropIfExists('mount_types'); }
};
