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
        // Schema::table('fiche_depenses', function (Blueprint $table) {
        //     if (Schema::hasColumn('fiche_depenses','ref_compte')){
        //         DB::statement("ALTER TABLE fiche_depenses MODIFY COLUMN ref_compte TYPE BIGINT NOT NULL CHECK (ref_compte> 0)");
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
