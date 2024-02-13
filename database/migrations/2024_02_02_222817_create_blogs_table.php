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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('imageUrl')->nullable();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('link')->nullable();
            $table->string('readTime')->nullable();
            $table->string('publishDate')->nullable();
            $table->integer('revisions')->nullable();
            $table->integer('likeCount')->nullable();
            $table->integer('commentCount')->nullable();
            $table->boolean('isNew')->default(0);
            $table->boolean('isHot')->default(0);
            $table->boolean('isFeatured')->default(0);
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
