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
        Schema::table('fiche_retour_caisses', function (Blueprint $table) {
            if(Schema::hasColumn('fiche_retour_caisses', 'numero_contribuable')){
                DB::statement("ALTER TABLE fiche_retour_caisses ALTER COLUMN numero_contribuable TYPE VARCHAR(255)");
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
        Schema::table('fiche_retour_caisses', function (Blueprint $table) {
            //
        });
    }
};
