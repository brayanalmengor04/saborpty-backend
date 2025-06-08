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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration_minutes');
            $table->enum('difficulty', ['facil', 'medio', 'dificil'])->default('medio');
            $table->float('rating')->default(0); 
            $table->string('youtube_url')->nullable();
            $table->string('image_url')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');   
            $table->json('steps')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
