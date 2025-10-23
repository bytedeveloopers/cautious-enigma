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
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        // Check if user has the required role
        if ($user->role !== $role) {
            // Redirect to appropriate dashboard based on user's actual role
            if ($user->isTeacher()) {
                return redirect('/dashboard/teacher')->with('error', 'No tienes permisos para acceder a esta sección.');
            } else {
                return redirect('/dashboard/student')->with('error', 'No tienes permisos para acceder a esta sección.');
            }
        }

        return $next($request);
    }
}
