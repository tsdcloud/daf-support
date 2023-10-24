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
        Schema::create('material_realise_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('availability_request_sheet_id');
            $table->foreignId('wordinavailability_request_sheet_id');
            $table->foreignId('beneficiaire');
            $table->foreignId('chef_depart');
            $table->string('designation')->nullable();
            $table->unsignedBigInteger('quantite_compta_mat')->nullable();
            $table->unsignedBigInteger('quantite_reliquat')->nullable();
            $table->string('motif')->nullable();
            $table->date('date_debut_usage')->nullable();
            $table->string('service_demandeur')->nullable();
            $table->string('numero_bon_sortie')->nullable();
            $table->string('date_sortie')->nullable();
            $table->enum('statut', ['en attente','reçu','archivee'])->default('en attente');
            $table->unsignedBigInteger('comptable_matiere')->nullable();
            $table->unsignedBigInteger('compteur')->nullable();
            $table->unsignedBigInteger('exercice')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreignId('city_entity_id')->nullable();//enleverla contrainte
            $table->foreignId('site_id')->nullable();
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
        Schema::dropIfExists('material_realise_forms');
    }
};
