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
        Schema::create('libelle_retour_caisses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiche_retour_caisse_id')->constrained();
            $table->string('libelle');
            $table->string('dossier');
            $table->double('montant');
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
        Schema::dropIfExists('libelle_retour_caisses');
    }
};
