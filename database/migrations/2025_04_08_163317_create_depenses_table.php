<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('objet');
            $table->decimal('montant', 10, 2);  // Montant de la dépense avec une précision
            $table->string('telephone');
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');  // Clé étrangère vers la table categories
            $table->tinyInteger('archiver')->default(0);  // Modification ici pour un tinyInteger
    
            $table->timestamps();
            $table->softDeletes();  // Ajout du support des suppressions douces
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('depenses');
    }
}
