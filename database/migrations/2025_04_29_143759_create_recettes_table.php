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
        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('objet');
            $table->decimal('montant', 10, 2); // Montant avec précision
            $table->string('telephone');
            $table->foreignId('categorie_id')->constrained('categorie_recettes')->onDelete('cascade'); // Clé étrangère
            $table->tinyInteger('archiver')->default(0); // Champ d'archivage
            $table->timestamps();
            $table->softDeletes(); // Support des suppressions douces
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recettes');
    }
};
