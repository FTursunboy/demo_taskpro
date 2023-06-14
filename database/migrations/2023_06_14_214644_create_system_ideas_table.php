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
        Schema::create('system_ideas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('comment')->nullable();
            $table->string('file')->nullable();
            $table->string('file_name')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_ideas');
    }
};
