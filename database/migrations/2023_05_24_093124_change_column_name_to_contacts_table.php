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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('phone')->unique()->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('position')->nullable()->change();
            $table->unsignedBigInteger('client_id')->nullable()->change();
            $table->unsignedBigInteger('lead_source_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('position')->nullable(false)->change();
            $table->unsignedBigInteger('client_id')->nullable(false)->change();
            $table->unsignedBigInteger('lead_source_id')->nullable(false)->change();
        });
    }
};
