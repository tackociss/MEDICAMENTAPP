<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicament;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MedecinController extends Controller
{
    /**
     * Affiche le tableau de bord du médecin
     */
    public function medecin(Request $request)
    {
        if ($request->ajax()) {
            $query = Medicament::query();

            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('Nom_commercial', 'LIKE', "%{$search}%")
                      ->orWhere('DCI_Principe_actif', 'LIKE', "%{$search}%")
                      ->orWhere('Classe_th_rapeutique', 'LIKE', "%{$search}%");
                });
            }

            $medicaments = $query->orderBy('Prix_MAJ', 'asc')->get();

            return response()->json([
                'medicaments' => $medicaments
            ]);
        }

        $medicaments = Medicament::orderBy('Prix_MAJ', 'asc')->paginate(10);
        return view('medecin.medcin', compact('medicaments'));
    }

    /**
     * Autocomplete pour la recherche de médicaments
     */
    public function autocomplete(Request $request)
    {
        try {
            Log::info('Début de la recherche autocomplete', [
                'request' => $request->all()
            ]);

            $search = $request->input('query');

            if (empty($search)) {
                return response()->json([
                    'error' => 'Le terme de recherche est requis'
                ], 400);
            }

            $medicaments = Medicament::where('Nom_commercial', 'LIKE', "%{$search}%")
                ->orWhere('DCI_Principe_actif', 'LIKE', "%{$search}%")
                ->orWhere('Classe_th_rapeutique', 'LIKE', "%{$search}%")
                ->select([
                    'id',
                    'Nom_commercial',
                    'DCI_Principe_actif',
                    'Classe_th_rapeutique',
                    'Forme_gal_nique',
                    'Dosage',
                    'Prix_MAJ',
                    'TARIF_REF_SENCSU',
                    'TAUX_PEC_SEN_CSU'
                ])
                ->orderBy('Prix_MAJ', 'asc')
                ->get();

            Log::info('Résultats de la recherche:', [
                'search' => $search,
                'count' => $medicaments->count(),
                'first_result' => $medicaments->first(),
                'query' => DB::getQueryLog()
            ]);

            return response()->json($medicaments);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche de médicaments:', [
                'message' => $e->getMessage(),
                'search' => $search ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Une erreur est survenue lors de la recherche',
                'details' => $e->getMessage()
            ], 500);
        }
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
