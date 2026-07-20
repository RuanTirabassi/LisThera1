<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memory_cue_templates', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->unique()->comment('e.g. PSYC_01, FISIO_02');
            $table->string('label', 120);
            $table->enum('category', ['psychology','physiotherapy','pedagogy','general']);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memory_cue_templates');
    }
};
