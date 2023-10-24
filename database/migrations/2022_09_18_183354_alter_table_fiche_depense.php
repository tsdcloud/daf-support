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
        // Schema::table('fiche_depenses', function (Blueprint $table) {
        //     if (Schema::hasColumn('fiche_depenses','montant')){
        //         DB::statement("ALTER TABLE fiche_depenses ALTER COLUMN montant
        //          TYPE decimal(15,2) USING montant::decimal(15,2)");
        //     }
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fiche_depenses', function (Blueprint $table) {
            //
        });
    }
};
