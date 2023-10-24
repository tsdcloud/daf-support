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
        Schema::create('recipe_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('apporteur');
            $table->string('raison_sociale')->nullable();
            $table->string('numero_contribuable')->nullable();
            $table->unsignedBigInteger('contact')->nullable();
            $table->decimal('montant',15,2)->nullable();
            $table->enum('provenance', ['règlement de facture','caution sur opération','vente sur site','déposit client'])->default('règlement de facture');
            $table->enum('mode_paiment', ['espèces','paiement mobile','chèque bancaire','virement bancaire','carte bancaire'])->default('espèces');
            $table->enum('statut', ['en attente','validée par contrôleur','encaissé','validée par apporteur'])->default('en attente');
            $table->string('num_comptable')->nullable();
            $table->unsignedBigInteger('comptable')->nullable();
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
            $table->foreignId('entity_id')->constrained()->nullable();
            $table->foreignId('city_entity_id')->constrained()->nullable();
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
        Schema::dropIfExists('recipe_sheets');
    }
};
