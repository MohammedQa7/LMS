<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_classes', function (Blueprint $table) {
            $table->foreignId('section_id')->nullable()->constrained('sections')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_classes', function (Blueprint $table) {
            Schema::dropIfExists('student_classes');
        });
    }
};
