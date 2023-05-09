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
        Schema::table('offers', function (Blueprint $table) {
            $table->integer('time')->nullable()->change();
            $table->string('cancel')->nullable()->change();
            $table->string('cancel_admin')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->integer('time')->nullable(false)->change();
            $table->string('cancel')->nullable(false)->change();
            $table->string('cancel_admin')->nullable(false)->change();
        });
    }
};
