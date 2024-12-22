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
                                <li class="breadcrumb-item active">Liste des Tâches</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row">
                        @can('creer les taches')
                            <div class="col-md-12 py-2 bg-white">
                                <a href="{{ route('tasks.create') }}" class="btn btn-success bg-gradient-success text-white" style="color: #fff !important;">
                                    <i class="fas fa-plus-square"></i> Créer une Tâche
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="row py-3 bg-white mt-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Mes Tâches</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table-tasks" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Description</th>
                                            <th>Priorité</th>
                                            <th>Statut</th>
                                            <th>Date d'Échéance</th>
                                            <th>Assigné à</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if($tasks === null)
                                            <tr>
                                                <td colspan="7" class="text-center">Aucune tâche trouvée pour le moment.</td>
                                            </tr>
                                        @else
                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <td>{{ Str::limit($task->title, 30, '...') }}</td>
                                                    <td>{{ Str::limit($task->description, 50, '...') }}</td>
                                                    <td>
                                                        @switch($task->priority)
                                                            @case('Low')
                                                                <span class="badge badge-secondary">Faible</span>
                                                                @break
                                                            @case('Medium')
                                                                <span class="badge badge-warning">Moyenne</span>
                                                                @break
                                                            @case('High')
                                                                <span class="badge badge-danger">Haute</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-light">{{ $task->priority }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @switch($task->status)
                                                            @case('To Do')
                                                                <span class="badge badge-danger">À Faire</span>
                                                                @break
                                                            @case('In Progress')
                                                                <span class="badge badge-warning">En Cours</span>
                                                                @break
                                                            @case('Completed')
                                                                <span class="badge badge-success">Terminée</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-light">{{ $task->status }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'N/A' }}</td>
                                                    <td>{{ $task->assignedTo ? $task->assignedTo->name : 'Non Assigné' }}</td>
                                                    <td>
                                                        <a class="text-muted mx-1" href="{{ route('tasks.show', $task) }}" title="Voir">
                                                            <i class="fas fa-eye fa-lg"></i>
                                                        </a>
                                                        @can('editer les taches')
                                                            <a class="text-warning mx-1" href="{{ route('tasks.edit', $task) }}" title="Éditer">
                                                                <i class="fas fa-edit fa-lg"></i>
                                                            </a>
                                                        @endcan
                                                        @can('supprimer les taches')
                                                            <form  action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')" class="btn btn-link text-danger p-0 m-0">
                                                                    <i class="fas fa-trash fa-lg"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>

                                    </table>
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

@section('js')
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#table-tasks').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true, // Active la recherche
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 10,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                }
            });
        });

    </script>
@endsection
