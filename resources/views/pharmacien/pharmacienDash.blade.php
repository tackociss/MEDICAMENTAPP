


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- En-tête -->
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">
                    <i class="fas fa-clinic-medical text-primary me-2"></i>
                    Tableau de Bord Pharmacien
                </h1>
            </div>
        </div>

        <!-- Cartes de statistiques -->
        <div class="row g-4 mb-4">
            <!-- Total des ventes -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Ventes du Jour</h4>
                        <div class="stats-figure">{{ number_format($ventesJour ?? 0, 0, ',', ' ') }} FCFA</div>
                        <div class="stats-meta text-success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ordonnances -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Ordonnances</h4>
                        <div class="stats-figure">{{ $ordonnancesJour ?? 0 }}</div>
                        <div class="stats-meta text-primary">
                            <i class="fas fa-file-medical"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Médicaments en rupture -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Ruptures</h4>
                        <div class="stats-figure text-danger">{{ $ruptures ?? 0 }}</div>
                        <div class="stats-meta text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Patients du jour -->
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Patients</h4>
                        <div class="stats-figure">{{ $patientsJour ?? 0 }}</div>
                        <div class="stats-meta text-info">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides et Alertes -->
        <div class="row g-4 mb-4">
            <!-- Actions rapides -->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-basic shadow-sm h-100">
                    <div class="app-card-header p-3">
                        <h4 class="app-card-title">Actions Rapides</h4>
                    </div>
                    <div class="app-card-body p-3">
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="" class="btn btn-primary w-100 mb-2">
                                    <i class="fas fa-plus-circle me-2"></i>Nouvelle Ordonnance
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="" class="btn btn-success w-100 mb-2">
                                    <i class="fas fa-boxes me-2"></i>Gérer le Stock
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="" class="btn btn-info w-100 mb-2">
                                    <i class="fas fa-cash-register me-2"></i>Ventes
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="" class="btn btn-warning w-100 mb-2">
                                    <i class="fas fa-pills me-2"></i>Médicaments
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertes -->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-basic shadow-sm h-100">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Alertes Stock</h4>
                            </div>
                            <div class="col-auto">
                                <span class="badge bg-danger">{{ count($alertes ?? []) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body p-3">
                        <div class="notification-list">
                            @forelse($alertes ?? [] as $alerte)
                            <div class="item p-2 border-bottom">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto">
                                        <div class="app-icon-holder text-danger">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="title mb-1">{{ $alerte->medicament }}</div>
                                        <div class="info">Stock: <span class="text-danger fw-bold">{{ $alerte->stock }}</span></div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                                <p class="text-muted">Aucune alerte de stock</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières ventes -->
        <div class="row g-4">
            <div class="col-12">
                <div class="app-card app-card-basic shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Dernières Ventes</h4>
                            </div>
                            <div class="col-auto">
                                <a href="" class="btn btn-sm btn-primary">
                                    Voir tout <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Patient</th>
                                        <th>Médicaments</th>
                                        <th class="text-end">Montant</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dernieresVentes ?? [] as $vente)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $vente->reference }}</td>
                                        <td>{{ $vente->patient }}</td>
                                        <td>{{ $vente->nb_medicaments }} médicaments</td>
                                        <td class="text-end fw-bold">{{ number_format($vente->montant, 0, ',', ' ') }} FCFA</td>
                                        <td class="text-center">{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-outline-primary" title="Détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-success" title="Imprimer">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="fas fa-shopping-cart text-muted fa-2x mb-2"></i>
                                            <p class="text-muted">Aucune vente aujourd'hui</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #2c7be5;
        --secondary-color: #6e84a3;
        --success-color: #00d97e;
        --danger-color: #e63757;
        --warning-color: #f6c343;
        --info-color: #39afd1;
        --background-color: #f9fbfd;
        --card-bg: #ffffff;
        --border-color: #edf2f9;
        --text-primary: #12263f;
        --text-secondary: #95aac9;
    }

    /* Styles des cartes statistiques */
    .app-card-stat {
        min-height: 100px;
        background: #fff;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .app-card-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08);
    }

    .stats-type {
        font-size: 0.875rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stats-figure {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .stats-meta {
        font-size: 1.5rem;
    }

    /* Styles des cartes */
    .app-card {
        background: #fff;
        border-radius: 0.5rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .app-card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08);
    }

    .app-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    /* Styles des boutons */
    .btn {
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }

    /* Styles du tableau */
    .table thead th {
        background: linear-gradient(to right, var(--background-color), #ffffff);
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-secondary);
        border-bottom: 2px solid var(--border-color);
        padding: 0.75rem;
    }

    .table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    /* Styles des alertes */
    .notification-list .item {
        transition: all 0.2s ease;
    }

    .notification-list .item:hover {
        background-color: var(--background-color);
    }

    .app-icon-holder {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1rem;
        background: rgba(220, 53, 69, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .stats-figure {
            font-size: 1.5rem;
        }

        .btn {
            font-size: 0.875rem;
        }

        .table {
            font-size: 0.875rem;
        }

        .app-card-title {
            font-size: 1rem;
        }
    }
</style>


