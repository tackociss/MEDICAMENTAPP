
    <style>
        :root {
            --primary-color: #10B981;
            --secondary-color: #047857;
            --text-color: #1F2937;
            --bg-color: #F9FAFB;
            --header-bg: #047857;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .app-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .app-logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
        }

        .app-logo-container img {
            height: 50px;
            width: auto;
            margin-right: 10px;
        }

        .datetime-display {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 8px 16px;
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
            min-width: 200px;
            text-align: center;
        }

        .app-sidepanel {
            background: white;
            border-right: 1px solid #e5e7eb;
        }

        .nav-link {
            color: var(--text-color) !important;
            border-radius: 8px;
            margin: 2px 0;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(16, 185, 129, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: var(--primary-color);
            color: white !important;
        }

        .app-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .app-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            padding: 12px 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 16px;
        }

        .app-branding {
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            margin-bottom: 1rem;
        }

        .app-branding .logo-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
        }

        .app-header-inner {
            padding: 0.5rem 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 1rem;
            border: 2px solid white;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 600;
            margin-right: 1rem;
            border: 2px solid white;
        }

        .user-name {
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }
    </style>
</head>

<body class="app">


    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title mb-4">Paramètres</h1>

                <!-- Date & Time Settings -->
                <div class="row g-4 settings-section mb-4">
                    <div class="col-12">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-header p-3">
                                <h3 class="section-title mb-0">
                                    <i class="fas fa-clock me-2"></i>Configuration Date et Heure
                                </h3>
                            </div>
                            <div class="app-card-body">
                                <form class="settings-form">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Format de la date</label>
                                            <select class="form-control" id="date-format">
                                                <option value="dd/mm/yyyy">DD/MM/YYYY</option>
                                                <option value="mm/dd/yyyy">MM/DD/YYYY</option>
                                                <option value="yyyy-mm-dd">YYYY-MM-DD</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Format de l'heure</label>
                                            <select class="form-control" id="time-format">
                                                <option value="24">Format 24h</option>
                                                <option value="12">Format 12h (AM/PM)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Fuseau horaire</label>
                                            <select class="form-control" id="timezone">
                                                <option value="Europe/Paris">Europe/Paris</option>
                                                <option value="UTC">UTC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Sauvegarder
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- General Settings -->
                <div class="row g-4 settings-section">
                    <div class="col-12">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-header p-3">
                                <h3 class="section-title mb-0">
                                    <i class="fas fa-cog me-2"></i>Paramètres Généraux
                                </h3>
                            </div>
                            <div class="app-card-body">
                                <form class="settings-form">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nom de l'établissement</label>
                                            <input type="text" class="form-control" value="CMU">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email de contact</label>
                                            <input type="email" class="form-control" value="contact@cmu.sn">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Enregistrer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="app-footer">
            <div class="container text-center py-3">
                <small class="copyright">© 2024 CMU Admin Panel</small>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        // Update Date and Time
        function updateDateTime() {
            const now = new Date();
            const dateElement = document.getElementById('current-date');
            const timeElement = document.getElementById('current-time');

            const dateFormat = document.getElementById('date-format')?.value || 'dd/mm/yyyy';
            const timeFormat = document.getElementById('time-format')?.value || '24';

            const dateOptions = {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            };

            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: timeFormat === '12'
            };

            if (dateElement) dateElement.textContent = now.toLocaleDateString('fr-FR', dateOptions);
            if (timeElement) timeElement.textContent = now.toLocaleTimeString('fr-FR', timeOptions);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateDateTime();
            setInterval(updateDateTime, 1000);

            // Sidebar toggle
            document.getElementById('sidepanel-toggler')?.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('app-sidepanel').classList.toggle('sidepanel-hidden');
            });

            document.getElementById('sidepanel-close')?.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('app-sidepanel').classList.add('sidepanel-hidden');
            });
        });
    </script>
</body>
</html>