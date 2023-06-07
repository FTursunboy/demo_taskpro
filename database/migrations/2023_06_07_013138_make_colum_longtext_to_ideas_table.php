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
        Schema::table('ideas', function (Blueprint $table) {
            $table->longText('title')->nullable()->change();
            $table->longText('budget')->nullable()->change();
            $table->longText('pluses')->nullable()->change();
            $table->longText('minuses')->nullable()->change();
            $table->longText('comments')->nullable()->change();
            $table->longText('description')->nullable()->change();
            $table->longText('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('budget')->nullable()->change();
            $table->string('pluses')->nullable()->change();
            $table->string('minuses')->nullable()->change();
            $table->text('comments')->nullable()->change();
            $table->string('slug')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }
};
