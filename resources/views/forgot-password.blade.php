<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reinitialisation mot de passe</title>
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

        /*.form-control:focus, .form-control:hover{*/
        /*    border-color: #28a745;*/
        /*}*/
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
{{--        <img src="{{asset('backend/dist/img/logo_minrex.png')}}" alt="Logo MINEREX">--}}
        <span class="brand-text text-success font-weight-bold">Task-<strong>LIST</strong></span>
    </div>
    <!-- /.login-logo -->
    <div class="card p-1">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Veuillez saisir votre adresse email</p>

            <form action="{{route('password.email')}}" method="POST">
                <div class="input-group mb-3">
                    @csrf
                    <input type="email" name="email"  value="{{ old('email') }}" required autofocus class="form-control f-control" placeholder="Adresse email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger btn-block">Réinitialiser le mot de passe</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{route('login')}}" class="text-success">Se Connecter</a>
            </p>
{{--            <p class="mb-0">--}}
{{--                <a href="register.html" class="text-center">Register a new membership</a>--}}
{{--            </p>--}}
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
</body>
</html>

