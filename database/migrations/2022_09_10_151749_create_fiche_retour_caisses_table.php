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
        // Schema::dropIfExists('fiche_retour_caisses');

        Schema::create('fiche_retour_caisses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('retourneur');
            $table->foreignId('user_id')->constrained();
            $table->double('numero_contribuable')->nullable();
            $table->double('montant');
            $table->double('reliquat')->nullable();
            $table->string('reference_fd_original');
            $table->date('date_fd_original');
            $table->enum('statut', ['en attente' ,'validée par retourneur','encaissé'])->default('en attente');
            $table->string('num_dossier')->nullable();
            $table->string('num_comptable')->nullable();
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
        Schema::dropIfExists('fiche_retour_caisses');
    }
};
