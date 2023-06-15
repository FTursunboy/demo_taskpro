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
        Schema::create('my_plan_models', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('hour')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_plan_models');
    }
};
