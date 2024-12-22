<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

// Routes protégées par le middleware d'authentification
Route::middleware(['auth'])->group(function () {

    // 1. Afficher la liste des tâches
    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index')->middleware('permission:consulter les taches');

    // 2. Afficher le formulaire de création de tâche
    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create')->middleware('permission:creer les taches');

    // 3. Enregistrer une nouvelle tâche
    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store')->middleware('permission:creer les taches');

    // 4. Afficher une tâche spécifique
    Route::get('/tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show')->middleware('permission:consulter les taches');

    // 5. Afficher le formulaire d'édition d'une tâche
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit')->middleware('permission:editer les taches');

    // 6. Mettre à jour une tâche spécifique
    Route::put('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update')->middleware('permission:editer les taches');

    // 7. Supprimer une tâche spécifique
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy')->middleware('permission:supprimer les taches');
});

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    $allTasks =  Task::all()->count();
    $taskToDo = Task::where('status', 'To Do')->get()->count();
    $taskInProgress = Task::where('status', 'In Progress')->get()->count();
    $taskCompleted = Task::where('status', 'Completed')->get()->count();
    return view('employee.index', compact('allTasks','taskCompleted','taskInProgress', 'taskToDo'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
