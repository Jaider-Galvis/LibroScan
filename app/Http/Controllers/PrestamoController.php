<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    // 1. Solicitar un libro desde el catálogo (Estudiante)
    public function store(Request $request)
    {
        // Lista de grados permitidos desde Transición hasta 11°
        $gradosValidos = [
            'Transición', '1° Primero', '2° Segundo', '3° Tercero',
            '4° Cuarto', '5° Quinto', '6° Sexto', '7° Séptimo',
            '8° Octavo', '9° Noveno', '10° Décimo', '11° Undécimo'
        ];

        // Validar los campos del formulario modal
        $request->validate([
            'libro_id'      => 'required|exists:libros,id',
            'documento'     => 'required|string|max:20',
            'telefono'      => ['required', 'regex:/^3[0-9]{9}$/'], // Exactamente 10 dígitos y debe iniciar con 3
            'grado'         => 'required|string|in:' . implode(',', $gradosValidos),
            'observaciones' => 'nullable|string|max:500',
        ], [
            'telefono.regex' => 'El número de teléfono debe ser un celular colombiano de 10 dígitos (ej: 3001234567).',
            'grado.in'       => 'Por favor seleccione un grado válido entre Transición y 11°.',
        ]);

        $userId = Auth::id();

        // RESTRICCIÓN: El usuario NO puede solicitar ningún libro si ya tiene uno pendiente o activo
        $prestamoActivo = Prestamo::where('user_id', $userId)
            ->whereIn('estado', ['pendiente', 'activo'])
            ->exists();

        if ($prestamoActivo) {
            return back()->with('error', 'Solo puedes tener un préstamo activo o pendiente a la vez. Debes devolver el libro actual antes de solicitar otro.');
        }

        $libro = Libro::findOrFail($request->libro_id);

        // Validar stock disponible
        if (!is_null($libro->stock) && $libro->stock < 1) {
            return back()->with('error', 'El libro no cuenta con unidades disponibles.');
        }

        // Crear solicitud guardando los datos del estudiante y las observaciones
        Prestamo::create([
            'user_id'         => $userId,
            'libro_id'        => $libro->id,
            'documento'       => $request->documento,
            'telefono'        => $request->telefono,
            'grado'           => $request->grado,
            'observaciones'   => $request->observaciones,
            'fecha_solicitud' => now(),
            'estado'          => 'pendiente',
        ]);

        return back()->with('success', '¡Solicitud de préstamo realizada con éxito! Espera la aprobación del administrador.');
    }

    // 2. Mis Préstamos Activos (Estudiante)
    public function index()
    {
        $prestamos = Prestamo::with('libro')
            ->where('user_id', Auth::id())
            ->whereIn('estado', ['activo', 'pendiente'])
            ->latest()
            ->get();

        return view('prestamos.index', compact('prestamos'));
    }

    // 3. Historial Completo (Estudiante)
    public function historial()
    {
        $historial = Prestamo::with('libro')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('historial.index', compact('historial'));
    }

    // 4. Panel de Logística / Gestión de Solicitudes (Administrador)
    public function adminIndex()
    {
        $solicitudes = Prestamo::with(['user', 'libro'])
            ->latest()
            ->get();

        return view('admin.logistica.index', compact('solicitudes'));
    }

    // 5. Aprobar o Rechazar Solicitud (Administrador)
    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:activo,rechazado,devuelto',
        ]);

        $prestamo = Prestamo::with('libro')->findOrFail($id);

        // Aprobar solicitud -> Descuenta stock
        if ($request->estado === 'activo' && $prestamo->estado === 'pendiente') {
            if (!is_null($prestamo->libro->stock) && $prestamo->libro->stock < 1) {
                return back()->with('error', 'No hay stock disponible para aprobar este préstamo.');
            }
            $prestamo->libro->decrement('stock');
        }

        // Marcar devolución -> Recupera stock
        if ($request->estado === 'devuelto' && $prestamo->estado === 'activo') {
            $prestamo->libro->increment('stock');
        }

        $prestamo->estado = $request->estado;
        $prestamo->save();

        return back()->with('success', 'El estado del préstamo fue actualizado correctamente.');
    }
}