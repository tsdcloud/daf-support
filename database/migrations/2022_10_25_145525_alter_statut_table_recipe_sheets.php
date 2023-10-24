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
        // Schema::table('recipe_sheets', function (Blueprint $table) {
        //     //
        // });
        DB::statement("ALTER TABLE recipe_sheets DROP CONSTRAINT recipe_sheets_statut_check");

        $types = ['en attente','validée par contrôleur','encaissé','validée par apporteur'];
        $result = join( ', ', array_map(function ($value){
            return sprintf("'%s'::character varying", $value);
        }, $types));

        DB::statement("ALTER TABLE recipe_sheets ADD CONSTRAINT recipe_sheets_statut_check CHECK (statut::text = ANY (ARRAY[$result]::text[]))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_sheets', function (Blueprint $table) {
            //
        });
    }
};
