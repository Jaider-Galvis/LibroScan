@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Editar Libro</h1>
        <p class="text-xs text-slate-500">Modifica los datos del ejemplar seleccionado.</p>
    </div>
    <a href="{{ route('admin.libros.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800">
        ← VOLVER AL CATÁLOGO
    </a>
</div>

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

<form action="{{ route('admin.libros.update', $libro->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Portada Actual y Nueva -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-6">
        <div class="w-20 h-28 bg-slate-100 rounded-lg overflow-hidden border flex-shrink-0 flex items-center justify-center">
            @if ($libro->portada)
                <img src="{{ asset('storage/' . $libro->portada) }}" class="w-full h-full object-cover">
            @else
                <span class="text-2xl">📖</span>
            @endif
        </div>
        <div class="flex-grow">
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-2">Cambiar Portada (Opcional)</label>
            <input type="file" name="portada" accept="image/*" class="text-xs text-slate-500">
        </div>
    </div>

    <!-- Datos del Libro -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Título del Libro *</label>
            <input type="text" name="titulo" value="{{ old('titulo', $libro->titulo) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Autor *</label>
            <input type="text" name="autor" value="{{ old('autor', $libro->autor) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $libro->isbn) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Categoría</label>
                <select name="categoria" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
                    <option value="Literatura" {{ old('categoria', $libro->categoria) == 'Literatura' ? 'selected' : '' }}>Literatura</option>
                    <option value="Ciencias" {{ old('categoria', $libro->categoria) == 'Ciencias' ? 'selected' : '' }}>Ciencias</option>
                    <option value="Historia" {{ old('categoria', $libro->categoria) == 'Historia' ? 'selected' : '' }}>Historia</option>
                    <option value="General" {{ old('categoria', $libro->categoria) == 'General' ? 'selected' : '' }}>General</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Stock Disponible *</label>
            <input type="number" name="stock" value="{{ old('stock', $libro->stock) }}" min="0" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-[#0c1f38] hover:bg-[#163156] text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-md">
            ACTUALIZAR LIBRO
        </button>
    </div>
</form>
@endsection