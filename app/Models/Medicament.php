<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'Classe_th_rapeutique',
        'Sous_classe',
        'DCI_Principe_actif',
        'Dosage',
        'Forme_gal_nique',
        'Nom_commercial',
        'Prix_MAJ',
        'TARIF_REF_SENCSU',
        'TAUX_PEC_SEN_CSU',
        'Recherche'
    ];

    // Désactiver les timestamps si vous ne les utilisez pas
    public $timestamps = true;
}
