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
                                <li class="breadcrumb-item"><a class="text-success" href="{{ route('tasks.index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Éditer une tâche</li>
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
                                    <h3 class="card-title">Éditer une Tâche</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                        @csrf
                                        @method('PUT')
                                        @if(Auth::user()->hasRole('USER'))
                                            <div class="col-md">
                                                <!-- Statut -->
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Statut</label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option selected disabled>Choisir...</option>
                                                        <option value="To Do" {{ (old('status', $task->status) == 'To Do') ? 'selected' : '' }}>À Faire</option>
                                                        <option value="In Progress" {{ (old('status', $task->status) == 'In Progress') ? 'selected' : '' }}>En Cours</option>
                                                        <option value="Completed" {{ (old('status', $task->status) == 'Completed') ? 'selected' : '' }}>Terminée</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">

                                                <div class="col-md">
                                                    <!-- Titre -->
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Titre</label>
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Terminer le rapport" value="{{ old('title', $task->title) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <!-- Assigné à -->
                                                    <div class="mb-3">
                                                        <label for="assigned_to" class="form-label">Assigner à</label>
                                                        <select class="form-control" name="assigned_to" id="assigned_to" required>
                                                            <option selected disabled>Choisir un utilisateur</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" {{ (old('assigned_to', $task->assigned_to) == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Entrer la description" required>{{ old('description', $task->description) }}</textarea>
                                            </div>

                                            <!-- Due Date -->
                                            <div class="mb-3">
                                                <label for="due_date" class="form-label">Date d'Échéance</label>
                                                <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                                            </div>

                                            <!-- Priorité et Statut -->
                                            <div class="row">
                                                <div class="col-md">
                                                    <!-- Priorité -->
                                                    <div class="mb-3">
                                                        <label for="priority" class="form-label">Priorité</label>
                                                        <select class="form-control" name="priority" id="priority" required>
                                                            <option selected disabled>Choisir...</option>
                                                            <option value="High" {{ (old('priority', $task->priority) == 'High') ? 'selected' : '' }}>Urgent</option>
                                                            <option value="Medium" {{ (old('priority', $task->priority) == 'Medium') ? 'selected' : '' }}>Normal</option>
                                                            <option value="Low" {{ (old('priority', $task->priority) == 'Low') ? 'selected' : '' }}>Basse</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <!-- Statut -->
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Statut</label>
                                                        <select class="form-control" name="status" id="status" required>
                                                            <option selected disabled>Choisir...</option>
                                                            <option value="To Do" {{ (old('status', $task->status) == 'To Do') ? 'selected' : '' }}>À Faire</option>
                                                            <option value="In Progress" {{ (old('status', $task->status) == 'In Progress') ? 'selected' : '' }}>En Cours</option>
                                                            <option value="Completed" {{ (old('status', $task->status) == 'Completed') ? 'selected' : '' }}>Terminée</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        <!-- Bouton de Soumission -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-warning">Mettre à jour la tâche</button>
                                                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annuler</a>
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
