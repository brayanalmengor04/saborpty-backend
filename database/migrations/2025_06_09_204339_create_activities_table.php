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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('firebase_uid');
            $table->string('type'); // Ej: "favorite"
            $table->text('description'); // Ej: "Guardaste Arroz con Pollo"
            $table->json('data')->nullable(); // Ej: { "recipe_id": 1 }
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
