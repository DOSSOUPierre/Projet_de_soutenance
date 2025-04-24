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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nom de l'utilisateur
            $table->string('telephone', 15);  // Limite la longueur à 15 caractères pour un téléphone
            $table->string('email')->unique();  // Email unique
            $table->string('poste');  // Poste de l'utilisateur
            $table->timestamp('email_verified_at')->nullable();  // Date de vérification de l'email
            $table->string('password');  // Mot de passe
            $table->enum('type', ['user', 'admin'])->default('user');  // Type d'utilisateur, valeur par défaut 'user'
            $table->rememberToken();  // Token de rappel pour la connexion
            $table->timestamps();  // Date de création et de mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
