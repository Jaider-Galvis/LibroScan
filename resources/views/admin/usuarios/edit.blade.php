@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-black text-slate-900">Editar Usuario</h1>
        <p class="text-xs text-slate-500">Modifica la información y rol del usuario seleccionado.</p>
    </div>
    <a href="{{ route('admin.usuarios.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800">
        ← VOLVER A USUARIOS
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

<form action="{{ route('admin.usuarios.update', $user->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Nombre Completo *</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Correo Electrónico *</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
        </div>

        <div>
            <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-1">Rol del Usuario *</label>
            <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:bg-white focus:outline-none">
                <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Estudiante (STUDENT)</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrador (ADMIN)</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-[#0c1f38] hover:bg-[#163156] text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-md">
            ACTUALIZAR USUARIO
        </button>
    </div>
</form>
@endsection