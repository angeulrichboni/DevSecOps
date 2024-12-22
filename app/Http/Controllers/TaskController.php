<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Constructor to apply middleware for permissions.
     */
    public function __construct()
    {
        // Appliquer les permissions sur les méthodes
        $this->middleware('permission:consulter les taches')->only(['index', 'show']);
        $this->middleware('permission:creer les taches')->only(['create', 'store']);
        $this->middleware('permission:editer les taches')->only(['edit', 'update']);
        $this->middleware('permission:supprimer les taches')->only(['destroy']);
    }

    /**
     * Méthode 1 : index
     * Afficher la liste des tâches.
     */
    public function index()
    {
        // Récupérer les tâches assignées à l'utilisateur ou toutes les tâches si ADMIN
        if (Auth::user()->hasRole('ADMIN')) {
            $tasks = Task::with('assignedTo', 'createdBy')->latest()->get();
        } else {
            $tasks = Task::where('assigned_to', Auth::id())
                ->orWhere('created_by', Auth::id())
                ->with('assignedTo', 'createdBy')
                ->latest()->get();
        }
//        dd($tasks);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Méthode 2 : create
     * Afficher le formulaire de création d'une tâche.
     */
    public function create()
    {
        // Récupérer les utilisateurs pour assignation
        $users = User::role('USER')->get();
//        dd($users);
        return view('tasks.create', compact('users'));
    }

    /**
     * Méthode 3 : store
     * Enregistrer une nouvelle tâche dans la base de données.
     */
    public function store(TaskRequest $request)
    {

        // Valider les données entrantes
        $validated = $request->validated();

        if (!Auth::user()->can('creer les taches')) {
            alert()->error('error', 'Vous n\'avez pas l\'autorisation de créer une tâche.');

            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation de créer une tâche.');
        }

        // Créer la tâche
        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'due_date' => $validated['due_date'] ?? null,
            'assigned_to' => $validated['assigned_to'] ?? null,
            'created_by' => Auth::id(),
        ]);
        alert()->success('success', 'Tâche créée avec succès.');
//        dd($task);
        // Rediriger avec un message de succès
        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    /**
     * Méthode 4 : show
     * Afficher une tâche spécifique.
     */
    public function show(Task $task)
    {
        // Vérifier si l'utilisateur peut voir cette tâche
        if (Auth::user()->hasRole('ADMIN') ||
            $task->assigned_to === Auth::id() ||
            $task->created_by === Auth::id()) {
            return view('tasks.show', compact('task'));
        }

        return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation de voir cette tâche.');
    }

    /**
     * Méthode 5 : edit
     * Afficher le formulaire d'édition d'une tâche.
     */
    public function edit(Task $task)
    {
        // Vérifier si l'utilisateur peut éditer cette tâche
        if (Auth::user()->hasRole('ADMIN')|| Auth::user()->hasRole('USER') || $task->created_by === Auth::id())
        {
            $users = User::role('USER')->get();
            return view('tasks.edit', compact('task', 'users'));
        }

        return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation d\'éditer cette tâche.');
    }

    /**
     * Méthode 6 : update
     * Mettre à jour une tâche dans la base de données.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Valider les données entrantes
        $validated = $request->validated();
//        dd($task);
        // Vérifier si l'utilisateur peut mettre à jour cette tâche
        if (!Auth::user()->can('editer les taches')) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation de mettre à jour cette tâche.');
        }

        if (Auth::user()->hasRole('ADMIN')){
            // Mettre à jour la tâche
            $task->update([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'priority' => $validated['priority'],
                'status' => $validated['status'],
                'due_date' => $validated['due_date'] ?? null,
                'assigned_to' => $validated['assigned_to'] ?? null,
            ]);

            alert()->success('success', 'Tâche mise à jour avec succès');
        }else{
            // Mettre à jour la tâche
            $task->update([
                'title' => $task['title'],
                'description' => $task['description'] ?? null,
                'priority' => $task['priority'],
                'status' => $validated['status'],
                'due_date' => $task['due_date'] ?? null,
                'assigned_to' => $task['assigned_to'] ?? null,
            ]);

            alert()->success('success', 'Tâche mise à jour avec succès');

        }



        // Rediriger avec un message de succès
        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
    }

    /**
     * Méthode 7 : destroy
     * Supprimer une tâche de la base de données.
     */
    public function destroy(Task $task)
    {
        // Vérifier si l'utilisateur peut supprimer cette tâche
        if (!Auth::user()->hasRole('ADMIN') && $task->created_by !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas l\'autorisation de supprimer cette tâche.');
        }

        // Supprimer la tâche
        $task->delete();
        alert()->success('succes', 'Tâche supprimée avec succès.');
        // Rediriger avec un message de succès
        return redirect()->route('tasks.index')->with('succes', 'Tâche supprimée avec succès.');
    }
}
