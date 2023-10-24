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
            $table->string('shift')->nullable();
            $table->string('observation_support_partenaire')->nullable();
            $table->string('num_rappot_de_shift')->nullable();
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
            $table->dropColumn('shift');
            $table->dropColumn('observation_support_partenaire');
            $table->dropColumn('num_rappot_de_shift');
        });
    }
};
