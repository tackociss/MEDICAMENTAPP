<?php

namespace App\Imports;

use App\Models\Medicament;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class MedicamentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            // Log des données reçues
            Log::info('Tentative d\'importation de la ligne:', $row);

            // Vérification des données requises
            if (empty($row['Nom_commercial']) || empty($row['DCI_Principe_actif'])) {
                Log::warning('Ligne ignorée - données manquantes:', $row);
                return null;
            }

            // Création du médicament avec les données exactes de la migration
            $medicament = new Medicament([
                'Classe_therapeutique' => $row['Classe_therapeutique'] ?? null,
                'Sous_classe' => $row['Sous_classe'] ?? null,
                'DCI_Principe_actif' => $row['DCI_Principe_actif'],
                'Dosage' => $row['Dosage'] ?? null,
                'Forme_galenique' => $row['Forme_galenique'] ?? null,
                'Nom_commercial' => $row['Nom_commercial'],
                'Prix_Maj' => $row['Prix_Maj'] ?? 0,
                'Tarif_ref_SEN_CSU' => $row['Tarif_ref_SEN_CSU'] ?? 0,
                'Taux_pec_SEN_CSU' => $row['Taux_pec_SEN_CSU'] ?? 0,
                'Recherche' => $row['Recherche'] ?? null,
            ]);

            // Log de succès
            Log::info('Médicament créé avec succès:', ['id' => $medicament->id]);

            return $medicament;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du médicament:', [
                'row' => $row,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}
