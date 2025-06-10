<!DOCTYPE html>
<html lang="en">
<head>
    <title>connexion</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/cmu.png" style="width: 200px; height:150%alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">CONNEXION</h2>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" action="/login" method="POST">
                            @csrf
							<div class="email mb-3">
								<label class="form-label" for="signin-email">Email</label>
								<input id="signin-email" name="signin-email" type="email"
                                       class="form-control @error('signin-email') is-invalid @enderror"
                                       placeholder="Votre adresse email" required>
                                @error('signin-email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
							</div>
							<div class="password mb-3">
								<label class="form-label" for="signin-password">Mot de passe</label>
								<input id="signin-password" name="signin-password" type="password"
                                       class="form-control @error('signin-password') is-invalid @enderror"
                                       placeholder="Votre mot de passe" required>
                                @error('signin-password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="RememberPassword" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Se souvenir de moi
											</label>
										</div>
									</div>
									<div class="col-6">
										<div class="forgot-password text-end">
											<a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
										</div>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">
                                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                </button>
							</div>
						</form>

                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif


						<div class="auth-option text-center pt-5"> <a class="text-link" href="{{ route('home') }}" >RETOUR A L'ACCEUIL</a><i class="fas fa-home me-2" style="color: var(--primary-color); font-size: 1.2rem;"></i>.</div>
					</div><!--//auth-form-container-->

			    </div><!--//auth-body-->

			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                         <small class="copyright">sen_csu <span class="sr-only"></span><i class="fas fa-heart" style="color: #8ee467;"></i> by <a class="app-link" href="{{ route('home') }}" target="_blank"></a> for t6</small>
				    </div>
			    </footer><!--//app-auth-footer-->
		    </div><!--//flex-column-->
	    </div><!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder" style="height: 100%; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('assets/images/background/jolie.png') }}" alt="CMU Background" style="width: 100%; height: 100%; object-fit: cover;">
		    </div>
		    <div class="auth-background-mask" style="background: rgba(0, 0, 0, 0.3);"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				    <div class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title">APPLICATTION DE GESTION DE MEDICAMENTS</h5>
					    <div>Simplifiez la gestion de vos médicaments, gagnez en efficacité et en sécurité au quotidien <a href="">here</a>.</div>
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->

    </div><!--//row-->


</body>
</html>

