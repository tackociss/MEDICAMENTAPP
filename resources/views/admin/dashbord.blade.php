<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title mb-4">VUE GLOBALE</h1>

        <!-- Cartes de statistiques -->
        <div class="row g-4 mb-4">
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 bg-gradient stat-card">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1 text-primary">
                            <i class="fas fa-users fa-lg me-2"></i>TOTAL UTILISATEURS
                        </h4>
                        <div class="stats-figure display-4 fw-bold text-primary counter" data-target="{{ $stats['total'] }}">0</div>
                        <div class="stats-meta text-success">
                            <i class="fas fa-chart-line me-1"></i>
                            <span class="fw-bold counter-small" data-target="{{ $stats['new_this_week'] }}">0</span> nouveaux cette semaine
                        </div>
                    </div>
                    <div class="app-card-footer p-2 bg-primary bg-opacity-10"></div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 bg-gradient stat-card">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1 text-info">
                            <i class="fas fa-user-md fa-lg me-2"></i>TOTAL MEDECIN
                        </h4>
                        <div class="stats-figure display-4 fw-bold text-info counter" data-target="{{ $stats['medecins'] }}">0</div>
                        <div class="stats-meta">
                            <i class="fas fa-stethoscope me-1"></i>
                            <span>Professionnels de santé</span>
                        </div>
                    </div>
                    <div class="app-card-footer p-2 bg-info bg-opacity-10"></div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 bg-gradient stat-card">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1 text-success">
                            <i class="fas fa-user-nurse fa-lg me-2"></i>TOTAL PHARMACIENS
                        </h4>
                        <div class="stats-figure display-4 fw-bold text-success counter" data-target="{{ $stats['pharmaciens'] }}">0</div>
                        <div class="stats-meta">
                            <i class="fas fa-pills me-1"></i>
                            <span>Officines partenaires</span>
                        </div>
                    </div>
                    <div class="app-card-footer p-2 bg-success bg-opacity-10"></div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 bg-gradient stat-card">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1 text-warning">
                            <i class="fas fa-hospital-user fa-lg me-2"></i>TOTAL BENEFICIAIRE
                        </h4>
                        <div class="stats-figure display-4 fw-bold text-warning counter" data-target="{{ $stats['beneficiaires'] }}">0</div>
                        <div class="stats-meta">
                            <i class="fas fa-hand-holding-medical me-1"></i>
                            <span>Patients suivis</span>
                        </div>
                    </div>
                    <div class="app-card-footer p-2 bg-warning bg-opacity-10"></div>
                </div>
            </div>

        </div>

        <!-- Section Utilisateurs -->
        <div id="users-section" class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white border-0 py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">Gestion des Utilisateurs</h5>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <button id="add-user-button" class="btn btn-primary" type="button"
                                data-bs-toggle="collapse" data-bs-target="#userFormCollapse">
                            <i class="fas fa-user-plus me-1"></i> AJOUTER UTILISATEUR
                        </button>
                    </div>
                </div>
            </div>

            <!-- Formulaire Utilisateur (Collapse) -->
            <div id="userFormCollapse" class="collapse @if($errors->any()) show @endif">
                <div class="card-body border-bottom">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 id="user-form-title" class="mb-0">Nouvel Utilisateur</h3>
                        <button type="button" class="btn-close" data-bs-toggle="collapse"
                                data-bs-target="#userFormCollapse" aria-label="Close"></button>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="userForm" class="auth-form" action="" method="POST">
                        @csrf
                        @isset($user)
                            @method('PUT')
                        @endisset

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                                       value="{{ old('nom', $user->nom ?? '') }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                                       value="{{ old('prenom', $user->prenom ?? '') }}" required>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $user->email ?? '') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Profil <span class="text-danger">*</span></label>
                                <select name="profil" class="form-control @error('profil') is-invalid @enderror" required>
                                    <option value="">-- Sélectionnez --</option>
                                    <option value="ADMIN" {{ (old('profil', $user->profil ?? '') == 'ADMIN') ? 'selected' : '' }}>Admin</option>
                                    <option value="PHARMACIEN" {{ (old('profil', $user->profil ?? '') == 'PHARMACIEN') ? 'selected' : '' }}>Pharmacien</option>
                                    <option value="MEDECIN" {{ (old('profil', $user->profil ?? '') == 'MEDECIN') ? 'selected' : '' }}>Médecin</option>
                                    <option value="BENEFICIAIRE" {{ (old('profil', $user->profil ?? '') == 'BENEFICIAIRE') ? 'selected' : '' }}>Bénéficiaire</option>
                                </select>
                                @error('profil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mot de passe @if(isset($user))<small>(laisser vide si inchangé)</small>@else<span class="text-danger">*</span>@endif</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       {{ isset($user) ? '' : 'required' }}>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Confirmation <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       {{ isset($user) ? '' : 'required' }}>
                            </div>

                            <div class="col-12 mt-3">
                                <button id="user-submit-button" type="submit" class="btn btn-success w-100 py-2">
                                    <i class="fas fa-save me-2"></i> Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Barre de recherche et filtres -->
            <div class="card-body bg-light">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <form method="GET" action="" class="row gx-2">
                            <div class="col-8">
                                <input type="text" name="search" class="form-control"
                                       placeholder="Rechercher utilisateur..." value="{{ request('search') }}">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-1"></i> Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end">
                            <select class="form-select w-auto me-2" onchange="window.location.href=this.value">
                                <option value="" {{ !request('role') ? 'selected' : '' }}>Tous les utilisateurs</option>
                                <option value="?role=PHARMACIEN" {{ request('role') == 'PHARMACIEN' ? 'selected' : '' }}>Pharmaciens</option>
                                <option value="?role=MEDECIN" {{ request('role') == 'MEDECIN' ? 'selected' : '' }}>Médecins</option>
                                <option value="?role=BENEFICIAIRE" {{ request('role') == 'BENEFICIAIRE' ? 'selected' : '' }}>Bénéficiaires</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau des utilisateurs -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4">NOM COMPLET</th>
                            <th class="py-3">EMAIL</th>
                            <th class="py-3">PROFIL</th>
                            <th class="py-3">DATE INSCRIPTION</th>
                            <th class="py-3 text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-top">
                                <td class="ps-4 py-3 fw-bold">{{ $user->prenom }} {{ $user->nom }}</td>
                                <td class="py-3">{{ $user->email }}</td>
                                <td class="py-3">
                                    <span class="badge
                                        @if($user->profil == 'ADMIN') bg-primary
                                        @elseif($user->profil == 'PHARMACIEN') bg-success
                                        @elseif($user->profil == 'MEDECIN') bg-info
                                        @else bg-secondary
                                        @endif">
                                        {{ $user->profil }}
                                    </span>
                                </td>
                                <td class="py-3">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary edit-user-button"
                                            data-id="{{ $user->id }}"
                                            data-url="{{ route('admin.users.edit', $user->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Confirmer la suppression ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-slash fa-3x mb-3"></i>
                                    <p>Aucun utilisateur trouvé</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="card-footer bg-white border-0">
                    <nav aria-label="Navigation des pages">
                        <ul class="pagination justify-content-center mb-0">
                            {{-- Lien précédent --}}
                            @if ($users->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Précédent</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">Précédent</a>
                                </li>
                            @endif

                            {{-- Liens numérotés --}}
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                @if ($page == $users->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Lien suivant --}}
                            @if ($users->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">Suivant</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Suivant</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.stat-card {
    transition: all 0.3s ease;
    cursor: pointer;
    overflow: hidden;
    position: relative;
    background: linear-gradient(to bottom right, #ffffff, #f8f9fa);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stat-card:hover {
    transform: translateY(-5px);
}

/* Ombres spécifiques pour chaque type de carte */
.app-card:has(.text-primary) {
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
}

.app-card:has(.text-primary):hover {
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.6) !important;
}

.app-card:has(.text-info) {
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.3);
}

.app-card:has(.text-info):hover {
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.6) !important;
}

.app-card:has(.text-success) {
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.app-card:has(.text-success):hover {
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6) !important;
}

.app-card:has(.text-warning) {
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
}

.app-card:has(.text-warning):hover {
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.6) !important;
}

/* Amélioration des couleurs de fond */
.app-card:has(.text-primary) {
    background: linear-gradient(135deg, #ffffff, #e6f0ff);
}

.app-card:has(.text-info) {
    background: linear-gradient(135deg, #ffffff, #e6f9ff);
}

.app-card:has(.text-success) {
    background: linear-gradient(135deg, #ffffff, #e6ffe6);
}

.app-card:has(.text-warning) {
    background: linear-gradient(135deg, #ffffff, #fff9e6);
}

/* Amélioration des effets de survol */
.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.5),
        transparent
    );
    transition: 0.5s;
}

.counter {
    transition: all 0.3s ease;
    position: relative;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

.counter::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 3px;
    background: currentColor;
    transition: width 0.3s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

.stats-type {
    position: relative;
    display: inline-block;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

.stats-type::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 3px;
    background: currentColor;
    transition: width 0.3s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

.app-card-footer {
    position: relative;
    overflow: hidden;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.app-card-footer::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background: currentColor;
    transition: width 0.3s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const formTitle = document.querySelector("#user-form-title");
    const submitButton = document.querySelector("#user-submit-button");
    const userForm = document.querySelector("#userForm");

    // Gestion de l'édition utilisateur
    document.querySelectorAll(".edit-user-button").forEach(button => {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            const userId = this.dataset.id;
            const url = this.dataset.url;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Remplir les champs du formulaire
                    userForm.querySelector("input[name='nom']").value = data.nom;
                    userForm.querySelector("input[name='prenom']").value = data.prenom;
                    userForm.querySelector("input[name='email']").value = data.email;
                    userForm.querySelector("select[name='profil']").value = data.profil;

                    // Mettre à jour l'action du formulaire
                    userForm.action = "{{ route('admin.users.store') }}/" + userId;

                    // Ajouter la méthode PUT si elle n'existe pas
                    if (!userForm.querySelector("input[name='_method']")) {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        userForm.appendChild(methodInput);
                    }

                    // Mettre à jour l'interface
                    formTitle.textContent = "Modifier Utilisateur";
                    submitButton.innerHTML = `<i class="fas fa-save me-2"></i> Mettre à jour`;

                    // Ouvrir le formulaire
                    if (!document.getElementById('userFormCollapse').classList.contains('show')) {
                        new bootstrap.Collapse('#userFormCollapse', {toggle: true});
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue lors de la récupération des données de l\'utilisateur');
                });
        });
    });

    // Réinitialiser le formulaire pour l'ajout
    document.getElementById("add-user-button").addEventListener("click", function() {
        userForm.reset();
        userForm.action = "{{ route('admin.users.store') }}";

        // Supprimer le champ _method s'il existe
        const methodInput = userForm.querySelector("input[name='_method']");
        if (methodInput) methodInput.remove();

        // Mettre à jour l'interface
        formTitle.textContent = "Nouvel Utilisateur";
        submitButton.innerHTML = `<i class="fas fa-save me-2"></i> Enregistrer`;
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const statCards = document.querySelectorAll('.stat-card');
    let animated = false;

    function startCounting(counter, target) {
        let current = 0;
        const increment = target / 50; // Divise l'animation en 50 étapes
        const duration = 1500; // 1.5 secondes
        const stepTime = duration / 50;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            counter.textContent = Math.round(current).toLocaleString();
        }, stepTime);
    }

    function checkVisibility() {
        if (!animated && isElementInViewport(statCards[0])) {
            animated = true;
            statCards.forEach(card => {
                const counter = card.querySelector('.counter');
                const target = parseInt(counter.getAttribute('data-target'));

                // Animation d'apparition
                counter.style.animation = 'countAnimation 0.5s ease forwards';

                // Démarrage du compteur
                setTimeout(() => startCounting(counter, target), 200);

                // Animation des petits compteurs si présents
                const smallCounter = card.querySelector('.counter-small');
                if (smallCounter) {
                    const smallTarget = parseInt(smallCounter.getAttribute('data-target'));
                    setTimeout(() => startCounting(smallCounter, smallTarget), 500);
                }
            });
        }
    }

    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Vérifier la visibilité au chargement et au scroll
    window.addEventListener('scroll', checkVisibility);
    checkVisibility();

    // Effet de survol
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const counter = this.querySelector('.counter');
            counter.style.transform = 'scale(1.1)';
        });

        card.addEventListener('mouseleave', function() {
            const counter = this.querySelector('.counter');
            counter.style.transform = 'scale(1)';
        });
    });
});
</script>
