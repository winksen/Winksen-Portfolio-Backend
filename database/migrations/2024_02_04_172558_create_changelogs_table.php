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
        Schema::create('changelogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('href')->nullable();
            $table->string('version')->nullable();
            $table->string('comment')->nullable();
            $table->datetime('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changelogs');
    }
};
