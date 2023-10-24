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
        Schema::table('availability_request_sheets', function (Blueprint $table) {
            $table->unsignedBigInteger('comptable_matier')->nullable();
            $table->string('controleur_observation')->nullable();
            $table->string('chef_depart_observation')->nullable();
            $table->string('comptable_matier_observation')->nullable();
            $table->string('user_observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('availability_request_sheets', function (Blueprint $table) {
            $table->dropColumn('comptable_matier');
            $table->dropColumn('controleur_observation');
            $table->dropColumn('chef_depart_observation');
            $table->dropColumn('comptable_matier_observation');
            $table->dropColumn('user_observation');
        });
    }
};
