<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
<<<<<<< HEAD
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
=======
    // Solicitar un libro desde el catálogo
    public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
        ]);

        $libro = Libro::findOrFail($request->libro_id);

        // Validar stock tolerando nulos o ceros no configurados
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
        if (!is_null($libro->stock) && $libro->stock < 1) {
            return back()->with('error', 'El libro no cuenta con unidades disponibles.');
        }

<<<<<<< HEAD
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
=======
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
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
    public function index()
    {
        $prestamos = Prestamo::with('libro')
            ->where('user_id', Auth::id())
            ->whereIn('estado', ['activo', 'pendiente'])
<<<<<<< HEAD
            ->latest()
=======
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
            ->get();

        return view('prestamos.index', compact('prestamos'));
    }

<<<<<<< HEAD
    // 3. Historial Completo (Estudiante)
=======
    // Historial Completo
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
    public function historial()
    {
        $historial = Prestamo::with('libro')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('historial.index', compact('historial'));
    }
<<<<<<< HEAD

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
=======
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
}