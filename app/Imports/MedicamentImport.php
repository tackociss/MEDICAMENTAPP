<?php

namespace App\Imports;

use App\Models\Medicament;
use Maatwebsite\Excel\Concerns\ToModel;

class MedicamentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {return new Medicament([
        'nom_commercial' => $row[0],
        'dci_principe_actif' => $row[1],
        'classe_therapeutique' => $row[2],
        'sous_classe' => $row[3],
        'forme_galenique' => $row[4],
        'dosage' => $row[5],
        'prix_Maj' => $row[6],
        'Tarif_ref_SEN_scu' => $row[7],
        'Taux_pec_SEN_csu' => $row[8],
        'recherche' => $row[9],
    ]);
    }
}
