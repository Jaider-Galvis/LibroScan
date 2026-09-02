@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Registrar Nuevo Libro</h1>
        <p class="text-xs text-slate-500">Agrega un nuevo ejemplar al catálogo escolar.</p>
    </div>
    <a href="{{ route('admin.libros.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800">
        ← VOLVER AL CATÁLOGO
    </a>
</div>

{{-- Mostrar errores de validación si existen --}}
@if ($errors->any())
    <div class="mb-4 p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-700 font-medium">
        <p class="font-bold mb-1">Por favor corrige los siguientes errores:</p>
        <ul class="list-disc pl-4 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.libros.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Portada -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-3">Portada del Libro</label>
        <input type="file" name="portada" accept="image/*" class="text-xs text-slate-500">
    </div>

    <!-- Datos del Libro -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Título del Libro *</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Autor *</label>
            <input type="text" name="autor" value="{{ old('autor') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Categoría</label>
                <select name="categoria" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
                    <option value="Literatura">Literatura</option>
                    <option value="Ciencias">Ciencias</option>
                    <option value="Historia">Historia</option>
                    <option value="General">General</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Stock Disponible *</label>
            <input type="number" name="stock" value="{{ old('stock', 1) }}" min="1" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-[#0c1f38] hover:bg-[#163156] text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-md">
            GUARDAR LIBRO
        </button>
    </div>
</form>
@endsection