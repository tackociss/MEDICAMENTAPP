<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Medicament;

class MedicamentPolicy
{
    /**
     * Determine si l'utilisateur peut voir les médicaments
     */
    public function viewAny(User $user)
    {
        return true; // Tout utilisateur authentifié peut voir la liste
    }

    /**
     * Determine si l'utilisateur peut voir un médicament spécifique
     */
    public function view(User $user, Medicament $medicament)
    {
        return true; // Tout utilisateur authentifié peut voir les détails
    }

    /**
     * Determine si l'utilisateur peut créer des médicaments
     */
    public function create(User $user)
    {
        return $user->role === 'ADMIN' || $user->role === 'PHARMACIEN';
    }

    /**
     * Determine si l'utilisateur peut modifier un médicament
     */
    public function update(User $user, Medicament $medicament)
    {
        return $user->role === 'ADMIN' || $user->role === 'PHARMACIEN';
    }

    /**
     * Determine si l'utilisateur peut supprimer un médicament
     */
    public function delete(User $user, Medicament $medicament)
    {
        return $user->role === 'ADMIN';
    }

    /**
     * Determine si l'utilisateur peut exporter les médicaments
     */
    public function export(User $user)
    {
        return $user->role === 'ADMIN' || $user->role === 'PHARMACIEN';
    }

    /**
     * Determine si l'utilisateur peut importer des médicaments
     */
    public function import(User $user)
    {
        return $user->role === 'ADMIN';
    }
}
