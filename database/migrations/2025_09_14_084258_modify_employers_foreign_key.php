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
        Schema::table('employers', function (Blueprint $table) {
        // Supprimer la contrainte existante
            $table->dropForeign(['departement_id']);
        });

        Schema::table('employers', function (Blueprint $table) {
        // (Optionnel) Rendre le champ nullable si tu veux utiliser 'set null'
        // $table->unsignedBigInteger('departement_id')->nullable()->change();

        // Ajouter la nouvelle contrainte avec comportement
            $table->foreign('departement_id')
              ->references('id')
              ->on('departements')
              ->onDelete('cascade'); // ou 'set null'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
