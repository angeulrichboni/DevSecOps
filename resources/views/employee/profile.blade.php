@extends('layouts.employee')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container py-2">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-success" href="{{route('dashboard')}}">Accueil</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">

                            <!-- Profile Image -->
                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="img-fluid img-circle"
                                             src="{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : asset('backend/dist/img/profil.png') }}"
                                             alt="Photo de profil"
                                             style="width: 100px; height: 100px"
                                        >
                                    </div>

                                    <h3 class="profile-username text-center"><strong>{{Auth::user()->name}}</strong></h3>
                                    @if(Auth::user()->hasRole('ADMIN'))
                                        <p class="text-muted text-center">Administrateur</p>
                                    @else
                                        <p class="text-muted text-center">Utilisateur</p>
                                    @endif

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <span class="float-right text-sm">{{Auth::user()->email}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active " href="#profile" data-toggle="tab">Modifier le profile</a></li>
                                        <li class="nav-item"><a class="nav-link ml-1" href="#password" data-toggle="tab">Modifier mot de passe</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="profile">
                                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-horizontal">
                                                @csrf
                                                @method('PATCH')

                                                <div class="input-group mb-2">
                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" autofocus required placeholder="Votre nom">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <input type="email" name="email" value="{{ Auth::user()->email }}" required  class="form-control" placeholder="Votre adresse email">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                </div>

{{--                                                <div class="form-group">--}}
{{--                                                    <div class="input-group">--}}
{{--                                                        <div class="custom-file">--}}
{{--                                                            <input type="file" name="picture" class="custom-file-input" id="profilPicture" accept="image/*" onchange="previewImage(event)">--}}
{{--                                                            <label class="custom-file-label" for="exampleInputFile">Ajouter la photo de profil</label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <!-- Section pour l'aperçu de l'image -->
                                                <div class="form-group">
                                                    <img id="imagePreview" src="#" alt="Aperçu" style="display:none; width: 100px; height: 100px; margin-top: 10px;" />
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-success">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="password">
                                            <form method="POST" action="{{ route('password.update') }}" class="form-horizontal">
                                                @csrf
                                                @method('PUT')

                                                <div class="input-group mb-2">
                                                    <input type="password" name="current_password" class="form-control" placeholder="Votre mot de passe actuel">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <input type="password" name="password" class="form-control" placeholder="Votre nouveau mot de passe">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer votre nouveau mot de passe">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-success">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            // Vérifie si un fichier a été sélectionné
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                // Lorsque le fichier est chargé, définit l'URL de l'image dans l'élément img
                reader.onload = function(e) {
                    preview.src = e.target.result; // Définit la source de l'image
                    preview.style.display = 'block'; // Affiche l'aperçu
                }

                reader.readAsDataURL(input.files[0]); // Lit le fichier sélectionné
            } else {
                preview.src = '#'; // Réinitialise la source si aucun fichier n'est sélectionné
                preview.style.display = 'none'; // Masque l'aperçu
            }
        }
    </script>
@endsection
