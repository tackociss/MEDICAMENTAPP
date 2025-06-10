<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicament;

use App\Imports\MedicamentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class MedecinController extends Controller
{
    public function medecin(Request $request)
    {
        $query = Medicament::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('Nom_commercial', 'like', '%' . $searchTerm . '%')
                    ->orWhere('DCI_Principe_actif', 'like', '%' . $searchTerm . '%');
            });

            $query->orderBy('DCI_Principe_actif')
                ->orderBy('Forme_gal_nique')
                ->orderBy('Dosage')
                ->orderBy('Prix_MAJ');
        } else {
            $query->orderBy('Nom_commercial');
        }

        $medicaments = $query->paginate(10);
        $medicaments->appends(request()->query());

        return view('medecin.medcin', [
            'medicaments' => $medicaments,
            'searchTerm' => $request->search ?? ''
        ]);
    }

    // Recherche en temps réel - se déclenche après 3 caractères
    public function autocomplete(Request $request)
    {
        $searchTerm = $request->get('query');

        // Vérifier que la recherche contient au moins 3 caractères
        if (strlen($searchTerm) < 3) {
            return response()->json([
                'message' => 'Veuillez saisir au moins 3 caractères',
                'results' => []
            ]);
        }

        try {
            $results = Medicament::where(function($query) use ($searchTerm) {
                $query->where('Nom_commercial', 'like', $searchTerm . '%')
                    ->orWhere('DCI_Principe_actif', 'like', $searchTerm . '%')
                    ->orWhere('Classe_th_rapeutique', 'like', $searchTerm . '%')
                    ->orWhere('Sous_classe', 'like', $searchTerm . '%')
                    ->orWhere('Forme_gal_nique', 'like', $searchTerm . '%');
            })
            ->select([
                'id',
                'Nom_commercial',
                'DCI_Principe_actif',
                'Classe_th_rapeutique',
                'Sous_classe',
                'Forme_gal_nique',
                'Dosage',
                'Prix_MAJ'
            ])
            ->limit(15)
            ->get();

            // Formatage des résultats pour l'affichage
            $formattedResults = $results->map(function($medicament) {
                return [
                    'id' => $medicament->id,
                    'nom_commercial' => $medicament->Nom_commercial,
                    'dci_principe_actif' => $medicament->DCI_Principe_actif,
                    'classe_therapeutique' => $medicament->Classe_th_rapeutique,
                    'sous_classe' => $medicament->Sous_classe,
                    'forme_galenique' => $medicament->Forme_gal_nique,
                    'dosage' => $medicament->Dosage,
                    'prix' => $medicament->Prix_MAJ,
                    'label' => $medicament->Nom_commercial . ' - ' . $medicament->DCI_Principe_actif,
                    'value' => $medicament->Nom_commercial
                ];
            });

            return response()->json([
                'message' => 'Résultats trouvés',
                'count' => $formattedResults->count(),
                'results' => $formattedResults
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche en temps réel:', [
                'message' => $e->getMessage(),
                'search_term' => $searchTerm,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Erreur lors de la recherche',
                'error' => $e->getMessage(),
                'results' => []
            ], 500);
        }
    }

    // Recherche avancée en temps réel avec filtres multiples
    public function searchAdvanced(Request $request)
    {
        $searchTerm = $request->get('query');
        $filters = $request->get('filters', []);

        if (strlen($searchTerm) < 3) {
            return response()->json([
                'message' => 'Veuillez saisir au moins 3 caractères',
                'results' => []
            ]);
        }

        try {
            $query = Medicament::query();

            // Recherche principale
            $query->where(function($q) use ($searchTerm) {
                $q->where('Nom_commercial', 'like', '%' . $searchTerm . '%')
                  ->orWhere('DCI_Principe_actif', 'like', '%' . $searchTerm . '%')
                  ->orWhere('Classe_th_rapeutique', 'like', '%' . $searchTerm . '%');
            });

            // Application des filtres additionnels
            if (isset($filters['classe_therapeutique']) && !empty($filters['classe_therapeutique'])) {
                $query->where('Classe_th_rapeutique', 'like', '%' . $filters['classe_therapeutique'] . '%');
            }

            if (isset($filters['forme_galenique']) && !empty($filters['forme_galenique'])) {
                $query->where('Forme_gal_nique', 'like', '%' . $filters['forme_galenique'] . '%');
            }

            if (isset($filters['prix_min']) && is_numeric($filters['prix_min'])) {
                $query->where('Prix_MAJ', '>=', $filters['prix_min']);
            }

            if (isset($filters['prix_max']) && is_numeric($filters['prix_max'])) {
                $query->where('Prix_MAJ', '<=', $filters['prix_max']);
            }

            $results = $query->select([
                'id',
                'Nom_commercial',
                'DCI_Principe_actif',
                'Classe_th_rapeutique',
                'Sous_classe',
                'Forme_gal_nique',
                'Dosage',
                'Prix_MAJ',
                'TARIF_REF_SENCSU',
                'TAUX_PEC_SEN_CSU'
            ])
            ->limit(20)
            ->get();

            return response()->json([
                'message' => 'Recherche avancée effectuée',
                'count' => $results->count(),
                'results' => $results
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche avancée:', [
                'message' => $e->getMessage(),
                'search_term' => $searchTerm,
                'filters' => $filters
            ]);

            return response()->json([
                'message' => 'Erreur lors de la recherche avancée',
                'error' => $e->getMessage(),
                'results' => []
            ], 500);
        }
    }

    // Suggestions de recherche basées sur les termes populaires
    public function suggestions(Request $request)
    {
        $partialTerm = $request->get('query');

        if (strlen($partialTerm) < 2) {
            return response()->json([
                'suggestions' => []
            ]);
        }

        try {
            // Suggestions basées sur les noms commerciaux
            $nomCommercialSuggestions = Medicament::where('Nom_commercial', 'like', $partialTerm . '%')
                ->distinct()
                ->limit(5)
                ->pluck('Nom_commercial');

            // Suggestions basées sur les DCI
            $dciSuggestions = Medicament::where('DCI_Principe_actif', 'like', $partialTerm . '%')
                ->distinct()
                ->limit(5)
                ->pluck('DCI_Principe_actif');

            // Suggestions basées sur les classes thérapeutiques
            $classeSuggestions = Medicament::where('Classe_th_rapeutique', 'like', $partialTerm . '%')
                ->distinct()
                ->limit(3)
                ->pluck('Classe_th_rapeutique');

            $allSuggestions = collect()
                ->merge($nomCommercialSuggestions)
                ->merge($dciSuggestions)
                ->merge($classeSuggestions)
                ->unique()
                ->take(10)
                ->values();

            return response()->json([
                'suggestions' => $allSuggestions
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la génération des suggestions:', [
                'message' => $e->getMessage(),
                'partial_term' => $partialTerm
            ]);

            return response()->json([
                'suggestions' => []
            ]);
        }
    }

    // Enregistre un nouveau médicament
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nom_commercial' => 'required|string|max:255',
            'DCI_Principe_actif' => 'required|string|max:255',
            'Classe_th_rapeutique' => 'nullable|string|max:255',
            'Sous_classe' => 'nullable|string|max:255',
            'Forme_gal_nique' => 'nullable|string|max:255',
            'Dosage' => 'nullable|string|max:255',
            'Prix_MAJ' => 'nullable|numeric|min:0',
            'Tarif_ref_SEN_CSU' => 'nullable|numeric|min:0',
            'Taux_pec_SEN_CSU' => 'nullable|numeric|min:0',
            'Recherche'=> 'nullable|string|max:255'
        ]);

        try {
            $medicament = Medicament::create($validated);

            return redirect()->route('medicament.medicament')->with('success', 'Médicament ajouté avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'ajout du médicament:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du médicament : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $medicament = Medicament::findOrFail($id);
            return response()->json($medicament);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Médicament non trouvé'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $medicament = Medicament::findOrFail($id);

            $validated = $request->validate([
                'Nom_commercial' => 'required|string|max:255',
                'DCI_Principe_actif' => 'required|string|max:255',
                'Classe_th_rapeutique' => 'nullable|string|max:255',
                'Sous_classe' => 'nullable|string|max:255',
                'Forme_gal_nique' => 'nullable|string|max:255',
                'Dosage' => 'nullable|string|max:255',
                'Prix_MAJ' => 'nullable|numeric|min:0',
                'Tarif_ref_SEN_CSU' => 'nullable|numeric|min:0',
                'Taux_pec_SEN_CSU' => 'nullable|numeric|min:0'
            ]);

            $medicament->update($validated);

            return redirect()->route('medicament.medicament')->with('success', 'Médicament mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du médicament:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour du médicament : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $medicament = Medicament::findOrFail($id);
            $medicament->delete();
            return redirect()->back()->with('success', 'Médicament supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du médicament:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Erreur lors de la suppression du médicament : ' . $e->getMessage());
        }
    }
}