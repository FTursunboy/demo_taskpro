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
            $table->string('surname')->default(null);
            $table->string('lastname')->default('null');
            $table->string('login')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('position');
            $table->string('otdel_slug')->default(null);
            $table->string('telegram_user_id')->unique();
            $table->integer('xp')->default(50);
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable();
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
