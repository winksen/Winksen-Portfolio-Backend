<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_id');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->timestamps();
            $table->string('imageUrl')->nullable();
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->string('gallery')->nullable();
            $table->string('date')->nullable();
            $table->string('location')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('size')->nullable();
            $table->string('imageType')->nullable();
            $table->string('fileName')->nullable();
            $table->string('camera')->nullable();
            $table->string('lens')->nullable();
            $table->string('cameraType')->nullable();
            $table->string('focalLength')->nullable();
            $table->string('shutterSpeed')->nullable();
            $table->string('aperture')->nullable();
            $table->string('iso')->nullable();           
            $table->string('software')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
