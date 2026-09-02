<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroScan — Logística y Entregas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-200 font-sans antialiased p-4 md:p-6 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-7xl bg-[#0f2a4a] rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-slate-700 min-h-[750px]">

        <!-- Sidebar Lateral Izquierdo -->
        <aside class="w-full md:w-64 bg-[#0a1e36] text-white p-6 flex flex-col justify-between shrink-0">
            <div>
                <div class="flex items-center space-x-3 mb-8">
                    <div class="bg-blue-500 p-2 rounded-xl text-white">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight">LibroScan</span>
                </div>

                <nav class="space-y-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-slate-300 hover:bg-white/5 px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>📌</span>
                        <span>PANEL DE CONTROL</span>
                    </a>
                    <a href="{{ route('admin.usuarios.index') }}" class="flex items-center space-x-3 text-slate-300 hover:bg-white/5 px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>👥</span>
                        <span>GESTIÓN DE USUARIOS</span>
                    </a>
                    <a href="{{ route('admin.libros.index') }}" class="flex items-center space-x-3 text-slate-300 hover:bg-white/5 px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>📖</span>
                        <span>CATÁLOGO DE LIBROS</span>
                    </a>
                    <a href="{{ route('admin.logistica.index') }}" class="flex items-center space-x-3 bg-blue-600/50 border border-blue-400/30 text-white px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>🔄</span>
                        <span>LOGÍSTICA Y ENTREGAS</span>
                    </a>
                    <a href="{{ route('admin.informes.index') }}" class="flex items-center space-x-3 text-slate-300 hover:bg-white/5 px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>📄</span>
                        <span>INFORMES</span>
                    </a>
                </nav>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="pt-6 border-t border-slate-800">
                @csrf
                <button type="submit" class="w-full text-left flex items-center space-x-2 text-rose-400 hover:text-rose-300 font-bold text-xs uppercase transition">
                    <span>🚪</span>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </aside>

        <!-- Área Central de Solicitudes -->
        <main class="flex-1 bg-slate-100 p-6 md:p-8 flex flex-col justify-between rounded-t-3xl md:rounded-l-3xl md:rounded-tr-none">
            <div>
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 pb-4 border-b border-slate-200 gap-4">
                    <h2 class="text-xs md:text-sm font-bold text-slate-600 tracking-wide uppercase">
                        INSTITUCCIÓN EDUCATIVA MONSEÑOR RICARDO TRUJILLO GUTIÉRREZ
                    </h2>
                    <div class="flex items-center space-x-2 bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200">
                        <span class="text-xs font-bold text-slate-800">{{ Auth::user()->name }}</span>
                    </div>
                </div>

                <h3 class="text-xl font-black text-slate-800 mb-6">Logística y Entregas</h3>

                @if (session('success'))
                    <div class="mb-4 bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl text-xs font-bold shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-rose-100 border border-rose-300 text-rose-800 px-4 py-3 rounded-xl text-xs font-bold shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-[10px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                                <th class="p-4">LIBRO</th>
                                <th class="p-4">SOLICITANTE</th>
                                <th class="p-4">FECHA SOLICITUD</th>
                                <th class="p-4">ESTADO</th>
                                <th class="p-4 text-center">ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                            @forelse ($solicitudes ?? [] as $prestamo)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="p-4 font-bold text-slate-800">{{ $prestamo->libro->titulo ?? 'Sin libro' }}</td>
                                    
                                    <!-- Solicitante: Busca en el préstamo y luego en la relación de usuario -->
                                    <td class="p-4">
                                        <div class="font-bold text-slate-800">{{ $prestamo->user->name ?? 'Usuario no encontrado' }}</div>
                                        <div class="text-[11px] text-slate-500 mt-0.5 space-x-2">
                                            <span><strong>Doc:</strong> {{ $prestamo->documento ?? $prestamo->user->documento ?? 'N/A' }}</span>
                                            <span>•</span>
                                            <span><strong>Tel:</strong> {{ $prestamo->telefono ?? $prestamo->user->telefono ?? 'N/A' }}</span>
                                            @php
                                                $grado = $prestamo->grado ?? $prestamo->user->grado ?? null;
                                            @endphp
                                            @if(!empty($grado))
                                                <span>•</span>
                                                <span><strong>Grado:</strong> {{ $grado }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="p-4 text-slate-500">
                                        {{ $prestamo->fecha_solicitud ? $prestamo->fecha_solicitud->format('d/m/Y H:i') : $prestamo->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    
                                    <td class="p-4">
                                        @if ($prestamo->estado === 'pendiente')
                                            <span style="background-color: #fef3c7 !important; color: #d97706 !important;" class="font-bold px-2.5 py-1 rounded-md text-[10px] uppercase">
                                                Pendiente
                                            </span>
                                        @elseif ($prestamo->estado === 'activo' || $prestamo->estado === 'aprobado')
                                            <span style="background-color: #d1fae5 !important; color: #047857 !important;" class="font-bold px-2.5 py-1 rounded-md text-[10px] uppercase">
                                                Activo / Entregado
                                            </span>
                                        @elseif ($prestamo->estado === 'rechazado')
                                            <span style="background-color: #ffe4e6 !important; color: #e11d48 !important;" class="font-bold px-2.5 py-1 rounded-md text-[10px] uppercase">
                                                Rechazado
                                            </span>
                                        @else
                                            <span style="background-color: #f1f5f9 !important; color: #475569 !important;" class="font-bold px-2.5 py-1 rounded-md text-[10px] uppercase">
                                                {{ $prestamo->estado }}
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Acciones con colores estables inline -->
                                    <td class="p-4 text-center space-x-1">
                                        @if ($prestamo->estado === 'pendiente')
                                            <form method="POST" action="{{ route('admin.prestamos.cambiarEstado', $prestamo->id) }}" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="estado" value="activo">
                                                <button type="submit" 
                                                        style="background-color: #059669 !important; color: #ffffff !important;" 
                                                        class="px-3 py-1.5 rounded-lg font-bold text-[11px] uppercase transition shadow-sm hover:opacity-90">
                                                    Entregar Libro
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.prestamos.cambiarEstado', $prestamo->id) }}" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="estado" value="rechazado">
                                                <button type="submit" 
                                                        style="background-color: #e11d48 !important; color: #ffffff !important;" 
                                                        class="px-3 py-1.5 rounded-lg font-bold text-[11px] uppercase transition shadow-sm hover:opacity-90">
                                                    Rechazar
                                                </button>
                                            </form>

                                        @elseif ($prestamo->estado === 'activo' || $prestamo->estado === 'aprobado')
                                            <form method="POST" action="{{ route('admin.prestamos.cambiarEstado', $prestamo->id) }}" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="estado" value="devuelto">
                                                <button type="submit" 
                                                        style="background-color: #2563eb !important; color: #ffffff !important;" 
                                                        class="px-3 py-1.5 rounded-lg font-bold text-[11px] uppercase transition shadow-sm hover:opacity-90">
                                                    Marcar Devuelto
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-slate-400 text-[11px] italic">Finalizado</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-slate-400 text-xs">
                                        No hay entregas o solicitudes pendientes de aprobación.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>