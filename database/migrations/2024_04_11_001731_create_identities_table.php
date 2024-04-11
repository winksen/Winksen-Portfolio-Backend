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
        Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('logo')->nullable();
            $table->string('logoMark')->nullable();
            $table->string('logoSecondary1')->nullable();
            $table->string('logoMarkSecondary1')->nullable();
            $table->string('logoSecondary2')->nullable();
            $table->string('logoMarkSecondary2')->nullable();
            $table->string('logoSecondary3')->nullable();
            $table->string('logoMarkSecondary3')->nullable();
            $table->string('logoSecondary4')->nullable();
            $table->string('logoMarkSecondary4')->nullable();
            $table->string('logoBW')->nullable();
            $table->string('logoMarkBW')->nullable();
            $table->string('typography')->nullable();
            $table->string('typographyImage')->nullable();
            $table->string('mockup1')->nullable();
            $table->string('mockup2')->nullable();
            $table->string('mockup3')->nullable();
            $table->string('mockup4')->nullable();
            $table->string('mockup5')->nullable();
            $table->string('mockup6')->nullable();
            $table->string('mockup7')->nullable();
            $table->string('title')->nullable();
            $table->datetime('date')->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identities');
    }
};
