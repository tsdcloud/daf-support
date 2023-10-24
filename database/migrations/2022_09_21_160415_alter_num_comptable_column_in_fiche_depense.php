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
        Schema::table('fiche_depenses', function (Blueprint $table) {
            if (Schema::hasColumn('fiche_depenses','num_comptable')){
                DB::statement("ALTER TABLE fiche_depenses ADD CONSTRAINT MyUniqueConstraint UNIQUE(num_comptable)");
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
        Schema::table('fiche_depenses', function (Blueprint $table) {
            //
        });
    }
};
