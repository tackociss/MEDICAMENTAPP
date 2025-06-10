<body class="app">


    <div class="app-wrapper">

	    <div class="app-content pt-3 p-md-3 p-lg-4" style="width: 100%;">
		    <div class="container-xl">

			    <h1 class="app-page-title">Mon Compte</h1>
                <div class="row gy-4">
	                <div class="col-12 col-lg-6">
		                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
						    <div class="app-card-header p-3 border-bottom-0">
						        <div class="row align-items-center gx-3">
							        <div class="col-auto">
								        <div class="app-icon-holder">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                            </svg>
									    </div><!--//icon-holder-->
							        </div><!--//col-->
							        <div class="col-auto">
								        <h4 class="app-card-title">Profile</h4>
							        </div><!--//col-->
						        </div><!--//row-->
						    </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100" style="min-height: 500px; width: 100% !important">
                                <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label mb-2"><strong>Photo</strong></div>
										    <div class="item-data">
                                                @if(Auth::user()->avatar)
                                                    <img class="profile-image" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Photo de profil" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;">
                                                @else
                                                    <div class="profile-image d-flex align-items-center justify-content-center bg-primary text-white rounded-circle"
                                                         style="width: 120px; height: 120px; font-size: 48px;">
                                                        {{ strtoupper(substr(Auth::user()->prenom, 0, 1) . substr(Auth::user()->nom, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
									    </div><!--//col-->
									    <div class="col text-end">

									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->

                                <!-- Informations Personnelles -->
                                <div class="section-title h5 mt-4 mb-3">Informations Personnelles</div>
							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Nom</strong></div>
									        <div class="item-data">{{ Auth::user()->nom }}</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editNomModal">
                                                <i class="fas fa-edit me-2"></i>Modifier
                                            </a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
                                <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Prénom</strong></div>
									        <div class="item-data">{{ Auth::user()->prenom }}</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editPrenomModal">
                                                <i class="fas fa-edit me-2"></i>Modifier
                                            </a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->

                                <!-- Coordonnées -->
                                <div class="section-title h5 mt-4 mb-3">Coordonnées</div>
							    <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Email</strong></div>
									        <div class="item-data">{{ Auth::user()->email }}</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                                                <i class="fas fa-envelope me-2"></i>Modifier
                                            </a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
                                @if(Auth::user()->telephone)
                                <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Téléphone</strong></div>
									        <div class="item-data">{{ Auth::user()->telephone }}</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editTelephoneModal">
                                                <i class="fas fa-phone me-2"></i>Modifier
                                            </a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
                                @endif

                                <!-- Informations Professionnelles -->
                                <div class="section-title h5 mt-4 mb-3">Informations Professionnelles</div>
                                @if(Auth::user()->role)
                                <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Rôle</strong></div>
									        <div class="item-data">
                                                <span class="badge bg-primary">{{ Auth::user()->role }}</span>
                                            </div>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
                                @endif
                                @if(Auth::user()->specialite)
                                <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Spécialité</strong></div>
									        <div class="item-data">{{ Auth::user()->specialite }}</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editSpecialiteModal">
                                                <i class="fas fa-user-md me-2"></i>Modifier
                                            </a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
                                @endif

                                <!-- Sécurité -->
                                <div class="section-title h5 mt-4 mb-3">Sécurité</div>
                                <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Mot de passe</strong></div>
									        <div class="item-data">••••••••</div>
									    </div><!--//col-->
									    <div class="col text-end">
										    <a class="btn-sm app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                                                <i class="fas fa-key me-2"></i>Modifier
                                            </a>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->

                                <!-- Dernière connexion -->
                                <div class="section-title h5 mt-4 mb-3">Activité</div>
                                <div class="item border-bottom py-3">
								    <div class="row justify-content-between align-items-center">
									    <div class="col-auto">
										    <div class="item-label"><strong>Dernière connexion</strong></div>
									        <div class="item-data">
                                                @if(Auth::user()->last_login)
                                                    {{ \Carbon\Carbon::parse(Auth::user()->last_login)->format('d/m/Y H:i') }}
                                                @else
                                                    Première connexion
                                                @endif
                                            </div>
									    </div><!--//col-->
								    </div><!--//row-->
							    </div><!--//item-->
						    </div><!--//app-card-body-->

						</div><!--//app-card-->
	                </div><!--//col-->
	                <div class="col-12 col-lg-6">
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

    <!-- Modal Photo -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Modifier la photo de profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Choisir une nouvelle photo</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Nom -->
    <div class="modal fade" id="editNomModal" tabindex="-1" aria-labelledby="editNomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNomModalLabel">Modifier le nom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.nom') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ Auth::user()->nom }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Prénom -->
    <div class="modal fade" id="editPrenomModal" tabindex="-1" aria-labelledby="editPrenomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPrenomModalLabel">Modifier le prénom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.prenom') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ Auth::user()->prenom }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Email -->
    <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmailModalLabel">Modifier l'email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.email') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Téléphone -->
    <div class="modal fade" id="editTelephoneModal" tabindex="-1" aria-labelledby="editTelephoneModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTelephoneModalLabel">Modifier le téléphone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.telephone') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ Auth::user()->telephone }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Mot de passe -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordModalLabel">Modifier le mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(Auth::user()->specialite)
    <!-- Modal Spécialité -->
    <div class="modal fade" id="editSpecialiteModal" tabindex="-1" aria-labelledby="editSpecialiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSpecialiteModalLabel">Modifier la spécialité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.specialite') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="specialite" class="form-label">Spécialité</label>
                            <input type="text" class="form-control" id="specialite" name="specialite" value="{{ Auth::user()->specialite }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

</body>
</html>
