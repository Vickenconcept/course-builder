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
        Schema::create('courseresearches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('author')->nullable();
            $table->text('category')->nullable();
            $table->text('rating')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('isbn')->nullable();
            $table->text('infolink')->nullable();
            $table->text('pages')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_researches');
    }
};
