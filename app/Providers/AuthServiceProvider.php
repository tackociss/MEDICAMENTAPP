<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Medicament;
use App\Policies\MedicamentPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Medicament::class => MedicamentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Définir des gates personnalisées si nécessaire
        Gate::define('manage-medicaments', function ($user) {
            return in_array($user->role, ['ADMIN', 'PHARMACIEN']);
        });

        Gate::define('view-dashboard', function ($user) {
            return in_array($user->role, ['ADMIN', 'PHARMACIEN', 'MEDECIN', 'BENEFICIAIRE']);
        });
    }
}
