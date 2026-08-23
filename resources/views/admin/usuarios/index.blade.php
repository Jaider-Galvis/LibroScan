@extends('layouts.admin')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Gestión de Usuarios</h1>
        <p class="text-xs text-slate-500">Administración de cuentas y roles de la plataforma.</p>
    </div>
    <button class="bg-[#0c1f38] hover:bg-[#163156] text-white px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-md">
        + Crear Usuario
    </button>
</div>

<!-- Alertas de Estado -->
@if (session('success'))
    <div class="mb-6 bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl text-xs font-bold">
        ✅ {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-6 bg-rose-100 border border-rose-300 text-rose-800 px-4 py-3 rounded-xl text-xs font-bold">
        ⚠️ {{ session('error') }}
    </div>
@endif

<div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="text-[11px] font-extrabold text-slate-400 uppercase border-b border-slate-100">
                <th class="pb-3">Nombre</th>
                <th class="pb-3">Email</th>
                <th class="pb-3">Rol</th>
                <th class="pb-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
            @forelse (\App\Models\User::all() as $user)
            <tr class="hover:bg-slate-50 transition">
                <td class="py-3 font-bold text-slate-900">{{ $user->name }}</td>
                <td class="py-3">{{ $user->email }}</td>
                <td class="py-3">
                    <span class="px-2 py-1 rounded-md font-bold uppercase text-[10px] {{ strtolower($user->role ?? '') === 'admin' ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">
                        {{ $user->role ?? 'Estudiante' }}
                    </span>
                </td>
                <td class="py-3 text-right">
                    <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-bold transition">
                        Editar
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-8 text-center text-slate-400 font-bold">No hay usuarios registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection