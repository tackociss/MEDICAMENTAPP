<div class="container-xl">
    <!-- Page Title -->
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Tableau de bord Médecin</h1>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Recherche de Médicaments Card -->
        <div class="col-12 col-lg-6">
            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                        <div class="col-auto">
                            <h4 class="app-card-title">Recherche Rapide</h4>
                        </div>
                    </div>
                </div>
                <div class="app-card-body px-4 w-100">
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="item-label">
                                    <form id="searchForm" class="search-form">
                                        <div class="input-group">
                                            <input type="text" id="searchInput" class="form-control"
                                                placeholder="Rechercher un médicament..." aria-label="Rechercher">
                                            <button class="btn app-btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques Card -->
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
                            <h4 class="app-card-title">Statistiques</h4>
                        </div>
                    </div>
                </div>
                <div class="app-card-body px-4 w-100">
                    <div class="item border-bottom py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="stats-container">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="stat-box text-center p-3">
                                                <h3 class="stats-number">{{ $medicaments->total() ?? 0 }}</h3>
                                                <p class="stats-text">Médicaments disponibles</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stat-box text-center p-3">
                                                <h3 class="stats-number">{{ $medicaments->count() ?? 0 }}</h3>
                                                <p class="stats-text">Résultats affichés</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <h4 class="app-card-title">Liste des Médicaments</h4>
                </div>
                <div class="col-auto">
                    <div class="card-header-action">
                        <div class="dropdown">
                            <button class="btn app-btn-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filtrer par
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-sort="nom">Nom Commercial</a></li>
                                <li><a class="dropdown-item" href="#" data-sort="prix">Prix</a></li>
                                <li><a class="dropdown-item" href="#" data-sort="classe">Classe Thérapeutique</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nom Commercial</th>
                            <th>DCI/Principe actif</th>
                            <th>Classe thérapeutique</th>
                            <th>Forme Galénique</th>
                            <th>Dosage</th>
                            <th>Prix</th>
                            <th>Tarif réf. SEN-CSU</th>
                            <th>Taux PEC</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicaments as $medicament)
                            <tr>
                                <td>{{ $medicament->Nom_commercial }}</td>
                                <td>{{ $medicament->DCI_Principe_actif }}</td>
                                <td>{{ $medicament->Classe_th_rapeutique }}</td>
                                <td>{{ $medicament->Forme_gal_nique }}</td>
                                <td>{{ $medicament->Dosage }}</td>
                                <td>{{ number_format((float)$medicament->Prix_MAJ, 2) }} FCFA</td>
                                <td>{{ number_format((float) $medicament->TARIF_REF_SENCSU, 2, ',', ' ') }} FCFA</td>
                                <td>{{ $medicament->TAUX_PEC_SEN_CSU }}%</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info view-details" data-id="{{ $medicament->id }}"
                                        data-bs-toggle="modal" data-bs-target="#medicamentModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Aucun médicament trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $medicaments->onEachSide(1)->links() }}
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
                        <p><strong>Nom Commercial:</strong> <span id="modal-nom"></span></p>
                        <p><strong>DCI/Principe actif:</strong> <span id="modal-dci"></span></p>
                        <p><strong>Classe thérapeutique:</strong> <span id="modal-classe"></span></p>
                        <p><strong>Sous-classe:</strong> <span id="modal-sous-classe"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Forme Galénique:</strong> <span id="modal-forme"></span></p>
                        <p><strong>Dosage:</strong> <span id="modal-dosage"></span></p>
                        <p><strong>Prix:</strong> <span id="modal-prix"></span></p>
                        <p><strong>Taux de prise en charge:</strong> <span id="modal-taux"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


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
                window.location.href =
                    `{{ route('medecin') }}?search=${encodeURIComponent(searchTerm)}`;
            }
        });

        // Gestionnaire pour le modal de détails
        const viewButtons = document.querySelectorAll('.view-details');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const medicamentId = this.dataset.id;
                fetch(`/medecin/medicaments/${medicamentId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modal-nom').textContent = data
                            .Nom_commercial;
                        document.getElementById('modal-dci').textContent = data
                            .DCI_Principe_actif;
                        document.getElementById('modal-classe').textContent = data
                            .Classe_th_rapeutique;
                        document.getElementById('modal-sous-classe').textContent = data
                            .Sous_classe;
                        document.getElementById('modal-forme').textContent = data
                            .Forme_gal_nique;
                        document.getElementById('modal-dosage').textContent = data.Dosage;
                        document.getElementById('modal-prix').textContent =
                            `${data.Prix_MAJ} FCFA`;
                        document.getElementById('modal-taux').textContent =
                            `${data.TAUX_PEC_SEN_CSU}%`;
                    })
                    .catch(error => console.error('Erreur:', error));
            });
        });

        // Gestionnaire de tri
        const sortLinks = document.querySelectorAll('[data-sort]');
        sortLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const sortBy = this.dataset.sort;
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('sort', sortBy);
                window.location.href = currentUrl.toString();
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .app-card {
        border-radius: 0.5rem;
    }

    .app-card-basic {
        height: 100%;
    }

    .stats-container {
        width: 100%;
    }

    .stat-box {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
    }

    .stats-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: #5d6778;
        margin-bottom: 0.5rem;
    }

    .stats-text {
        color: #9fa7b5;
        font-size: 0.875rem;
        margin-bottom: 0;
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

    .view-details {
        padding: 0.25rem 0.5rem;
    }

    .view-details i {
        font-size: 0.875rem;
    }

    .pagination {
        margin: 0;
        gap: 3px;
    }

    .pagination .page-item .page-link {
        padding: 0.3rem 0.7rem;
        font-size: 0.875rem;
        line-height: 1.4;
        color: #5d6778;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        transition: all 0.2s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: #20c997;
        border-color: #20c997;
        color: #fff;
        font-weight: 500;
    }

    .pagination .page-item .page-link:hover {
        background-color: #e9ecef;
        color: #20c997;
        border-color: #20c997;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
        opacity: 0.7;
    }

    .mt-3 {
        margin-top: 1rem !important;
        display: flex;
        justify-content: center;
    }
</style>
