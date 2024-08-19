<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_level');
            $table->unsignedBigInteger('from_section');
            $table->unsignedBigInteger('from_class');
            $table->unsignedBigInteger('to_level');
            $table->unsignedBigInteger('to_section');
            $table->unsignedBigInteger('to_class');
            $table->foreign('from_level')->references('id')->on('levels')->cascadeOnDelete();
            $table->foreign('from_section')->references('id')->on('sections')->cascadeOnDelete();
            $table->foreign('from_class')->references('id')->on('classes')->cascadeOnDelete();
            $table->foreign('to_level')->references('id')->on('levels')->cascadeOnDelete();
            $table->foreign('to_section')->references('id')->on('sections')->cascadeOnDelete();
            $table->foreign('to_class')->references('id')->on('classes')->cascadeOnDelete();
            $table->string('promotion_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_promotions');
    }
};