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
                            <h1>Gestion des Tâches</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-success" href="{{ route('dashboard') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Créer une tâche</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container">

                    @if (session('success'))
                        <div class="row py-3 bg-white my-2">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Succès: </strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

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

                    <div class="row py-3 bg-white my-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Créer une Tâche</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST" action="{{ route('tasks.store') }}">
                                        @csrf


                                        <div class="row">
                                            <div class="col-md">
                                                <!-- Name field -->
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Titre</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Terminer le rapport" required>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <label for="type" class="form-label">Assigner a</label>
                                                <select class="form-control" name="assigned_to" required>
                                                    <option selected disabled>Choisir un utilisateur</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Description field -->
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Entrer la description" required></textarea>
                                        </div>
                                        <!-- Due Date -->
                                        <div class="mb-3">
                                            <label for="due_date" class="form-label">Date d'Échéance</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date">
                                        </div>

                                        <!-- Row for Type -->
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Priorite</label>
                                                    <select class="form-control" name="priority" required>
                                                        <option selected disabled>Choisir...</option>
                                                        <option value="High">Urgent</option>
                                                        <option value="Medium">Normal</option>
                                                        <option value="Low">Basse</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option selected disabled>Choisir...</option>
                                                        <option value="To Do">A faire</option>
                                                        <option value="In Progress">En cours</option>
                                                        <option value="Completed">Terminé</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success">Créer la tâche</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
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
