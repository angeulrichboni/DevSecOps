<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check())
        {
            $user = Auth::user();
            // Vérifie si l'utilisateur a au moins un des rôles passés
            foreach ($roles as $role){
                if ($user->hasRole($role))
                {
                    return $next($request);

                }
            }
        }
        // Si l'utilisateur n'a pas le bon rôle, rediriger
        return redirect('/dashboard')->with('error', "Vous n'avez pas accès à cette page.");
    }
}
