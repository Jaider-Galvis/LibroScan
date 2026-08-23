<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Muestra el Dashboard principal del Administrador con contadores reales.
     */
    public function dashboard()
    {
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
    }

    /**
     * Muestra la vista de Logística y Entregas con solicitudes pendientes.
     */
    public function logistica()
    {
        $solicitudes = Prestamo::with(['libro', 'user'])
            ->where('estado', 'pendiente')
            ->latest()
            ->get();

        return view('admin.logistica', compact('solicitudes'));
    }

    /**
     * Muestra la lista de libros.
     */
    public function index()
    {
        $libros = Libro::latest()->paginate(10);
        return view('admin.libros.index', compact('libros'));
    }

    /**
     * Muestra el formulario para crear un nuevo libro.
     */
    public function create()
    {
        return view('admin.libros.create');
    }

    /**
     * Guarda el libro en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo'      => 'required|string|max:255',
            'autor'       => 'required|string|max:255',
            'isbn'        => 'nullable|string|max:20|unique:libros,isbn',
            'categoria'   => 'nullable|string|max:100',
            'stock'       => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:1000',
            'portada'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('portada')) {
                $validatedData['portada'] = $request->file('portada')->store('portadas', 'public');
            }

            Libro::create($validatedData);

            return redirect()
                ->route('admin.libros.index')
                ->with('success', '¡El libro ha sido registrado correctamente!');

        } catch (\Throwable $e) {
            if (isset($validatedData['portada'])) {
                Storage::disk('public')->delete($validatedData['portada']);
            }

            return back()
                ->withInput()
                ->with('error', 'Error del sistema: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar un libro existente.
     */
    public function edit(Libro $libro)
    {
        return view('admin.libros.edit', compact('libro'));
    }

    /**
     * Actualiza el libro en la base de datos.
     */
    public function update(Request $request, Libro $libro)
    {
        $validatedData = $request->validate([
            'titulo'      => 'required|string|max:255',
            'autor'       => 'required|string|max:255',
            'isbn'        => 'nullable|string|max:20|unique:libros,isbn,' . $libro->id,
            'categoria'   => 'nullable|string|max:100',
            'stock'       => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:1000',
            'portada'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('portada')) {
                if ($libro->portada && Storage::disk('public')->exists($libro->portada)) {
                    Storage::disk('public')->delete($libro->portada);
                }
                $validatedData['portada'] = $request->file('portada')->store('portadas', 'public');
            }

            $libro->update($validatedData);

            return redirect()
                ->route('admin.libros.index')
                ->with('success', '¡El libro ha sido actualizado correctamente!');

        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al actualizar el libro: ' . $e->getMessage());
        }
    }

    /**
     * Elimina el libro de la base de datos.
     */
    public function destroy(Libro $libro)
    {
        try {
            if ($libro->portada && Storage::disk('public')->exists($libro->portada)) {
                Storage::disk('public')->delete($libro->portada);
            }

            $libro->delete();

            return redirect()
                ->route('admin.libros.index')
                ->with('success', '¡El libro ha sido eliminado correctamente!');

        } catch (\Throwable $e) {
            return back()->with('error', 'Error al eliminar el libro: ' . $e->getMessage());
        }
    }
}