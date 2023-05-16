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
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('budget');
            $table->string('pluses');
            $table->string('minuses');
            $table->string('from');
            $table->string('to');
            $table->string('user_id');
            $table->string('file')->nullable();
            $table->text('comments')->nullable();
            $table->text('description');
            $table->string('status_id');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
