<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('authenfication.login');
    }

    /**
     * Traite la tentative de connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'signin-email' => ['required', 'email'],
            'signin-password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['signin-email'],
            'password' => $credentials['signin-password']
        ], $request->boolean('RememberPassword'))) {
            $request->session()->regenerate();

            // Redirection basée sur le profil de l'utilisateur
            $user = Auth::user();
            switch ($user->profil) {
                case 'ADMIN':
                    return redirect()->route('admin.admin');
                case 'PHARMACIEN':
                    return redirect()->route('pharmacien.dashboard');
                case 'MEDECIN':
                    return redirect()->route('medecin');
                case 'BENEFICIAIRE':
                    return redirect()->route('beneficiaire.dashboard');
                default:
                    return redirect()->route('admin.admin');
            }
        }

        return back()->withErrors([
            'signin-email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('signin-email');
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Affiche le formulaire de réinitialisation du mot de passe
     */
    public function showResetPasswordForm()
    {
        return view('authenfication.reset-password');
    }
}
