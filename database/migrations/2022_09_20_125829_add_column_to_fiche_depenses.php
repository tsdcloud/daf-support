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
        Schema::table('fiche_depenses', function (Blueprint $table) {
            $table->string('code_tiers')->nullable();
            $table->string('section_analytique')->nullable();
            $table->string('num_cheque_virement')->nullable();
            $table->string('ref_compte')->nullable();
            $table->decimal('montant_dette', 15, 2)->nullable();
            $table->decimal('retenu_source', 15, 2)->nullable();
            $table->string('num_attestation')->nullable();
            $table->decimal('montant_a_payer', 15, 2)->nullable();
            $table->string('num_facture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fiche_depenses', function (Blueprint $table) {
            $table->dropColumn('code_tiers');
            $table->dropColumn('section_analytique');
            $table->dropColumn('num_cheque_virement');
            $table->dropColumn('ref_compte');
            $table->dropColumn('montant_dette');
            $table->dropColumn('retenu_source');
            $table->dropColumn('num_attestation');
            $table->dropColumn('montant_a_payer');
            $table->dropColumn('num_facture');
        });
    }
};
