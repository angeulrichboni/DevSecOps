@extends('layouts.employee')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-6">

        <div class="container ">
            <div class="row mt-3">
                <div class="col-md">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3>{{$allTasks ? $allTasks : 0}}</h3>
                                    <p>Tache (s) créée (s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="{{route('tasks.create')}}" class="small-box-footer">
                                    créer une tache <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3>{{$taskInProgress ? $taskInProgress : 0}}</h3>
                                    <p>Tache (s) en cours</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Consulter les tache en cours <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-gradient-green">
                                <div class="inner">
                                    <h3>{{$taskCompleted ? $taskCompleted : 0}}</h3>
                                    <p>Tache (s) terminée (s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="{{route('tasks.index')}}" class="small-box-footer">
                                    Consulter la liste des taches <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3>{{$taskToDo ? $taskToDo : 0}}</h3>
                                    <p>Tache (s) à faire (s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <a href="{{route('tasks.index')}}" class="small-box-footer">
                                    Consulter la liste des taches <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
