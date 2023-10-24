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
        DB::statement("ALTER TABLE availability_request_sheets DROP CONSTRAINT availability_request_sheets_statut_check");

        $types = ['en attente','validée par contrôler','validée par ordonnateur','validée par comptable matière ','réçu'];
        $result = join( ', ', array_map(function ($value){
            return sprintf("'%s'::character varying", $value);
        }, $types));

        DB::statement("ALTER TABLE availability_request_sheets ADD CONSTRAINT availability_request_sheets_statut_check CHECK (statut::text = ANY (ARRAY[$result]::text[]))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('availability_request_sheets', function (Blueprint $table) {
            //
        });
    }
};
