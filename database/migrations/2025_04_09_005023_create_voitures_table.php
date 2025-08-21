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
        Schema::create('voitures', function (Blueprint $table) {
            $table->id(); 
            $table->string('matricule')->unique();
            $table->string('marque');
            $table->string('modele');
            $table->unsignedTinyInteger('nbre_place');
            $table->string('transmission');
            $table->string('type_carburant');
            $table->integer('prix_chauffeur_jour');
            $table->integer('prix_voiture_jour');
            $table->string('image_voiture');
            $table->unsignedBigInteger('proprietaire_id');
            $table->timestamps();
        
            $table->foreign('proprietaire_id')->references('id')->on('proprietaires')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
