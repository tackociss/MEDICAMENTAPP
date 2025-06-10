<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;
use App\Imports\MedicamentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class MedicamentController extends Controller
{
    public function medicament(Request $request)
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

        return view('admin.medicament', [
            'medicaments' => $medicaments,
            'searchTerm' => $request->search ?? ''
        ]);
    }

    // Affiche le formulaire d'ajout de médicament
    public function create()
    {
        $this->authorize('create', Medicament::class);
        return view('medicaments.create');
    }

    // Enregistre un nouveau médicament
    public function store(Request $request)
    {
        $this->authorize('create', Medicament::class);
        $validated = $request->validate([
            'Nom_commercial' => 'required|string|max:255',
            'DCI_Principe_actif' => 'required|string|max:255',
            'Classe_th_rapeutique' => 'nullable|string|max:255',
            'Sous_classe' => 'nullable|string|max:255',
            'Forme_gal_nique' => 'nullable|string|max:255',
            'Dosage' => 'nullable|string|max:255',
            'Prix_MAJ' => 'nullable|numeric|min:0',
            'TARIF_REF_SENCSU' => 'nullable|numeric|min:0',
            'TAUX_PEC_SEN_CSU' => 'nullable|numeric|min:0',
            'Recherche' => 'nullable|string|max:255'
        ]);

        try {
            $medicament = Medicament::create($validated);

            // Ajout d'un dd() temporaire pour vérifier la création
            dd([
                'medicament_created' => $medicament,
                'validated_data' => $validated
            ]);

            return redirect()->route('medicament.medicament')->with('success', 'Médicament ajouté avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'ajout du médicament:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du médicament : ' . $e->getMessage());
        }
    }

    public function edit(Medicament $medicament)
    {
        $this->authorize('update', $medicament);
        return view('medicaments.edit', compact('medicament'));
    }

    public function update(Request $request, Medicament $medicament)
    {
        $this->authorize('update', $medicament);
            $validated = $request->validate([
                'Nom_commercial' => 'required|string|max:255',
                'DCI_Principe_actif' => 'required|string|max:255',
                'Classe_th_rapeutique' => 'nullable|string|max:255',
                'Sous_classe' => 'nullable|string|max:255',
                'Forme_gal_nique' => 'nullable|string|max:255',
                'Dosage' => 'nullable|string|max:255',
                'Prix_MAJ' => 'nullable|numeric|min:0',
                'TARIF_REF_SENCSU' => 'nullable|numeric|min:0',
                'TAUX_PEC_SEN_CSU' => 'nullable|numeric|min:0'
            ]);

            $medicament->update($validated);

            return redirect()->route('medicament.medicament')->with('success', 'Médicament mis à jour avec succès.');
    }

    public function destroy(Medicament $medicament)
    {
        $this->authorize('delete', $medicament);
        try {
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

    public function search(Request $request)
    {
        try {
            $query = Medicament::query();

            // Recherche par nom commercial ou DCI
            if ($request->has('query') && !empty($request->query('query'))) {
                $searchTerm = $request->query('query');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('Nom_commercial', 'like', '%' . $searchTerm . '%')
                        ->orWhere('DCI_Principe_actif', 'like', '%' . $searchTerm . '%');
                });
            }

            // Filtre par catégorie (classe thérapeutique)
            if ($request->has('categorie') && !empty($request->categorie)) {
                $query->where('Classe_th_rapeutique', 'like', '%' . $request->categorie . '%');
            }

            // Filtre par forme galénique
            if ($request->has('forme_galenique') && !empty($request->forme_galenique)) {
                $query->where('Forme_gal_nique', 'like', '%' . $request->forme_galenique . '%');
            }

            // Filtre par taux de prise en charge
            if ($request->has('taux') && !empty($request->taux)) {
                $taux = $request->taux;
                $query->where(function ($q) use ($taux) {
                    switch ($taux) {
                        case '0.7':
                            $q->where('TAUX_PEC_SEN_CSU', '>=', 0.7);
                            break;
                        case '0.5':
                            $q->whereBetween('TAUX_PEC_SEN_CSU', [0.5, 0.69]);
                            break;
                        case '0.3':
                            $q->whereBetween('TAUX_PEC_SEN_CSU', [0.3, 0.49]);
                            break;
                        case '0.1':
                            $q->where('TAUX_PEC_SEN_CSU', '<', 0.3);
                            break;
                    }
                });
            }

            // Filtre par dosage
            if ($request->has('dosage') && !empty($request->dosage)) {
                $query->where('Dosage', 'like', '%' . $request->dosage . '%');
            }

            // Tri par défaut
       $query->orderBy('TARIF_REF_SENCSU', 'asc');


            // Limite pour éviter de surcharger
            $medicaments = $query->limit(100)->get();

            // Log pour le débogage
            Log::info('Recherche de médicaments', [
                'request' => $request->all(),
                'count' => $medicaments->count(),
                'first_result' => $medicaments->first()
            ]);

            return response()->json([
                'success' => true,
                'data' => $medicaments,
                'count' => $medicaments->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche de médicaments:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la recherche',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
