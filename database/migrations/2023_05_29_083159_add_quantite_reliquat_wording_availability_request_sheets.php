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
        Schema::table('wording_availability_request_sheets', function (Blueprint $table) {
            $table->unsignedBigInteger('quantite_reliquat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wording_availability_request_sheets', function (Blueprint $table) {
            $table->dropColumn('quantite_reliquat');
        });
    }
};
