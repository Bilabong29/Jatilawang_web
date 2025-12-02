<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); 
            $table->string('google_id')->nullable()->unique();
            $table->string('google_avatar')->nullable();
            $table->string('google_token', 2048)->nullable();
            $table->rememberToken();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('full_name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('role', 20)->default('customer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};