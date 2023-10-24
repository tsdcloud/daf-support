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
            // if (Schema::hasColumn('fiche_retour_caisses','reference_fd_original')){
            //     DB::statement("ALTER TABLE fiche_retour_caisses RENAME  COLUMN reference_fd_original TO fiche_depense_id TYPE unsignedBigInteger");
            // }

            // if (Schema::hasColumn('fiche_retour_caisses','date_fd_original')){
            //     DB::statement("ALTER TABLE fiche_retour_caisses DROP COLUMN date_fd_original");
            // }

            $table->dropColumn('reference_fd_original');
            $table->dropColumn('date_fd_original');

            $table->unsignedBigInteger('fiche_depense_id');
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
            $table->dropColumn('fiche_depense_id');
        });
    }
};
