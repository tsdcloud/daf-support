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
        // Schema::table('recipe_sheetsexit', function (Blueprint $table) {
        //     //
        // });
        DB::statement("ALTER TABLE recipe_sheets DROP CONSTRAINT recipe_sheets_provenance_check");

        $types = ['règlement de facture','caution sur opération','vente sur site'];
        $result = join( ', ', array_map(function ($value){
            return sprintf("'%s'::character varying", $value);
        }, $types));

        DB::statement("ALTER TABLE recipe_sheets ADD CONSTRAINT recipe_sheets_provenance_check CHECK (provenance::text = ANY (ARRAY[$result]::text[]))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_sheetsexit', function (Blueprint $table) {
            //
        });
    }
};
