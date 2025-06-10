<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;
use App\Imports\MedicamentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;



class pharmacienControler extends Controller
{
    public function pharmacien(Request $request)
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

        return view('pharmacien.pharmacien', [
            'medicaments' => $medicaments,
            'searchTerm' => $request->search ?? ''
        ]);
    }

    // Affiche le formulaire d'ajout de médicament

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
            'Tarif_ref_SEN_CSU ' => 'nullable|numeric|min:0',
            'Taux_pec_SEN_CSU ' => 'nullable|numeric|min:0',
            'Recherche'=> 'nullable|string|max:255'
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
}
