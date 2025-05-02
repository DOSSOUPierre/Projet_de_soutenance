<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesRecettesTable extends Migration
{
    public function up()
    {
        Schema::create('categories_recettes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');  // Nom de la catégorie
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories_recettes');
    }
}