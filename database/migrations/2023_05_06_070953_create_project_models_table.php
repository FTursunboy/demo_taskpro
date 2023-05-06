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
        Schema::create('project_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type_id');
            $table->string('time');
            $table->date('from');
            $table->date('to');
            $table->date('start');
            $table->date('finish');
            $table->text('comment');
            $table->integer('pro_status');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('project_type_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_models');
    }
};
