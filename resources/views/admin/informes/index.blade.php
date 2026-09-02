@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-black text-slate-900">Informes y Reportes</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <h3 class="font-bold text-slate-800 mb-2">Reporte General de Préstamos</h3>
        <p class="text-xs text-slate-500 mb-4">Exporta el historial completo de la biblioteca en formato imprimible o PDF.</p>
        <button class="bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold px-4 py-2 rounded-xl uppercase">Generar PDF</button>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <h3 class="font-bold text-slate-800 mb-2">Libros Más Solicitados</h3>
        <p class="text-xs text-slate-500 mb-4">Métricas sobre las lecturas más populares de la institución.</p>
        <button class="bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold px-4 py-2 rounded-xl uppercase">Ver Métricas</button>
    </div>
</div>
@endsection