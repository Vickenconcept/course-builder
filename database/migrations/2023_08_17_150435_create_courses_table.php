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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users');
            $table->text('title')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('list_id')->nullable(); 
            $table->enum('esp', ['mailchimp', 'getresponse','share'])->nullable();
            $table->text('get_response_id')->nullable();
            $table->text('course_image')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
