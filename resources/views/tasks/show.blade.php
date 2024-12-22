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
                            <h1>Détails de la Tâche</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-success" href="{{ route('tasks.index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Détails de la Tâche</li>
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

                    @if (session('error'))
                        <div class="row py-3 bg-white my-2">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Erreur: </strong> {{ session('error') }}
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
                                    <h3 class="card-title">Informations de la Tâche</h3>
                                    <div class="card-tools">
                                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">Retour à la Liste</a>
                                        @can('editer les taches')
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                                        @endcan
                                        @can('supprimer les taches')
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">
                                                    <h3>{{ $task->title }}</h3>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Description: </strong> {{ $task->description }}</p>
                                                    <p><strong>Priorité: </strong>
                                                        @if($task->priority == 'High')
                                                            <span class="badge bg-danger">Haute</span>
                                                        @elseif($task->priority == 'Medium')
                                                            <span class="badge bg-warning">Moyenne</span>
                                                        @else
                                                            <span class="badge bg-success">Basse</span>
                                                        @endif
                                                    </p>
                                                    <p><strong>Statut: </strong>
                                                        @if($task->status == 'Completed')
                                                            <span class="badge bg-success">Terminée</span>
                                                        @elseif($task->status == 'In Progress')
                                                            <span class="badge bg-info">En cours</span>
                                                        @else
                                                            <span class="badge bg-danger">A Faire</span>
                                                        @endif
                                                    </p>
                                                    <p><strong>Date d'Échéance: </strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
