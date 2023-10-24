<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('recipe_sheets', function (Blueprint $table) {
            $table->dropForeign(['city_entity_id']);
            // $table->dropColumn('city_entity_id');
        });
        // Schema::table('recipe_sheets', function (Blueprint $table) {
        //     $table->foreignId('city_entity_id')->constrained("city_entity")->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('recipe_sheets', function (Blueprint $table) {
        //     $table->dropConstrainedForeignId('city_entity_id');
        // });
    }
};
