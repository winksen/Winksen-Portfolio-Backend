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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('blog_id');
            $table->string('type'); // e.g., paragraph, quote, table, list, image
            $table->json('content');
            $table->string('listTitle')->nullable();;
            $table->string('tableTitle')->nullable();;
            $table->string('tableDescription')->nullable();;
            $table->string('imageUrl')->nullable();;
            $table->string('imageAlt')->nullable();;
            $table->string('imageDescription')->nullable();;

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
