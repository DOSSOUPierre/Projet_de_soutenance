<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('visualisations', function (Blueprint $table) {
            $table->id();
            $table->string('type');  // Type de la visualisation (par exemple, 'graphique', 'tableau')
            $table->json('data');    // Données liées à la visualisation (par exemple, les points du graphique)
            $table->timestamps();    // Timestamps pour garder une trace de quand la visualisation a été générée
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visualisations');
    }
};
