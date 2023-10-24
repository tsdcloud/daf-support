<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('fiche_approvisionnement_caisses', function (Blueprint $table) {
        //     //
        // });
        DB::statement("ALTER TABLE fiche_approvisionnement_caisses DROP CONSTRAINT fiche_approvisionnement_caisses_statut_check");

        $types = ['en attente', 'validée par approvisionneur', 'encaissé'];
        $result = join( ', ', array_map(function ($value){
            return sprintf("'%s'::character varying", $value);
        }, $types));

        DB::statement("ALTER TABLE fiche_approvisionnement_caisses ADD CONSTRAINT fiche_approvisionnement_caisses_statut_check CHECK (statut::text = ANY (ARRAY[$result]::text[]))");
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
