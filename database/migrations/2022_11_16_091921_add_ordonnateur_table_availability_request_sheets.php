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
            $table->unsignedBigInteger('ordonateur')->nullable();
            $table->string('ordonateur_rejet')->nullable();

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
            $table->dropColumn('ordonateur');
            $table->dropColumn('ordonateur_rejet');

        });
    }
};
