<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil avec les statistiques
     */
    public function index()
    {
        // Récupération des statistiques
        $stats = [
            'medicaments_count' => Medicament::count(),
            'users_count' => User::count(),
            'support_hours' => '24/7'
        ];

        // Récupération des médicaments (sans utiliser created_at)
        $recentMedicaments = Medicament::query()
            ->select(['Nom_commercial', 'DCI_Principe_actif', 'Prix_MAJ'])
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('welcome', compact('stats', 'recentMedicaments'));
    }

    /**
     * Page À propos
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Page de contact
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Traitement du formulaire de contact
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10'
        ]);

        // Ici, vous pouvez ajouter la logique pour envoyer l'email
        // Par exemple avec Mail::to('contact@cmu.sn')->send(new ContactFormMail($validated));

        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
