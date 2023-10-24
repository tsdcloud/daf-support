<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_depenses', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_etablissement');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('beneficiaire');
            $table->unsignedBigInteger('controlleur');
            $table->unsignedBigInteger('controlleur_conf')->nullable();
            $table->unsignedBigInteger('ordonateur');
            $table->string('destinataire')->nullable();
            $table->enum('statut', ['en attente','en cours_conf','en cours','validée', 'décaissé'])->default('en attente');
            $table->string('montant');
            $table->string('description');
            $table->string('mode_paiment');
            $table->string('numero_contribuable')->nullable();
            $table->string('num_comptable')->nullable();
            $table->string('ordonateur_rejet')->nullable();
            $table->string('controleur_rejet')->nullable();
            $table->string('controleur_conf_rejet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiche_depenses');
    }
};
