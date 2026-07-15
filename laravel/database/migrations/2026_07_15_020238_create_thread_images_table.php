<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thread_images', function (Blueprint $table) {
            $table->id();
            
            // Link to the main thread
            $table->unsignedBigInteger('thread_id');
            // Store the path to the image
            $table->string('image_path');
            
            $table->timestamps();
            
            // Optional but highly recommended: automatically delete images if the thread is deleted
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thread_images');
    }
};