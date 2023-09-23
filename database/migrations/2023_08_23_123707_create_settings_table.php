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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->text('mailchimp_api_key')->nullable();
            $table->text('mailchimp_prefix_key')->nullable();
            $table->text('paypal_api_username')->nullable();
            $table->text('paypal_api_password')->nullable();
            $table->text('paypal_api_secret')->nullable();
            $table->text('get_response_api_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
