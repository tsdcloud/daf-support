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
        Schema::table('fiche_retour_caisses', function (Blueprint $table) {
            $table->string('observation_retourneur')->nullable();
            $table->string('observation_caisse')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fiche_retour_caisses', function (Blueprint $table) {
            $table->dropColumn('observation_retourneur');
            $table->dropColumn('observation_caisse');
        });
    }
};
