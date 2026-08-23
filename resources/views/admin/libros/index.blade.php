@extends('layouts.admin')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Catálogo de Libros</h1>
        <p class="text-xs text-slate-500">Gestión de inventario y ejemplares de la biblioteca.</p>
    </div>
    <a href="{{ route('admin.libros.create') }}" class="bg-[#0c1f38] hover:bg-[#163156] text-white px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-md">
        + Registrar Nuevo Libro
    </a>
</div>

<!-- Alertas -->
@if (session('success'))
    <div class="mb-6 bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl text-xs font-bold flex items-center justify-between">
        <span>✅ {{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="mb-6 bg-rose-100 border border-rose-300 text-rose-800 px-4 py-3 rounded-xl text-xs font-bold flex items-center justify-between">
        <span>⚠️ {{ session('error') }}</span>
    </div>
@endif

<!-- Cuadrícula de Tarjetas -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse ($libros as $libro)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition">
            <div class="p-4">
                <!-- Portada del libro -->
                <div class="w-full h-48 bg-slate-100 rounded-xl overflow-hidden mb-4 border border-slate-100 flex items-center justify-center">
                    @if ($libro->portada)
                        <img src="{{ asset('storage/' . $libro->portada) }}" alt="{{ $libro->titulo }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-center text-slate-400">
                            <span class="text-4xl">📖</span>
                            <p class="text-[10px] font-bold mt-1">Sin Portada</p>
                        </div>
                    @endif
                </div>

                <!-- Detalles del libro -->
                <div class="space-y-1">
                    <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-700 border border-blue-100 rounded text-[10px] font-bold uppercase">
                        {{ $libro->categoria ?? 'General' }}
                    </span>
                    <h3 class="font-black text-slate-900 text-sm line-clamp-1" title="{{ $libro->titulo }}">
                        {{ $libro->titulo }}
                    </h3>
                    <p class="text-xs font-semibold text-slate-600">
                        {{ $libro->autor }}
                    </p>
                    <p class="text-[10px] text-slate-400 font-mono">
                        ISBN: {{ $libro->isbn ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <!-- Footer de la tarjeta con acciones -->
            <div class="px-4 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs font-bold {{ $libro->stock > 0 ? 'text-slate-700' : 'text-rose-600' }}">
                    Stock: <span class="font-black">{{ $libro->stock }}</span>
                </span>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.libros.edit', $libro->id) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition">
                        Editar
                    </a>
                    
                    <form action="{{ route('admin.libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este libro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs font-bold text-rose-500 hover:text-rose-700 transition">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-400 font-bold">
            <span class="text-4xl block mb-2">📚</span>
            <p>No hay libros cargados en el sistema todavía.</p>
        </div>
    @endforelse
</div>

<!-- Paginación -->
@if ($libros->hasPages())
    <div class="mt-6">
        {{ $libros->links() }}
    </div>
@endif
@endsection