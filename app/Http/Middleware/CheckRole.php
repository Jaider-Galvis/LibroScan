<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Maneja una solicitud entrante y verifica el rol del usuario.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Verificación compatible con métodos (hasRole) o propiedades (role / rol / is_admin)
        $hasPermission = false;

        if (method_exists($user, 'hasRole')) {
            $hasPermission = $user->hasRole($role);
        } elseif (isset($user->role)) {
            $hasPermission = $user->role === $role;
        } elseif (isset($user->rol)) {
            $hasPermission = $user->rol === $role;
        } elseif ($role === 'admin' && method_exists($user, 'isAdmin')) {
            $hasPermission = $user->isAdmin();
        }

        if (!$hasPermission) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}