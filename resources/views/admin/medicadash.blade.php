<div id="medicamentFormCollapse" class="collapse @if (session('collapseForm')) show @endif">
    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration mt-5" role="alert"
        style="max-width: 800px; margin: 2rem auto 0;">
        <div class="inner">
            <div class="app-card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 id="form-title" class="mb-0">Nouveau Médicament</h3>
                    <button type="button" class="btn-close" data-bs-toggle="collapse"
                        data-bs-target="#medicamentFormCollapse" aria-label="Close"></button>
                </div>
                <div class="auth-form-container text-start mx-auto">
                    <form class="auth-form auth-signup-form" action="{{ route('medicament.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @isset($medicament)
                            @method('PUT')
                        @endisset
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom commercial</label>
                                <input type="text" name="Nom_commercial"
                                    class="form-control @error('Nom_commercial') is-invalid @enderror" required>
                                @error('Nom_commercial')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DCI/Principe actif</label>
                                <input type="text" name="DCI_Principe_actif"
                                    class="form-control @error('DCI_Principe_actif') is-invalid @enderror" required>
                                @error('DCI_Principe_actif')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Classe thérapeutique</label>
                                <input type="text" name="Classe_th_rapeutique"
                                    class="form-control @error('Classe_th_rapeutique') is-invalid @enderror">
                                @error('Classe_th_rapeutique')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sous classe</label>
                                <input type="text" name="Sous_classe"
                                    class="form-control @error('Sous_classe') is-invalid @enderror">
                                @error('Sous_classe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Forme galénique</label>
                                <input type="text" name="Forme_gal_nique"
                                    class="form-control @error('Forme_gal_nique') is-invalid @enderror">
                                @error('Forme_gal_nique')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dosage</label>
                                <input type="text" name="Dosage"
                                    class="form-control @error('Dosage') is-invalid @enderror">
                                @error('Dosage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Prix MAJ</label>
                                <input type="number" step="0.01" name="Prix_MAJ"
                                    class="form-control @error('Prix_MAJ') is-invalid @enderror">
                                @error('Prix_MAJ')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tarif ref SEN CSU</label>
                                <input type="number" step="0.01" name="Tarif_ref_SEN_CSU"
                                    class="form-control @error('Tarif_ref_SEN_CSU') is-invalid @enderror">
                                @error('Tarif_ref_SEN_CSU')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Taux pec SEN CSU</label>
                                <input type="number" step="0.01" name="Taux_pec_SEN_CSU"
                                    class="form-control @error('Taux_pec_SEN_CSU') is-invalid @enderror">
                                @error('Taux_pec_SEN_CSU')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">
                                <i class="fas fa-save me-2"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                    <form action="" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="fichier_excel" class="form-control" accept=".xlsx, .xls"
                                required>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-file-import me-2"></i>Importer Excel
                            </button>
                        </div>
                        @error('fichier_excel')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Gestion des Médicaments</h1>
            </div>
            <div>
                <div class="page-utilities">
                    <div class="row g-2 justify-content-end align-items-center">
                        <div class="col-12 mb-3">
                            <div class="app-card shadow-sm mb-4">
                                <div class="app-card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-12 ">
                                            <div class="search-box">
                                                <i class="fas fa-search search-icon"></i>
                                                <input type="text" id="search-medicament"
                                                    class="form-control form-control-lg"
                                                    placeholder="Rechercher un médicament...">
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div class="filters-container">
                                                <div class="row g-2 flex-nowrap">
                                                    <div class="col">

                                                    </div>
                                                    <div class="col-3">
                                                        <div class="filter-group">
                                                            <div class="filter-icon">
                                                                <i class="fas fa-pills"></i>
                                                            </div>
                                                            <label class="filter-label">Classe Thérapeutique</label>
                                                            <select id="categorie-filter"
                                                                class="form-select form-select-sm">
                                                                <option value="">Toute les classes thérapeutiques
                                                                </option>
                                                                <option value="ANTIBIOTIQUES">Antibiotiques</option>
                                                                <option value="ANALGESIQUES">Analgésiques</option>
                                                                <option value="ANTIFONGIQUES">Antifongiques</option>
                                                                <option value="ANTIHISTAMINIQUES">Antihistaminiques
                                                                </option>
                                                                <option value="ANTIPARASITAIRES">Antiparasitaires
                                                                </option>
                                                                <option value="MEDICAMENTS_OPHTALMIQUES">Médicaments
                                                                    ophtalmiques</option>
                                                                <option value="MEDICAMENTS_OTOLOGIQUES">Médicaments
                                                                    otologiques</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="filter-group">
                                                            <div class="filter-icon">
                                                                <i class="fas fa-capsules"></i>
                                                            </div>
                                                            <label class="filter-label">Forme Galénique</label>
                                                            <select id="forme-galenique-filter"
                                                                class="form-select form-select-sm">
                                                                <option value="">Toutes les formes</option>
                                                                <option value="COMPRIME">Comprimé</option>
                                                                <option value="SIROP">Sirop</option>
                                                                <option value="INJECTABLE">Injectable</option>
                                                                <option value="SUSPENSION">Suspension</option>
                                                                <option value="GELULE">Gélule</option>
                                                                <option value="POMMADE">Pommade</option>
                                                                <option value="SOLUTION">Solution</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="filter-group">
                                                            <div class="filter-icon">
                                                                <i class="fas fa-percent"></i>
                                                            </div>
                                                            <label class="filter-label">Taux PEC</label>
                                                            <select id="taux-filter"
                                                                class="form-select form-select-sm">
                                                                <option value="">Tous les taux</option>
                                                                <option value="0.7">70% et plus</option>
                                                                <option value="0.5">50% - 69%</option>
                                                                <option value="0.3">30% - 49%</option>
                                                                <option value="0.1">Moins de 30%</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="filter-group">
                                                            <div class="filter-icon">
                                                                <i class="fas fa-prescription-bottle"></i>
                                                            </div>
                                                            <label class="filter-label">Dosage</label>
                                                            <input type="text" id="dosage-filter"
                                                                class="form-control form-control-sm"
                                                                placeholder="Ex: 500mg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 text-center">
                                            <button id="search-button" class="btn btn-primary me-2">
                                                <i class="fas fa-search me-2"></i>Rechercher
                                            </button>
                                            <button id="reset-button" class="btn btn-light">
                                                <i class="fas fa-undo-alt me-2"></i>Réinitialiser les filtres
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button id="add-medicament-button" class="btn app-btn-primary" data-bs-toggle="collapse"
                                data-bs-target="#medicamentFormCollapse">
                                <i class="fas fa-plus me-1"></i>Nouveau Médicament
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <div id="result-count" class="text-muted">
                        {{ count($medicaments) }} résultat(s) trouvé(s)
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-4 ps-4 fs-5 fw-bold">Nom Commercial</th>
                                <th class="py-4 fs-5 fw-bold">DCI</th>
                                <th class="py-4 fs-5 fw-bold">Classe thérapeutique</th>
                                <th class="py-4 fs-5 fw-bold">Forme Galénique</th>
                                <th class="py-4 fs-5 fw-bold">Dosage</th>
                                <th class="py-4 fs-5 fw-bold">Prix</th>
                                <th class="py-4 fs-5 fw-bold">Tarif réf. SEN-CSU</th>
                                <th class="py-4 fs-5 fw-bold">Taux</th>
                                <th class="py-4 fs-5 fw-bold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="medicaments-table-body">
                            @forelse($medicaments as $medicament)
                                <tr class="border-top">
                                    <td class="ps-4 py-3 fw-bold text-primary">{{ $medicament->Nom_commercial }}</td>
                                    <td class="py-3">{{ $medicament->DCI_Principe_actif }}</td>
                                    <td class="py-3">{{ $medicament->Classe_th_rapeutique }}</td>
                                    <td class="py-3">{{ $medicament->Forme_gal_nique }}</td>
                                    <td class="py-3">{{ $medicament->Dosage }}</td>
                                    <td class="py-3">{{ $medicament->Prix_MAJ }} FCFA</td>
                                    <td class="py-3">{{ $medicament->TARIF_REF_SENCSU }} FCFA</td>
                                    <td class="py-3"><strong>
                                            {{ explode('.', number_format($medicament->TAUX_PEC_SEN_CSU, 2, '.', ''))[1] ?? '00' }}%
                                        </strong> </td>

                                    <td class="py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-warning edit-button"
                                                data-id="{{ $medicament->id }}"
                                                data-url="{{ route('medicament.edit', $medicament->id) }}"
                                                data-bs-toggle="tooltip" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('medicament.destroy', $medicament->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Confirmer la suppression ?')"
                                                    data-bs-toggle="tooltip" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3"></i>
                                        <p>Aucun médicament trouvé</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <nav class="app-pagination">
        <ul class="pagination justify-content-center">
            @if ($medicaments->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" tabindex="-1" aria-disabled="true">
                        <i class="fas fa-chevron-left me-1"></i> Précédent
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $medicaments->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left me-1"></i> Précédent
                    </a>
                </li>
            @endif

            @foreach ($medicaments->links()->elements[0] as $page => $url)
                @if ($page == $medicaments->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            @if ($medicaments->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $medicaments->nextPageUrl() }}" rel="next">
                        Suivant <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-disabled="true">
                        Suivant <i class="fas fa-chevron-right ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>


<style>
    :root {
        --app-green: #20c997;
    }

    /* Réduction des espacements généraux */
    .app-content {
        padding-top: 0.5rem !important;
    }

    .mb-4 {
        margin-bottom: 0.5rem !important;
    }

    .mb-3 {
        margin-bottom: 0.25rem !important;
    }

    /* Optimisation de la barre de recherche */
    .search-box {
        margin-bottom: 0.5rem;
    }

    #search-medicament {
        height: 2rem;
        padding: 0.25rem 1rem;
        font-size: 0.875rem;
    }

    /* Réduction de la taille des filtres */
    .filter-group {
        background: #fff;
        border-radius: 6px;
        padding: 0.5rem;
        margin-top: 12px;
        min-height: auto;
    }

    .filter-icon {
        top: -12px;
        width: 24px;
        height: 24px;
        font-size: 0.8rem;
    }

    .filter-label {
        margin: 0.15rem 0 0.25rem;
        font-size: 0.75rem;
    }

    /* Réduction des inputs et selects */
    .filter-group input,
    .filter-group select,
    .input-group-text {
        padding: 0.25rem;
        font-size: 0.75rem;
        height: 1.75rem;
    }


    /* Optimisation des espacements de la grille */
    .row.g-4 {
        --bs-gutter-x: 0.5rem;
        --bs-gutter-y: 0.25rem;
    }

    .row.g-3 {
        --bs-gutter-y: 0.25rem;
    }

    /* Réduction des boutons */
    .btn {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Optimisation du conteneur des filtres */
    .filters-container {
        padding: 0.5rem;
        background: #fff;
        border-radius: 8px;
    }

    .app-card {
        margin-bottom: 0.5rem;
    }

    .app-card-body {
        padding: 0.5rem;
    }

    /* Ajustement des espacements entre les groupes de filtres */
    .col-md-3 {
        padding: 0 0.25rem;
    }

    /* Réduction de l'espacement des boutons de recherche */
    .row.mt-4 {
        margin-top: 0.5rem !important;
    }

    .col-12.text-center {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }

    /* Optimisation pour mobile */
    @media (max-width: 768px) {
        .filter-group {
            margin-top: 8px;
            padding: 0.35rem;
        }

        .col-md-3 {
            margin-bottom: 0.25rem;
        }

        .app-card-body {
            padding: 0.35rem;
        }
    }

    /* Réduction de la hauteur du header */
    .app-page-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem !important;
    }

    /* Optimisation des marges du tableau */
    .table {
        margin-top: 0.5rem;
    }

    .table thead th {
        padding: 0.5rem;
        font-size: 0.8rem;
    }

    .table td {
        padding: 0.5rem;
        font-size: 0.875rem;
    }

    .filter-group {
        background: #fff;
        border-radius: 8px;
        padding: 0.75rem;
        /* Réduit de 1.5rem à 0.75rem */
        position: relative;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
        margin-top: 15px;
        /* Réduit de 25px à 15px */
        cursor: pointer;
    }

    .filter-group:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(32, 201, 151, 0.1);
    }

    .filter-group:active,
    .filter-group:focus-within {
        border-color: var(--app-green);
        box-shadow: 0 0 0 3px rgba(32, 201, 151, 0.25);
    }

    .filter-icon {
        position: absolute;
        top: -15px;
        /* Réduit de -20px à -15px */
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        /* Réduit de 40px à 30px */
        height: 30px;
        /* Réduit de 40px à 30px */
        background: linear-gradient(45deg, var(--app-green), #23e7b0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        /* Réduit de 1.2rem à 1rem */
        box-shadow: 0 2px 6px rgba(32, 201, 151, 0.3);
        transition: all 0.3s ease;
    }

    .filter-group:hover .filter-icon {
        transform: translateX(-50%) scale(1.1);
        box-shadow: 0 6px 15px rgba(32, 201, 151, 0.4);
    }

    .filter-label {
        text-align: center;
        display: block;
        margin: 0.25rem 0 0.5rem;
        /* Réduit les marges */
        font-weight: 600;
        font-size: 0.85rem;
        /* Légèrement réduit */
        color: #495057;
        transition: color 0.3s ease;
    }

    .filter-group:hover .filter-label {
        color: var(--app-green);
    }

    .filter-group input,
    .filter-group select {
        padding: 0.35rem;
        /* Réduit de 0.5rem à 0.35rem */
        font-size: 0.85rem;
        /* Légèrement réduit */
        border: 1px solid #ced4da;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        border-color: var(--app-green);
        box-shadow: 0 0 0 3px rgba(32, 201, 151, 0.25);
        outline: none;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-color: #ced4da;
        color: #495057;
        transition: all 0.3s ease;
    }

    .filter-group:focus-within .input-group-text {
        border-color: var(--app-green);
        color: var(--app-green);
    }

    .search-box {
        margin-bottom: 1rem;
        /* Réduit de 2rem à 1rem */
    }

    .search-box .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--app-green);
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    #search-medicament {
        height: 2.5rem;
        /* Réduit de 3rem à 2.5rem */
        border-radius: 1.25rem;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    #search-medicament:focus {
        border-color: var(--app-green);
        box-shadow: 0 0 0 3px rgba(32, 201, 151, 0.25);
    }

    #search-medicament:focus+.search-icon {
        transform: translateY(-50%) scale(1.1);
    }

    .reset-button {
        background: linear-gradient(45deg, var(--app-green), #23e7b0);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .reset-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(32, 201, 151, 0.3);
    }

    .filter-counter {
        background: linear-gradient(45deg, var(--app-green), #23e7b0);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 1rem;
        box-shadow: 0 2px 5px rgba(32, 201, 151, 0.2);
    }

    .active-filters-count {
        font-weight: bold;
        margin-left: 0.5rem;
    }

    /* Animation pour les conteneurs au clic */
    .filter-group:active {
        transform: scale(0.98);
    }

    /* Style pour le focus des select */
    .filter-group select {
        cursor: pointer;
    }

    .filter-group select:focus {
        border-color: var(--app-green);
        box-shadow: 0 0 0 3px rgba(32, 201, 151, 0.25);
    }

    /* Amélioration des options du select */
    .filter-group select option:checked {
        background: linear-gradient(45deg, var(--app-green), #23e7b0);
        color: white;
    }

    .table {
        margin-top: 1.5rem;
    }

    .table thead th {
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.75rem;
        border: none;
        white-space: nowrap;
    }

    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    .btn-group .btn {
        padding: 0.4375rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Style pour les filtres en ligne */
    .filters-inline {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .filter-item {
        flex: 1;
        min-width: 200px;
    }

    .filter-item label {
        display: block;
        margin-bottom: 0.5rem;
    }

    /* Style pour le groupe de prix */
    .price-group {
        display: flex;
        gap: 0.5rem;
    }

    .price-group input {
        width: 50%;
    }

    .app-card {
        background: #fff;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        /* Réduit de 1.5rem à 1rem */
    }

    .app-card-body {
        padding: 1rem;
        /* Réduit de 1.5rem à 1rem */
    }

    .row.g-3 {
        --bs-gutter-y: 0.5rem;
        /* Réduit l'espacement entre les lignes */
    }

    /* Optimisation de l'espacement des boutons */
    .col-12.text-center {
        padding-top: 0.5rem;
        /* Réduit l'espacement */
        padding-bottom: 0.5rem;
    }

    /* Réduction de la hauteur des inputs dans les groupes */
    .input-group {
        height: auto;
    }

    .input-group input,
    .input-group select {
        height: 2rem;
        /* Hauteur réduite */
    }

    /* Ajustement des marges pour les filtres en responsive */
    @media (max-width: 768px) {
        .col-md-3 {
            margin-bottom: 0.5rem;
            /* Réduit de 1rem à 0.5rem */
        }

        .filter-group {
            margin-top: 10px;
            /* Encore plus réduit en mobile */
            padding: 0.5rem;
            /* Plus compact en mobile */
        }
    }

    /* Styles pour les nouveaux éléments */
    .filter-counter {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        background-color: #f8f9fa;
        border-radius: 0.25rem;
        font-size: 0.875rem;
    }

    .active-filters-count {
        font-weight: bold;
        color: #7367f0;
    }

    .no-results {
        color: #6c757d;
    }

    .row.flex-nowrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        padding-bottom: 5px;
    }

    .row.flex-nowrap::-webkit-scrollbar {
        height: 6px;
    }

    .row.flex-nowrap::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .row.flex-nowrap::-webkit-scrollbar-thumb {
        background: #20c997;
        border-radius: 3px;
    }

    .filter-group {
        background: #fff;
        border-radius: 8px;
        padding: 0.5rem;
        position: relative;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
        margin-top: 15px;
        min-width: 200px;
        height: 100%;
    }

    .filter-group .form-control-sm,
    .filter-group .form-select-sm {
        height: 31px;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .filter-group .input-group-sm {
        width: 120px;
        /* Augmenté de 90px à 120px */
    }

    .filter-group input[type="number"] {
        font-size: 0.9rem !important;
        /* Police plus grande pour les prix */
        font-weight: 500;
        /* Police un peu plus grasse */
        padding: 0.375rem 0.5rem !important;
        /* Plus de padding vertical */
        height: 35px !important;
        /* Hauteur augmentée */
    }

    .filter-group .input-group-text {
        padding: 0.375rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 500;
        height: 35px;
    }

    /* Ajustement spécifique pour le groupe de prix */
    .filter-group .d-flex.gap-1 {
        gap: 0.5rem !important;
    }

    /* Style spécifique pour les inputs de prix */
    #prix-min,
    #prix-max {
        text-align: right;
        padding-right: 0.5rem;
    }

    .filter-label {
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
    }

    .filter-icon {
        width: 24px;
        height: 24px;
        font-size: 0.8rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Éléments DOM avec vérification d'existence
        const searchInput = document.getElementById('search-medicament');
        const prixMin = document.getElementById('prix-min');
        const prixMax = document.getElementById('prix-max');
        const categorieFilter = document.getElementById('categorie-filter');
        const tauxFilter = document.getElementById('taux-filter');
        const dosageFilter = document.getElementById('dosage-filter');
        const formeGaleniqueFilter = document.getElementById('forme-galenique-filter');
        const tableBody = document.getElementById('medicaments-table-body');
        const searchButton = document.getElementById('search-button');
        const resetButton = document.getElementById('reset-button');
        const resultCount = document.getElementById('result-count');

        // Vérifier si les éléments critiques existent
        if (!tableBody) {
            console.error('Élément #medicaments-table-body non trouvé');
            return;
        }

        // Variables pour gérer les requêtes
        let currentRequest = null;
        let isSearching = false;
        let loadingElement = null;

        // Fonction debounce pour la recherche en temps réel
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Fonction pour annuler la requête précédente
        function cancelPreviousRequest() {
            if (currentRequest) {
                currentRequest.abort();
                currentRequest = null;
            }
        }

        // Fonction pour afficher le loading
        function showLoading() {
            if (tableBody && !loadingElement) {
                loadingElement = document.createElement('tr');
                loadingElement.innerHTML = `
                <td colspan="9" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Recherche en cours...</span>
                    </div>
                    <p class="mt-2 text-muted">Recherche en cours...</p>
                </td>
            `;
                tableBody.appendChild(loadingElement);
            }
        }

        // Fonction pour masquer le loading
        function hideLoading() {
            if (loadingElement) {
                loadingElement.remove();
                loadingElement = null;
            }
        }

        // Fonction pour obtenir le token CSRF
        function getCSRFToken() {
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (tokenMeta) {
                return tokenMeta.getAttribute('content');
            }

            const tokenInput = document.querySelector('input[name="_token"]');
            if (tokenInput) {
                return tokenInput.value;
            }

            console.warn('Token CSRF non trouvé');
            return '';
        }

        // Fonction pour effectuer la recherche
        async function performSearch(isQuickSearch = false) {
            // Annuler la requête précédente si elle existe
            cancelPreviousRequest();

            if (isSearching) {
                return;
            }

            isSearching = true;
            showLoading();

            try {
                const searchParams = new URLSearchParams();

                // Ajouter le terme de recherche si présent
                if (searchInput && searchInput.value.trim()) {
                    searchParams.append('query', searchInput.value.trim());
                }

                // Si ce n'est pas une recherche rapide, ajouter tous les filtres
                if (!isQuickSearch) {
                    if (prixMin && prixMin.value.trim()) {
                        searchParams.append('prix_min', prixMin.value.trim());
                    }

                    if (prixMax && prixMax.value.trim()) {
                        searchParams.append('prix_max', prixMax.value.trim());
                    }

                    if (categorieFilter && categorieFilter.value) {
                        searchParams.append('categorie', categorieFilter.value);
                    }

                    if (tauxFilter && tauxFilter.value) {
                        searchParams.append('taux', tauxFilter.value);
                    }

                    if (dosageFilter && dosageFilter.value.trim()) {
                        searchParams.append('dosage', dosageFilter.value.trim());
                    }

                    if (formeGaleniqueFilter && formeGaleniqueFilter.value) {
                        searchParams.append('forme_galenique', formeGaleniqueFilter.value);
                    }
                }

                // Créer le contrôleur d'annulation
                const controller = new AbortController();
                currentRequest = controller;

                // Construire l'URL de recherche - CORRECTION: utiliser le bon nom de route
                const baseUrl = window.location.origin + '/medicaments/search';
                const searchUrl = `${baseUrl}?${searchParams.toString()}`;

                console.log('URL de recherche:', searchUrl);

                const response = await fetch(searchUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCSRFToken()
                    },
                    signal: controller.signal
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.log('Erreur de réponse:', errorText);
                    throw new Error(`Erreur HTTP: ${response.status} - ${response.statusText}`);
                }

                const result = await response.json();
                console.log('Réponse reçue:', result);

                if (result.success) {
                    updateMedicamentsTable(result.data);
                    updateResultCount(result.count);
                    updateFilterCounts();
                } else {
                    throw new Error(result.message || 'La recherche a échoué');
                }
            } catch (error) {
                if (error.name === 'AbortError') {
                    console.log('Requête annulée');
                    return;
                }

                console.error('Erreur lors de la recherche:', error);
                showError('Une erreur est survenue lors de la recherche: ' + error.message);
                showNoResults('Erreur lors de la recherche');
            } finally {
                isSearching = false;
                currentRequest = null;
                hideLoading();
            }
        }

        // Fonction pour mettre à jour le tableau
        function updateMedicamentsTable(data) {
            if (!tableBody) return;

            if (!Array.isArray(data) || data.length === 0) {
                showNoResults();
                return;
            }

            try {
                tableBody.innerHTML = data.map(medicament => {
                    const id = medicament.id || '';
                    const nomCommercial = escapeHtml(medicament.Nom_commercial || '-');
                    const dci = escapeHtml(medicament.DCI_Principe_actif || '-');
                    const classe = escapeHtml(medicament.Classe_th_rapeutique || '-');
                    const forme = escapeHtml(medicament.Forme_gal_nique || '-');
                    const dosage = escapeHtml(medicament.Dosage || '-');
                    const prix = formatMoney(medicament.Prix_MAJ || 0);
                    const tarif = formatMoney(medicament.TARIF_REF_SENCSU || 0);
                    const taux = medicament.TAUX_PEC_SEN_CSU || 0;

                    return `
                    <tr class="border-top">
                        <td class="ps-4 py-3 fw-bold text-primary">${nomCommercial}</td>
                        <td class="py-3">${dci}</td>
                        <td class="py-3">${classe}</td>
                        <td class="py-3">${forme}</td>
                        <td class="py-3">${dosage}</td>
                        <td class="py-3">${prix} FCFA</td>
                        <td class="py-3 fw-bold">${tarif} FCFA</td>
                        <td class="py-3">${taux} %</td>
                        <td class="py-3 text-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-warning edit-button"
                                    data-id="${id}"
                                    data-url="${window.location.origin}/medicaments/${id}/edit"
                                    data-bs-toggle="tooltip" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="${window.location.origin}/medicaments/${id}" method="POST" class="d-inline">
                                    <input type="hidden" name="_token" value="${getCSRFToken()}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Confirmer la suppression ?')"
                                        data-bs-toggle="tooltip" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                `;
                }).join('');

                // Réinitialiser les tooltips après mise à jour
                setTimeout(() => {
                    initTooltips();
                    attachEditHandlers();
                }, 100);

            } catch (error) {
                console.error('Erreur lors de la mise à jour du tableau:', error);
                showNoResults('Erreur lors de l\'affichage des résultats');
            }
        }

        // Fonction pour afficher "aucun résultat"
        function showNoResults(message = 'Aucun médicament trouvé') {
            if (tableBody) {
                tableBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <div class="no-results">
                            <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                            <p class="text-muted">${escapeHtml(message)}</p>
                        </div>
                    </td>
                </tr>
            `;
            }
        }

        // Fonction pour échapper le HTML
        function escapeHtml(unsafe) {
            if (unsafe === null || unsafe === undefined) {
                return '-';
            }
            return unsafe
                .toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Fonction pour formater les montants
        function formatMoney(amount) {
            if (isNaN(amount) || amount === null || amount === undefined) {
                return '0';
            }
            return new Intl.NumberFormat('fr-FR').format(Number(amount));
        }

        // Fonction pour mettre à jour le compteur de résultats
        function updateResultCount(count) {
            if (resultCount) {
                const countNum = Number(count) || 0;
                resultCount.textContent =
                    `${countNum} résultat${countNum > 1 ? 's' : ''} trouvé${countNum > 1 ? 's' : ''}`;
            }
        }

        // Fonction pour afficher les erreurs
        function showError(message) {
            console.error(message);
            // Vous pouvez ajouter une notification toast ici si nécessaire
            alert(message); // Temporaire pour débugger
        }

        // Fonction pour mettre à jour le compteur de filtres actifs
        function updateFilterCounts() {
            let activeFilters = 0;
            if (searchInput && searchInput.value.trim()) activeFilters++;
            if (prixMin && prixMin.value.trim()) activeFilters++;
            if (prixMax && prixMax.value.trim()) activeFilters++;
            if (categorieFilter && categorieFilter.value) activeFilters++;
            if (tauxFilter && tauxFilter.value) activeFilters++;
            if (dosageFilter && dosageFilter.value.trim()) activeFilters++;
            if (formeGaleniqueFilter && formeGaleniqueFilter.value) activeFilters++;

            const filterCountElement = document.querySelector('.active-filters-count');
            if (filterCountElement) {
                filterCountElement.textContent = activeFilters;
            }
        }

        // Initialisation des tooltips
        function initTooltips() {
            try {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                    // Supprimer l'ancien tooltip s'il existe
                    const existingTooltip = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
                    if (existingTooltip) {
                        existingTooltip.dispose();
                    }
                    // Créer un nouveau tooltip
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            } catch (error) {
                console.error('Erreur lors de l\'initialisation des tooltips:', error);
            }
        }

        // Fonction pour gérer l'édition d'un médicament
        function handleEdit(e) {
            e.preventDefault();
            const button = e.currentTarget;
            const medicamentId = button.dataset.id;
            const url = button.dataset.url;

            if (!medicamentId || !url) {
                console.error("Données manquantes:", {
                    medicamentId,
                    url
                });
                return;
            }

            fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCSRFToken()
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur réseau: ' + response.status);
                    return response.json();
                })
                .then(data => {
                    const form = document.querySelector(".auth-form");
                    if (!form) {
                        throw new Error("Formulaire non trouvé");
                    }

                    // Mise à jour des champs du formulaire
                    const fieldMappings = {
                        'Nom_commercial': data.Nom_commercial,
                        'DCI_Principe_actif': data.DCI_Principe_actif,
                        'Classe_th_rapeutique': data.Classe_th_rapeutique,
                        'Sous_classe': data.Sous_classe,
                        'Forme_gal_nique': data.Forme_gal_nique,
                        'Dosage': data.Dosage,
                        'Prix_MAJ': data.Prix_MAJ,
                        'Tarif_ref_SEN_CSU': data.TARIF_REF_SENCSU,
                        'Taux_pec_SEN_CSU': data.TAUX_PEC_SEN_CSU
                    };

                    Object.entries(fieldMappings).forEach(([fieldName, value]) => {
                        const input = form.querySelector(`input[name="${fieldName}"]`);
                        if (input && value !== undefined && value !== null) {
                            input.value = value;
                        }
                    });

                    // Configuration du formulaire pour la mise à jour
                    form.action = `${window.location.origin}/medicaments/${medicamentId}`;

                    // Ajout de la méthode PUT
                    let methodField = form.querySelector('input[name="_method"]');
                    if (!methodField) {
                        methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        form.appendChild(methodField);
                    }
                    methodField.value = 'PUT';

                    // Mise à jour de l'interface
                    const formTitle = document.getElementById('form-title');
                    if (formTitle) {
                        formTitle.textContent = 'Modifier le médicament';
                    }

                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Mettre à jour';
                    }

                    // Affichage du formulaire
                    const collapseElement = document.getElementById('medicamentFormCollapse');
                    if (collapseElement) {
                        const collapse = new bootstrap.Collapse(collapseElement, {
                            show: true
                        });
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showError('Erreur lors de la récupération des données du médicament: ' + error.message);
                });
        }

        // Attacher les gestionnaires d'événements d'édition
        function attachEditHandlers() {
            document.querySelectorAll('.edit-button').forEach(button => {
                button.removeEventListener('click', handleEdit); // Éviter les doublons
                button.addEventListener('click', handleEdit);
            });
        }

        // Fonction de réinitialisation des filtres
        function resetFilters() {
            if (searchInput) searchInput.value = '';
            if (prixMin) prixMin.value = '';
            if (prixMax) prixMax.value = '';
            if (categorieFilter) categorieFilter.value = '';
            if (tauxFilter) tauxFilter.value = '';
            if (dosageFilter) dosageFilter.value = '';
            if (formeGaleniqueFilter) formeGaleniqueFilter.value = '';

            // Effectuer la recherche après réinitialisation
            performSearch(false);
        }

        // Attacher les écouteurs d'événements
        if (searchInput) {
            const debouncedQuickSearch = debounce(() => {
                // CORRECTION: Rechercher même avec moins de 2 caractères
                performSearch(true);
            }, 500); // Augmenté à 500ms pour éviter trop de requêtes

            searchInput.addEventListener('input', debouncedQuickSearch);
        }

        if (searchButton) {
            searchButton.addEventListener('click', (e) => {
                e.preventDefault();
                performSearch(false);
            });
        }

        if (resetButton) {
            resetButton.addEventListener('click', (e) => {
                e.preventDefault();
                resetFilters();
            });
        }

        // Gestion des événements de soumission de formulaire pour éviter les conflits
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.matches(
                    '#search-medicament, #prix-min, #prix-max, #dosage-filter')) {
                e.preventDefault();
                performSearch(false);
            }
        });

        // Initialisation
        initTooltips();
        attachEditHandlers();

        // Effectuer une recherche initiale pour charger tous les médicaments
        performSearch(true);
    });

    // Ajout du code pour empêcher la navigation par historique

</script>

