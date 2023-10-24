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
        Schema::create('wording_availability_request_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('availability_request_sheet_id')->constrained(); // enlever les contraintes
            $table->string('designation')->nullable();
            $table->double('quantite')->nullable();
            $table->string('motif')->nullable();
            $table->unsignedBigInteger('beneficiaire');
            $table->date('date_debut_usage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wording_availability_request_sheets');
    }
};
