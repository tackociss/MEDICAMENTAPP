<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMU - Gestion des Médicaments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/cmu.png" style="width: 200px; height:150%alt="logo"></a></div></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#stats">Statistiques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Gestion Intelligente des Médicaments CMU</h1>
                    <p class="lead mb-5">Une plateforme complète pour la gestion des médicaments, conçue pour les médecins, pharmaciens et bénéficiaires du programme CMU.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Commencer
                        </a>
                        <a href="#features" class="btn btn-outline-light">
                            En savoir plus
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container position-relative">
                        <div class="image-overlay"></div>
                        <img src="{{ asset('assets/images/background/jolie.png') }}" alt="CMU Background" class="hero-image rounded-4">
                        <div class="image-caption">
                            <div class="caption-content">
                                <i class="fas fa-heart-pulse text-primary mb-3" style="font-size: 2rem;"></i>
                                <p class="mb-0 fw-bold">Votre partenaire santé de confiance</p>
                                <div class="mt-3 d-flex justify-content-center gap-2">
                                    <span class="badge bg-success">Disponible 24/7</span>
                                    <span class="badge bg-primary">Service de qualité</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" id="features">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Fonctionnalités Principales</h2>
                <p class="text-muted">Découvrez les outils puissants qui facilitent la gestion des médicaments</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4 class="mb-3">Recherche en Temps Réel</h4>
                        <p class="text-muted">Trouvez rapidement les médicaments avec notre système de recherche intelligent et instantané.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h4 class="mb-3">Gestion des Médicaments</h4>
                        <p class="text-muted">Gérez facilement l'inventaire, les prix et les informations des médicaments.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h4 class="mb-3">Accès Multi-profils</h4>
                        <p class="text-muted">Interface adaptée pour les médecins, pharmaciens et bénéficiaires.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light" id="stats">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ number_format($stats['medicaments_count']) }}+</div>
                        <p class="text-muted mb-0">Médicaments Référencés</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ number_format($stats['users_count']) }}+</div>
                        <p class="text-muted mb-0">Utilisateurs Actifs</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['support_hours'] }}</div>
                        <p class="text-muted mb-0">Support Disponible</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($recentMedicaments->count() > 0)
    <!-- Recent Medications Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Médicaments Récemment Ajoutés</h2>
                <p class="text-muted">Découvrez les dernières mises à jour de notre base de données</p>
            </div>
            <div class="row g-4">
                @foreach($recentMedicaments as $medicament)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $medicament->Nom_commercial }}</h5>
                            <p class="card-text text-muted">{{ $medicament->DCI_Principe_actif }}</p>
                            <p class="card-text fw-bold">{{ number_format($medicament->Prix_MAJ, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="display-6 fw-bold mb-4">Prêt à commencer ?</h2>
            <p class="lead mb-5">Rejoignez la plateforme de gestion des médicaments CMU dès aujourd'hui</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-rocket me-2"></i>Lancer l'application
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">À propos de CMU Manager</h5>
                    <p class="text-muted">Une solution moderne pour la gestion efficace des médicaments dans le cadre du programme CMU.</p>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">Liens Rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">Accueil</a></li>
                        <li><a href="#features" class="text-muted text-decoration-none">Fonctionnalités</a></li>
                        <li><a href="#stats" class="text-muted text-decoration-none">Statistiques</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-3">Contact</h5>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-envelope me-2"></i>contact@sen_csu.sn</li>
                        <li><i class="fas fa-phone me-2"></i>+221 XX XXX XX XX</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted">
                <small>&copy; {{ date('Y') }} CMU Manager. Tous droits réservés.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            gsap.registerPlugin(ScrollTrigger);

            // Animation de la navbar
            gsap.to('.navbar', {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out'
            });

            // Animation de la section héro
            const heroTl = gsap.timeline();
            heroTl.to('.hero-section', {
                opacity: 1,
                duration: 1,
                ease: 'power2.out'
            })
            .to('.hero-image-container', {
                opacity: 1,
                scale: 1,
                duration: 1,
                ease: 'back.out(1.7)',
                delay: -0.5
            });

            // Animation des cartes de fonctionnalités
            gsap.to('.feature-card', {
                scrollTrigger: {
                    trigger: '#features',
                    start: 'top center+=100',
                },
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.2,
                ease: 'power3.out'
            });

            // Animation des statistiques
            const statsSection = document.querySelector('#stats');
            const statsNumbers = document.querySelectorAll('.stats-number');

            statsNumbers.forEach(stat => {
                let endValue = parseInt(stat.textContent);
                gsap.to(stat, {
                    scrollTrigger: {
                        trigger: statsSection,
                        start: 'top center+=100',
                    },
                    opacity: 1,
                    duration: 2,
                    onStart: () => {
                        let startValue = 0;
                        let increment = endValue / 50;
                        let handle = setInterval(() => {
                            startValue += increment;
                            if (startValue >= endValue) {
                                stat.textContent = endValue + '+';
                                clearInterval(handle);
                            } else {
                                stat.textContent = Math.floor(startValue) + '+';
                            }
                        }, 40);
                    }
                });
            });

            // Animation des cartes de statistiques
            gsap.to('.stats-card', {
                scrollTrigger: {
                    trigger: '#stats',
                    start: 'top center+=100',
                },
                opacity: 1,
                duration: 0.8,
                stagger: 0.2,
                ease: 'power2.out'
            });

            // Animation de la section CTA
            gsap.to('.cta-section', {
                scrollTrigger: {
                    trigger: '.cta-section',
                    start: 'top center+=100',
                },
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out'
            });

            // Animation au survol des feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    gsap.to(card, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });

                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });
        });

        // Fonctions pour le modal de suppression
        let currentDeleteCallback = null;

        function showDeleteModal(callback) {
            currentDeleteCallback = callback;
            const overlay = document.getElementById('deleteModal');
            const modal = overlay.querySelector('.custom-modal');

            // Afficher l'overlay
            overlay.style.display = 'flex';

            // Animation GSAP
            const tl = gsap.timeline();

            tl.fromTo(overlay, {
                opacity: 0
            }, {
                opacity: 1,
                duration: 0.3
            })
            .fromTo(modal, {
                opacity: 0,
                scale: 0.7,
                y: 50
            }, {
                opacity: 1,
                scale: 1,
                y: 0,
                duration: 0.5,
                ease: "back.out(1.7)"
            }, "-=0.2");

            // Animation de l'icône
            gsap.fromTo('.custom-modal-icon', {
                rotate: -180,
                opacity: 0
            }, {
                rotate: 0,
                opacity: 1,
                duration: 0.6,
                ease: "back.out(1.7)"
            });
        }

        function closeDeleteModal() {
            const overlay = document.getElementById('deleteModal');
            const modal = overlay.querySelector('.custom-modal');

            // Animation de fermeture
            const tl = gsap.timeline({
                onComplete: () => {
                    overlay.style.display = 'none';
                    currentDeleteCallback = null;
                }
            });

            tl.to(modal, {
                opacity: 0,
                scale: 0.7,
                y: 30,
                duration: 0.3,
                ease: "power2.in"
            })
            .to(overlay, {
                opacity: 0,
                duration: 0.3
            }, "-=0.2");
        }

        function confirmDelete() {
            if (currentDeleteCallback) {
                // Animation du bouton de suppression
                gsap.to('.custom-modal-btn-delete', {
                    scale: 0.95,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1,
                    onComplete: () => {
                        currentDeleteCallback();
                        closeDeleteModal();
                    }
                });
            }
        }
    </script>
</body>
</html>
