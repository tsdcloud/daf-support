<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('fiche_approvisionnement_caisses', function (Blueprint $table) {
            if (Schema::hasColumn('fiche_approvisionnement_caisses','montant')){
                DB::statement("ALTER TABLE fiche_approvisionnement_caisses ALTER COLUMN montant
                TYPE decimal(15,2) USING montant::decimal(15,2)");
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fiche_approvisionnement_caisses', function (Blueprint $table) {
            //
        });
    }
};
