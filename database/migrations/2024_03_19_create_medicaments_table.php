<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Classe_th_rapeutique')->nullable();
            $table->string('Sous_classe')->nullable();
            $table->string('DCI_Principe_actif')->nullable();
            $table->string('Dosage')->nullable();
            $table->string('Forme_gal_nique')->nullable();
            $table->string('Nom_commercial');
            $table->double('Prix_MAJ', 10, 2);
            $table->double('TARIF_REF_SENCSU', 10, 2);
            $table->double('TAUX_PEC_SEN_CSU', 10, 2);
            $table->string('Recherche')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicaments');
    }
};
