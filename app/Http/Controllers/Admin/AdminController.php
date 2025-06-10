<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord de l'administration
     */
    // public function admin(){
    //     $users = User::orderBy('created_at', 'desc')->get();
    //     return view('admin.template', compact('users'));
    // }

    public function admin(Request $request)
    {
        // Filtres disponibles
        $allowedFilters = ['PHARMACIEN', 'MEDECIN', 'BENEFICIAIRE'];

        // Requête de base
        $query = User::query()
                    ->orderBy('created_at', 'desc')
                    ->when($request->search, function($q) use ($request) {
                        $search = '%'.$request->search.'%';
                        return $q->where(function($subQuery) use ($search) {
                            $subQuery->where('nom', 'like', $search)
                                    ->orWhere('prenom', 'like', $search)
                                    ->orWhere('email', 'like', $search);
                        });
                    })
                    ->when($request->role && in_array($request->role, $allowedFilters),
                        function($q) use ($request) {
                            return $q->where('profil', $request->role);
                        });

        // Pagination
        $users = $query->paginate(10)
                      ->appends($request->except('page'));

        // Calcul des statistiques
        $stats = [
            'total' => User::count(),
            'pharmaciens' => User::where('profil', 'PHARMACIEN')->count(),
            'medecins' => User::where('profil', 'MEDECIN')->count(),
            'beneficiaires' => User::where('profil', 'BENEFICIAIRE')->count(),
            'new_this_week' => User::where('created_at', '>=', now()->subWeek())->count(),
        ];

        return view('admin.template', [
            'users' => $users,
            'stats' => $stats,
            'searchTerm' => $request->search,
            'currentRole' => $request->role
        ]);
    }

    /**
     * Affiche le formulaire de création d'utilisateur
     */
    public function create()
    {
        return view('admin.dashbord');
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'profil' => 'required|string|in:ADMIN,PHARMACIEN,MEDECIN,BENEFICIAIRE',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'profil' => $request->profil,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                return redirect()->route('admin.admin')
                    ->with('success', 'Utilisateur créé avec succès');
            } else {
                return back()->with('error', 'Erreur lors de la création de l\'utilisateur');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur
     */
    public function edit(User $user)
    {
        return response()->json([
            'id' => $user->id,
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'email' => $user->email,
            'profil' => $user->profil
        ]);
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        try {
            // Validation des données
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'profil' => 'required|string|in:ADMIN,PHARMACIEN,MEDECIN,BENEFICIAIRE',
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            // Préparation des données à mettre à jour
            $userData = [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'profil' => $request->profil,
            ];

            // Mise à jour du mot de passe si fourni
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            // Mise à jour de l'utilisateur
            $user->update($userData);

            return redirect()->route('admin.users.edit')
                ->with('success', 'Utilisateur modifié avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la modification: ' . $e->getMessage());
        }
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.admin')
                ->with('success', 'Utilisateur supprimé avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression');
        }
    }
}
