
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Valider les accès</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>


</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h1 class="auth-heading text-center mb-4">Définissez vos accès</h1>

			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" method="post" action="{{ route('submitDefineAccess',$email) }}">
                            @csrf
                            @method('POST')

							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Adresse Email</label>
								<input id="signin-email" name="email" type="email" class="form-control signin-email" value="{{ $email }}" readonly>
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Mot de passe</label>
								<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Mot de passe" required="required">
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
							</div><!--//form-group-->
                            <div>
                                <label class="sr-only" for="signin-password">Mot de passe de confirmation</label>
								<input id="signin-password" name="confirm_password" type="password" class="form-control signin-password" placeholder="Mot de passe de confirmation" required="required">
                                @error('confirm_password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Valider</button>
							</div>
						</form>

						<div class="auth-option text-center pt-5">Pas de compte? Inscrivez-vous<a class="text-link" href="signup.html" >ici</a>.</div>
					</div><!--//auth-form-container-->

			    </div><!--//auth-body-->


		    </div><!--//flex-column-->
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>

				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->

    </div><!--//row-->


</body>
</html>

