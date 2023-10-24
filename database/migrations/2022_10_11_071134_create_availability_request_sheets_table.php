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
        Schema::create('availability_request_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('chef_depart');
            $table->unsignedBigInteger('controlleur');
            $table->string('produit')->nullable();
            $table->string('service_demandeur')->nullable();
            $table->enum('statut', ['en attente','validée chef département ','validée controleur','validée DG','validée président','encaissé'])->default('en attente');
            $table->string('num_dossier')->nullable();
            $table->string('numero_contribuable')->nullable();
            $table->string('chef_depart_rejet')->nullable();
            $table->string('controleur_rejet')->nullable();
            $table->string('dg_rejet')->nullable();
            $table->string('president_rejet')->nullable();
            $table->foreignId('entity_id')->constrained()->nullable();
            $table->string('num_comptable')->nullable();
            $table->double('num_compte_general')->nullable();
            $table->string('code_tiers')->nullable();
            $table->string('section_analytique')->nullable();
            $table->double('num_cheque_virement')->nullable()->nullable();
            $table->string('ref_compte')->nullable();
            $table->decimal('montant_dette',15,2)->nullable();
            $table->decimal('retenu_source',15,2)->nullable();
            $table->string('num_attestation')->nullable();
            $table->decimal('montant_a_payer',15,2)->nullable();
            $table->string('num_facture')->nullable();
            $table->unsignedBigInteger('comptable')->nullable();
            $table->foreignId('city_entity_id')->constrained()->nullable();//enleverla contrainte
            $table->foreignId('site_id')->constrained()->nullable();
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
        Schema::dropIfExists('availability_request_sheets');
    }
};
