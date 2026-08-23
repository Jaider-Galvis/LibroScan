<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    // Solicitar un libro desde el catálogo
    public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
        ]);

        $libro = Libro::findOrFail($request->libro_id);

        // Validar stock tolerando nulos o ceros no configurados
        if (!is_null($libro->stock) && $libro->stock < 1) {
            return back()->with('error', 'El libro no cuenta con unidades disponibles.');
        }

        // Crear registro de préstamo con estado 'pendiente' para aprobación del admin
        Prestamo::create([
            'user_id' => Auth::id(),
            'libro_id' => $libro->id,
            'estado' => 'pendiente', // 'pendiente' para que aparezca en Logística del Admin
            'fecha_solicitud' => now(),
            'fecha_prestamo' => now(),
            'fecha_devolucion_esperada' => now()->addDays(7),
        ]);

        // Descontar stock únicamente si existe la columna y es mayor a 0
        if ($libro->stock > 0) {
            $libro->decrement('stock');
        }

        return back()->with('success', '¡Solicitud de préstamo realizada con éxito!');
    }

    // Mis Préstamos Activos
    public function index()
    {
        $prestamos = Prestamo::with('libro')
            ->where('user_id', Auth::id())
            ->whereIn('estado', ['activo', 'pendiente'])
            ->get();

        return view('prestamos.index', compact('prestamos'));
    }

    // Historial Completo
    public function historial()
    {
        $historial = Prestamo::with('libro')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('historial.index', compact('historial'));
    }
}