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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('imageUrl')->nullable();
            $table->string('title')->nullable();
            $table->string('date')->nullable();
            $table->string('location')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('link')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('isNew')->default(0);
            $table->boolean('isHot')->default(0);
            $table->boolean('isFeatured')->default(0);
            $table->boolean('tag1')->default(0);
            $table->boolean('tag2')->default(0);
            $table->boolean('tag3')->default(0);
            $table->boolean('tag4')->default(0);
            $table->boolean('tag5')->default(0);
            $table->boolean('tag6')->default(0);
            $table->boolean('tag7')->default(0);
            $table->boolean('tag8')->default(0);
            $table->boolean('tag9')->default(0);
            $table->boolean('tag10')->default(0);
            $table->boolean('tag11')->default(0);
            $table->boolean('tag12')->default(0);
            $table->boolean('tag13')->default(0);
            $table->boolean('tag14')->default(0);
            $table->boolean('tag15')->default(0);
            $table->boolean('tag16')->default(0);
            $table->boolean('tag17')->default(0);
            $table->boolean('tag18')->default(0);
            $table->boolean('tag19')->default(0);
            $table->boolean('tag20')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};