<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Maneja la petición de autenticación entrante.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Intenta autenticar las credenciales (Email y Password)
        $request->authenticate();

        // 2. Regenera el ID de la sesión por seguridad (previene Session Fixation Attacks)
        $request->session()->regenerate();

        $user = Auth::user();

        // 3. Redirección condicional usando métodos helper del modelo User
        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        if ($user->isStudent()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // 4. Mapeo de seguridad: Si el rol es nulo o inválido, destruye la sesión
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        throw ValidationException::withMessages([
            'email' => 'Tu cuenta no tiene un rol válido asignado en el sistema.',
        ]);
    }

    /**
     * Cierra la sesión del usuario (Logout seguro).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}