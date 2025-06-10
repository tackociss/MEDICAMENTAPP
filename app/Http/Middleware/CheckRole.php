<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Si l'utilisateur a l'un des rôles autorisés
        if(in_array($user->profil, $roles)) {
            return $next($request);
        }

        // Rediriger vers la page appropriée en fonction du rôle de l'utilisateur
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
                return redirect()->route('login');
        }
    }
}
