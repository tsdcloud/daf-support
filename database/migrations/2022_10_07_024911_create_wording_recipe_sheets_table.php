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
        Schema::create('wording_recipe_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_sheet_id')->constrained();
            $table->string('libelle')->nullable();
            $table->decimal('prix_unitaire',15,2)->nullable();
            $table->double('quantite')->nullable();
            $table->decimal('prix_total',15,2)->nullable();
            $table->string('dossier')->nullable();
            $table->string('site_prod')->nullable();
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
        Schema::dropIfExists('wording_recipe_sheets');
    }
};
