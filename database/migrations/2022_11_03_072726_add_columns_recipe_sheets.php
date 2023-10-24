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
            $table->unsignedBigInteger('controlleur')->nullable();
            $table->unsignedBigInteger('caisse')->nullable();
            $table->string('observation_controlleurer')->nullable();
            $table->string('observation_apporteur')->nullable();
            $table->string('observation_caisse')->nullable();

         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_sheets', function (Blueprint $table) {
            $table->dropColumn('controlleur');
            $table->dropColumn('caisse');
            $table->dropColumn('observation_controlleurer');
            $table->dropColumn('observation_apporteur');
            $table->dropColumn('observation_caisse');
        });
    }
};
