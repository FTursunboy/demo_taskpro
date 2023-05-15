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
        Schema::create('tasks_client', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('file')->nullable();
            $table->string('file_name')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('client_id');
            $table->string('cancel')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_client');
    }
};
