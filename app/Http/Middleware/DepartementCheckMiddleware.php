<?php

namespace App\Http\Middleware;

use App\Models\Departement;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DepartementCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $departement = $request->route('departement');

        if (!$user->departements->contains('id', $departement->id)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
