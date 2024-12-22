<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Connexion">
    <meta name="keywords" content="gestion des taches" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

    <style>
        body {
            background: url('{{ asset('backend/dist/img/') }}') no-repeat center center fixed;
            background-size: cover;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.675);
            z-index: -1;
        }

        .login-box {
            position: relative;
            z-index: 1; /* Bring login box in front of the overlay */
        }
        .login-logo>img{
            width: 5rem;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
{{--        <img src="{{asset('backend/dist/img/')}}" alt="Logo ">--}}
        <span class="brand-text text-success font-weight-bold">Task-<strong>LIST</strong></span>
    </div>
    <!-- /.login-logo -->
    <div class="card p-1">
        <div class="card-body login-card-body">
            <h3 class="login-box-msg">Connectez-Vous</h3>
            @if ($errors->any())
                <div class="row p-3 bg-white my-2">
                    <div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreurs: </strong><br>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <form id="loginForm" action="{{route('login')}}" method="POST">
                @csrf
{{--                <div>--}}
{{--                    @error('email')--}}
{{--                    <span id="email_error" class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" value="{{ old('email') }}"  autofocus class="form-control " placeholder="Votre adresse email">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
{{--                    @error('email')--}}
{{--                    <span id="email_error" class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
                    <span id="email_error" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control " placeholder="Votre mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
{{--                    @error('password')--}}
{{--                    <span id="password_error" class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
                    <span id="password_error" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="row mb-3">
                    <div class="col-8">
                        <div class="icheck-success">
                            <input type="checkbox" id="remember_me" name="remember">
                            <label for="remember_me">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block">Connexion</button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="{{route('password.request')}}" class="text-success">Mot de passe oublié?</a>
            </p>
            <p class="mb-0">
                Vous n'avez pas de compte? <a href="{{route('register')}}" class="text-center text-success">S'inscrire</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            console.log('Événement de soumission intercepté');
            // Empêche la soumission par défaut
            event.preventDefault();

            // Validation du formulaire
            if (validateForm()) {
                // Soumettre le formulaire si tout est correct
                this.submit();
            }
        });

        function validateForm() {
            let valid = true;
            // Clear previous errors and classes
            // $('.invalid-feedback').html('');
            // $('.form-control').removeClass('is-invalid').removeClass('is-valid');

            // Validate email
            const email = $('#email').val();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                // $('#email_error').html('Adresse email invalide');
                // $('#email').addClass('is-invalid');
                valid = false;
            } else {
                // $('#email').addClass('is-valid');
            }

            // Validate password
            const password = $('#password').val();
            if (password.length < 8) {
                // $('#password_error').html('Le mot de passe doit contenir au moins 8 caractères');
                // $('#password').addClass('is-invalid');
                valid = false;
            } else {
                // $('#password').addClass('is-valid');
            }

            return valid;
        }
    });
</script>

</body>
</html>
