<?php

namespace App\Http\Controllers;






use App\Models\Medicament;
use Illuminate\Http\Request;
use App\Imports\MedicamentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class BeneficierControler extends Controller
{
    public function beneficier(Request $request)
    {
        $query = Medicament::query();

        // Recherche par nom ou DCI
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Nom_commercial', 'LIKE', "%{$search}%")
                  ->orWhere('DCI_Principe_actif', 'LIKE', "%{$search}%")
                  ->orWhere('Classe_th_rapeutique', 'LIKE', "%{$search}%");
            });
        }

        // Filtre par forme galénique
        if ($request->has('forme_galenique') && $request->forme_galenique !== '') {
            $query->where('Forme_gal_nique', 'LIKE', "%{$request->forme_galenique}%");
        }

        // Filtre par type de tri
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'taux_eleve':
                    $query->orderBy('TAUX_PEC_SEN_CSU', 'desc');
                    break;
                case 'prix_croissant':
                    $query->orderBy('Prix_MAJ', 'asc');
                    break;
                case 'prix_decroissant':
                    $query->orderBy('Prix_MAJ', 'desc');
                    break;
                default:
                    $query->orderBy('Nom_commercial', 'asc');
            }
        } else {
            $query->orderBy('Nom_commercial', 'asc');
        }

        // Statistiques pour le dashboard
        $stats = [
            'medicaments_rembourses' => 0,
            'montant_rembourse' => 0,
            'consultations' => 0
        ];

        // Pagination avec 8 éléments par page
     $medicaments = $query->orderBy('TARIF_REF_SENCSU', 'asc')
                     ->paginate(8)
                     ->withQueryString();


        return view('beneficier.beneficierdash', compact('medicaments', 'stats'));
    }

    /**
     * Autocomplete pour la recherche de médicaments
     */
    public function autocomplete(Request $request)
    {
        $search = $request->input('query');

        $medicaments = Medicament::where('Nom_commercial', 'LIKE', "%{$search}%")
            ->orWhere('DCI_Principe_actif', 'LIKE', "%{$search}%")
            ->orWhere('Classe_th_rapeutique', 'LIKE', "%{$search}%")
            ->orderBy('Prix_MAJ', 'asc')
            ->get();

        return response()->json($medicaments);
    }

    /**
     * Recherche avancée de médicaments
     */
    public function searchAdvanced(Request $request)
    {
        $query = Medicament::query();

        if ($request->has('nom')) {
            $query->where('nom', 'LIKE', "%{$request->nom}%");
        }

        if ($request->has('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->has('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }

        if ($request->has('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $medicaments = $query->paginate(10);
        return response()->json($medicaments);
    }

    /**
     * Suggestions de médicaments basées sur les critères
     */
    public function suggestions(Request $request)
    {
        $medicaments = Medicament::where('disponible', true)
            ->orderBy('nom')
            ->limit(5)
            ->get();

        return response()->json($medicaments);
    }
}
