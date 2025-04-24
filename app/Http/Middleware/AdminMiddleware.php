<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur connecté est un administrateur
        if (Auth::check() && Auth::user()->type === 'admin') {
            return $next($request);
        }

        // Si ce n'est pas un admin, rediriger vers la page d'accueil ou une page d'erreur
        return redirect()->route('dashboard')->withErrors(['Vous n\'avez pas les droits nécessaires.']);
    }
}
