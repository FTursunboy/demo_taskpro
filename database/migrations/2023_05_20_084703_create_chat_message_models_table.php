<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_message_models', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('task_id');
            $table->text('message');
            $table->tinyInteger('user_id');
            $table->tinyInteger('offer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_message_models');
    }
};
