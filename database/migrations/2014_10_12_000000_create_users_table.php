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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('is_admin', ['super_admin', 'admin', 'user'])->default('admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('subscribed',[0,1])->default(0);
            $table->enum('use_stripe',[0,1])->default(0);
            $table->enum('use_paypal',[0,1])->default(0);
            $table->text('super_admin_paypal_client_id')->nullable();
            $table->text('subscriptiion_amount')->nullable();
            $table->text('super_admin_strip_secret')->nullable();
            $table->text('super_admin_strip_key')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
