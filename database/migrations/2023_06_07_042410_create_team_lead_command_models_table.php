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
        Schema::create('team_lead_command_models', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('teamLead_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_lead_command_models');
    }
};
