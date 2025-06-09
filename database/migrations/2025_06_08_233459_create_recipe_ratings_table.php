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
        Schema::create('recipe_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
                $table->string('firebase_uid');
                $table->float('rating');
                $table->timestamps();
                $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
                $table->unique(['recipe_id', 'firebase_uid']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ratings');
    }
};
