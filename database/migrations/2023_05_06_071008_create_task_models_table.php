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
        Schema::create('task_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('time');
            $table->date('from');
            $table->date('to');
            $table->string('file')->nullable();
            $table->string('file_name')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('kpi_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('client_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('project_models')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('task_type_models')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses_models')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_models');
    }
};
