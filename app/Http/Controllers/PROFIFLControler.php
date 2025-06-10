<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class PROFIFLControler extends Controller
{
    public function profil()
    {
        return view('profil.moncompte');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('avatar')) {
                // Supprimer l'ancienne photo si elle existe
                if (Auth::user()->avatar) {
                    Storage::disk('public')->delete(Auth::user()->avatar);
                }

                // Enregistrer la nouvelle photo
                $path = $request->file('avatar')->store('avatars', 'public');
                Auth::user()->update(['avatar' => $path]);

                return redirect()->back()->with('success', 'Photo de profil mise à jour avec succès');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de la photo');
        }
    }

    public function updateNom(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        try {
            Auth::user()->update(['nom' => $request->nom]);
            return redirect()->back()->with('success', 'Nom mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du nom');
        }
    }

    public function updatePrenom(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255'
        ]);

        try {
            Auth::user()->update(['prenom' => $request->prenom]);
            return redirect()->back()->with('success', 'Prénom mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du prénom');
        }
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id()
        ]);

        try {
            Auth::user()->update(['email' => $request->email]);
            return redirect()->back()->with('success', 'Email mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'email');
        }
    }

    public function updateTelephone(Request $request)
    {
        $request->validate([
            'telephone' => 'required|string|max:20'
        ]);

        try {
            Auth::user()->update(['telephone' => $request->telephone]);
            return redirect()->back()->with('success', 'Numéro de téléphone mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du numéro de téléphone');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        try {
            // Vérifier l'ancien mot de passe
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return redirect()->back()->with('error', 'Le mot de passe actuel est incorrect');
            }

            Auth::user()->update(['password' => Hash::make($request->password)]);
            return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du mot de passe');
        }
    }

    public function updateSpecialite(Request $request)
    {
        $request->validate([
            'specialite' => 'required|string|max:255'
        ]);

        try {
            Auth::user()->update(['specialite' => $request->specialite]);
            return redirect()->back()->with('success', 'Spécialité mise à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de la spécialité');
        }
    }
}
