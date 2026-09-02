<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ProfileController;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas y Redirecciones
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Redirección Inteligente de Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    $libros = Libro::all();

    return view('dashboard', compact('libros'));
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas - Estudiante / Usuario General
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'throttle:60,1'])->group(function () {
    
    // Crear Préstamo desde el catálogo
    Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');

    // Vista Mis Préstamos (Listar préstamos activos y pendientes)
    Route::get('/mis-prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');

    // Acción para Renovar Préstamo
    Route::patch('/mis-prestamos/{id}/renovar', function ($id) {
        return back()->with('success', 'Plazo renovado correctamente.');
    })->name('prestamos.renovar');

    // Vista Historial (Listar todos los préstamos pasados y activos)
    Route::get('/historial', [PrestamoController::class, 'historial'])->name('historial.index');

});

/*
|--------------------------------------------------------------------------
| Rutas Protegidas - Panel de Administración (Bibliotecario)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'throttle:30,1'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // Dashboard Admin (Carga contadores y últimos movimientos)
        Route::get('/dashboard', function () {
            $librosCount = Libro::count();
            $prestamosActivos = Prestamo::where('estado', 'activo')->count();
            $usuariosCount = User::count();
            $devolucionesPendientes = Prestamo::where('estado', 'pendiente')->count();

            $ultimosMovimientos = Prestamo::with(['libro', 'user'])
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'librosCount', 
                'prestamosActivos', 
                'usuariosCount', 
                'devolucionesPendientes', 
                'ultimosMovimientos'
            ));
        })->name('dashboard');

        // Gestión de Usuarios
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/{usuario}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

        // Módulo de Catálogo de Libros
        Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
        Route::get('/libros/crear', [LibroController::class, 'create'])->name('libros.create');
        Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
        Route::get('/libros/{libro}/editar', [LibroController::class, 'edit'])->name('libros.edit');
        Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libros.update');
        Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');

        // Logística y Entregas (Procesado por el controlador)
        Route::get('/logistica', [PrestamoController::class, 'adminIndex'])->name('logistica.index');

        // Cambiar estado del préstamo (Aprobar, Rechazar o Devolver)
        Route::patch('/prestamos/{id}/estado', [PrestamoController::class, 'cambiarEstado'])->name('prestamos.cambiarEstado');

        // Informes
        Route::get('/informes', function () {
            return view('admin.informes.index');
        })->name('informes.index');

    });

/*
|--------------------------------------------------------------------------
| Rutas de Gestión de Perfil
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'throttle:20,1'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';