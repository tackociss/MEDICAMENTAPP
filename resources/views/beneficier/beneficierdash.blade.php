@extends('beneficier.beneficier')

@section('content')
<div class="app-wrapper">
    <div class="app-content p-md-2 p-lg-3">
<div class="container-xl">
    <!-- Page Title -->
            <div class="row g-3 mb-3 align-items-center justify-content-between">
                <div class="col">
                    <h1 class="app-page-title mb-0">Tableau de Bord Bénéficiaire</h1>
        </div>
    </div>

            <!-- Stats Cards -->
            <div class="row g-3 mb-3">
                <!-- Carte Profil -->
        <div class="col-12 col-lg-6">
            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                        <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                        <div class="col-auto">
                                    <h4 class="app-card-title">Mon Profil</h4>
                        </div>
                    </div>
                </div>
                <div class="app-card-body px-4 w-100">
                    <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="profile-info p-3">
                                            <div class="row mb-3">
                                                <div class="col-auto">
                                                    <div class="profile-image">
                                                        <img src="{{ auth()->user()->photo ?? asset('assets/images/default-avatar.png') }}"
                                                             alt="Photo de profil"
                                                             class="rounded-circle"
                                                             style="width: 80px; height: 80px; object-fit: cover;">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h4 class="mb-1">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h4>
                                                    <p class="text-muted mb-2">
                                                        <i class="fas fa-id-card me-2"></i>
                                                        N° Bénéficiaire: <strong>{{ auth()->user()->id }}</strong>
                                                    </p>
                                                    <span class="badge bg-success">Compte Actif</span>
                                                </div>
                                            </div>
                                            <div class="contact-info">
                                                <p class="mb-2">
                                                    <i class="fas fa-envelope me-2"></i>
                                                    {{ auth()->user()->email }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="fas fa-phone me-2"></i>
                                                    {{ auth()->user()->telephone ?? 'Non renseigné' }}
                                                </p>
                                                <p class="mb-0">
                                                    <i class="fas fa-calendar me-2"></i>
                                                    Membre depuis: {{ auth()->user()->created_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

                <!-- Carte Statistiques -->
        <div class="col-12 col-lg-6">
            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Mes Statistiques</h4>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="stats-list">
                                <div class="stats-item border-bottom py-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="stats-figure me-2">
                                                <i class="fas fa-pills text-primary"></i>
                                            </div>
                                            <h4 class="stats-title">Médicaments Remboursés</h4>
                                            <div class="stats-meta">Ce mois</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stats-value">{{ $stats['medicaments_rembourses'] ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stats-item border-bottom py-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="stats-figure me-2">
                                                <i class="fas fa-money-bill-wave text-success"></i>
                                            </div>
                                            <h4 class="stats-title">Montant Total Remboursé</h4>
                                            <div class="stats-meta">Ce mois</div>
                        </div>
                        <div class="col-auto">
                                            <div class="stats-value">{{ number_format(($stats['montant_rembourse'] ?? 0), 0, ',', ' ') }} FCFA</div>
                        </div>
                    </div>
                </div>
                                <div class="stats-item py-2">
                        <div class="row align-items-center">
                            <div class="col">
                                            <div class="stats-figure me-2">
                                                <i class="fas fa-hospital-user text-info"></i>
                                            </div>
                                            <h4 class="stats-title">Consultations</h4>
                                            <div class="stats-meta">Ce mois</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stats-value">{{ $stats['consultations'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- Recherche et Filtres -->
            <div class="app-card app-card-orders-table shadow-sm mb-4">
        <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                            <h4 class="app-card-title">Rechercher des Médicaments</h4>
                        </div>
                    </div>
                </div>
                <div class="app-card-body p-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <form id="searchForm" class="search-form">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text"
                                           id="searchInput"
                                           class="form-control form-control-lg"
                                           placeholder="Rechercher un médicament..."
                                           aria-label="Rechercher">
                                    <button type="submit" class="btn app-btn-primary">Rechercher</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="filters d-flex flex-wrap gap-2">
                                <select class="form-select" id="filterSelect">
                                    <option value="">Tous les médicaments</option>
                                    <option value="taux_eleve" {{ request('filter') == 'taux_eleve' ? 'selected' : '' }}>Taux PEC élevé</option>
                                    <option value="prix_croissant" {{ request('filter') == 'prix_croissant' ? 'selected' : '' }}>Prix croissant</option>
                                    <option value="prix_decroissant" {{ request('filter') == 'prix_decroissant' ? 'selected' : '' }}>Prix décroissant</option>
                                </select>
                                <select class="form-select" id="formeGaleniqueSelect">
                                    <option value="">Toutes les formes galéniques</option>
                                    <option value="COMPRIME" {{ request('forme_galenique') == 'COMPRIME' ? 'selected' : '' }}>Comprimé</option>
                                    <option value="SIROP" {{ request('forme_galenique') == 'SIROP' ? 'selected' : '' }}>Sirop</option>
                                    <option value="INJECTABLE" {{ request('forme_galenique') == 'INJECTABLE' ? 'selected' : '' }}>Injectable</option>
                                    <option value="SUSPENSION" {{ request('forme_galenique') == 'SUSPENSION' ? 'selected' : '' }}>Suspension</option>
                                    <option value="GELULE" {{ request('forme_galenique') == 'GELULE' ? 'selected' : '' }}>Gélule</option>
                                    <option value="POMMADE" {{ request('forme_galenique') == 'POMMADE' ? 'selected' : '' }}>Pommade</option>
                                    <option value="SOLUTION" {{ request('forme_galenique') == 'SOLUTION' ? 'selected' : '' }}>Solution</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des Médicaments -->
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Médicaments Disponibles</h4>
                        </div>
                    </div>
                </div>
        <div class="app-card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Médicament</th>
                            <th>Forme</th>
                            <th>Dosage</th>
                            <th>Prix Public</th>
                            <th>Montant Remboursé</th>
                            <th>Reste à Payer</th>
                            <th>Taux PEC</th>
                            <th class="text-center">Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicaments as $medicament)
                        <tr>
                            <td>
                                <div class="medicament-info">
                                    <strong>{{ $medicament->Nom_commercial }}</strong>
                                    <div class="small text-muted">{{ $medicament->DCI_Principe_actif }}</div>
                                </div>
                            </td>
                            <td>{{ $medicament->Forme_gal_nique }}</td>
                            <td>{{ $medicament->Dosage }}</td>
                                    <td>{{ number_format((float)$medicament->Prix_MAJ, 2, ',', ' ') }} FCFA</td>
                                    <td>{{ number_format((float)$medicament->Prix_MAJ * (float)$medicament->TAUX_PEC_SEN_CSU / 100, 2, ',', ' ') }} FCFA</td>
                                    <td>{{ number_format((float)$medicament->Prix_MAJ * (1 - (float)$medicament->TAUX_PEC_SEN_CSU / 100), 2, ',', ' ') }} FCFA</td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $medicament->TAUX_PEC_SEN_CSU }}%;"
                                        aria-valuenow="{{ $medicament->TAUX_PEC_SEN_CSU }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ $medicament->TAUX_PEC_SEN_CSU }}%
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info view-details"
                                    data-id="{{ $medicament->id }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#medicamentModal">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Aucun médicament trouvé</p>
                                        </div>
                                    </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                        {{ $medicaments->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Détails Médicament -->
<div class="modal fade" id="medicamentModal" tabindex="-1" aria-labelledby="medicamentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicamentModalLabel">Détails du Médicament</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-group mb-3">
                            <h6 class="fw-bold">Information Générale</h6>
                            <p><strong>Nom Commercial:</strong> <span id="modal-nom"></span></p>
                            <p><strong>DCI/Principe actif:</strong> <span id="modal-dci"></span></p>
                            <p><strong>Classe thérapeutique:</strong> <span id="modal-classe"></span></p>
                            <p><strong>Sous-classe:</strong> <span id="modal-sous-classe"></span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-group mb-3">
                            <h6 class="fw-bold">Détails de Prise en Charge</h6>
                            <p><strong>Prix Public:</strong> <span id="modal-prix"></span></p>
                            <p><strong>Montant Remboursé:</strong> <span id="modal-rembourse"></span></p>
                            <p><strong>Reste à Payer:</strong> <span id="modal-reste"></span></p>
                            <p><strong>Taux de Prise en Charge:</strong> <span id="modal-taux"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestionnaire de recherche
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const searchTerm = searchInput.value.trim();
        if (searchTerm) {
            window.location.href = `{{ route('beneficiaire.dashboard') }}?search=${encodeURIComponent(searchTerm)}`;
        }
    });

    // Gestionnaire de filtre
    const filterSelect = document.getElementById('filterSelect');
    const formeGaleniqueSelect = document.getElementById('formeGaleniqueSelect');

    filterSelect.addEventListener('change', function() {
        updateFilters();
    });

    formeGaleniqueSelect.addEventListener('change', function() {
        updateFilters();
    });

    function updateFilters() {
        const currentUrl = new URL(window.location.href);
        if (filterSelect.value) {
            currentUrl.searchParams.set('filter', filterSelect.value);
        } else {
            currentUrl.searchParams.delete('filter');
        }

        if (formeGaleniqueSelect.value) {
            currentUrl.searchParams.set('forme_galenique', formeGaleniqueSelect.value);
        } else {
            currentUrl.searchParams.delete('forme_galenique');
        }

        window.location.href = currentUrl.toString();
    }

    // Gestionnaire pour le modal de détails
    const viewButtons = document.querySelectorAll('.view-details');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const medicamentId = this.dataset.id;
            fetch(`/beneficiaire/medicaments/${medicamentId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-nom').textContent = data.Nom_commercial;
                    document.getElementById('modal-dci').textContent = data.DCI_Principe_actif;
                    document.getElementById('modal-classe').textContent = data.Classe_th_rapeutique;
                    document.getElementById('modal-sous-classe').textContent = data.Sous_classe;
                    document.getElementById('modal-prix').textContent = `${data.Prix_MAJ} FCFA`;

                    const montantRembourse = data.Prix_MAJ * data.TAUX_PEC_SEN_CSU / 100;
                    const resteAPayer = data.Prix_MAJ - montantRembourse;

                    document.getElementById('modal-rembourse').textContent = `${montantRembourse.toFixed(2)} FCFA`;
                    document.getElementById('modal-reste').textContent = `${resteAPayer.toFixed(2)} FCFA`;
                    document.getElementById('modal-taux').textContent = `${data.TAUX_PEC_SEN_CSU}%`;
                })
                .catch(error => console.error('Erreur:', error));
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.app-card {
    border-radius: 0.5rem;
    background: #fff;
}

.app-card-basic {
    height: 100%;
}

.profile-info {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
}

.stats-list .stats-item {
    padding: 1rem;
    transition: all 0.3s ease;
}

.stats-list .stats-item:hover {
    background-color: #f8f9fa;
}

.stats-figure {
    width: 40px;
    height: 40px;
    background: #edf2f7;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 1rem;
}

.stats-title {
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.stats-meta {
    font-size: 0.75rem;
    color: #6c757d;
}

.stats-value {
    font-size: 1.25rem;
    font-weight: 600;
    color: #20c997;
}

.search-form {
    width: 100%;
}

.app-icon-holder {
    width: 45px;
    height: 45px;
    background: #edf2f7;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.5rem;
}

.app-icon-holder i {
    font-size: 1.25rem;
    color: #5d6778;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.medicament-info {
    line-height: 1.3;
}

.progress {
    border-radius: 1rem;
}

.view-details {
    padding: 0.25rem 0.5rem;
}

.view-details i {
    font-size: 0.875rem;
}

.pagination {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
}

.pagination .page-item .page-link {
    padding: 0.5rem 1rem;
    color: #5d6778;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    transition: all 0.3s ease;
}

.pagination .page-item .page-link:hover {
    background-color: #e9ecef;
    color: #20c997;
    border-color: #20c997;
}

.pagination .page-item.active .page-link {
    background-color: #20c997;
    border-color: #20c997;
    color: #fff;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
}

.pagination-container {
    background-color: #fff;
    padding: 1rem;
    border-top: 1px solid #dee2e6;
    margin-top: 1rem;
}

.pagination-info {
    text-align: center;
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.info-group {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
}

.info-group h6 {
    color: #5d6778;
    margin-bottom: 1rem;
}

.empty-state {
    padding: 2rem;
    text-align: center;
}

.contact-info i {
    width: 20px;
    text-align: center;
    color: #6c757d;
}

.filters {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
}
</style>
@endpush
