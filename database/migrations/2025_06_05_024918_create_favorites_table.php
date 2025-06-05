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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id(); 
             $table->string('firebase_uid'); 
            $table->foreignId('recipe_id')->constrained('recipes')->onDelete('cascade'); 
            $table->timestamps();
             $table->unique(['firebase_uid', 'recipe_id']); //Evitar duplicados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
