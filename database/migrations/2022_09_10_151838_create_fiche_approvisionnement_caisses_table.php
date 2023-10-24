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
        // Schema::dropIfExists('fiche_approvisionnement_caisses');
        Schema::create('fiche_approvisionnement_caisses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('approvisionneur');
            $table->string('initiateur_aprovis')->nullable();
            $table->double('montant');// -----------------------
            // $table->enum('provenance', ['Retrait bancaire', 'Apport en compte courant', 'Emprunt privé', 'Encaissement client', 'versement issu d\'un point de vente'])->default('Retrait bancaire');
            $table->enum('provenance', ['Retrait bancaire', 'Apport en compte courant', 'Emprunt privé', 'Encaissement client'])->default('Retrait bancaire');
            $table->enum('statut', ['en attente','validée'])->default('en attente');
            $table->string('mode_approv')->nullable();
            $table->text('libelle');
            $table->string('ref_piece_approv')->nullable();
            $table->string('compte_banc_concerne')->nullable();
            $table->string('num_dossier')->nullable();
            $table->string('num_comptable')->nullable();
            $table->integer('Contact')->nullable(); // -----------------------
            $table->string('numero_contribuable')->nullable();
            $table->string('fonction')->nullable();


        // 'Contact',
        // 'numero_contribuable',
        // 'fonction',
        // 'Matricule',
        // 'mode_approv',
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
        Schema::dropIfExists('fiche_approvisionnement_caisses');
    }
};
