<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroScan — Mis Préstamos</title>
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

                <nav class="space-y-3 mb-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 {{ request()->routeIs('dashboard') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>🗂️</span>
                        <span>CATÁLOGO</span>
                    </a>
                    <a href="{{ route('prestamos.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('prestamos.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition shadow-sm">
                        <span>🛒</span>
                        <span>MIS PRÉSTAMOS</span>
                    </a>
                    <a href="{{ route('historial.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('historial.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>📜</span>
                        <span>HISTORIAL</span>
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

        <!-- Área de Contenido Derecha -->
        <main class="flex-1 bg-slate-100 p-6 md:p-8 flex flex-col justify-between rounded-t-3xl md:rounded-l-3xl md:rounded-tr-none">
            <div>
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 pb-4 border-b border-slate-200 gap-4">
                    <h2 class="text-xs md:text-sm font-bold text-slate-600 tracking-wide uppercase">
                        INSTITUCCIÓN EDUCATIVA MONSEÑOR RICARDO TRUJILLO GUTIÉRREZ
                    </h2>
                    
                    <div class="flex items-center space-x-3">
                        <span class="text-xs font-bold text-slate-700 bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200">🔔</span>
                        <div class="flex items-center space-x-2 bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200">
                            <span class="text-xs font-bold text-slate-800">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>

<<<<<<< HEAD
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4">Préstamos Activos y Solicitudes</h3>
=======
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4">Préstamos Activos</h3>
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="p-4">Libro</th>
                                <th class="p-4">Fecha Solicitud</th>
                                <th class="p-4">Fecha Límite</th>
                                <th class="p-4">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                            @forelse ($prestamos ?? [] as $prestamo)
                                <tr class="hover:bg-slate-50/50 transition">
<<<<<<< HEAD
                                    <td class="p-4 font-bold text-slate-800">
                                        {{ $prestamo->libro->titulo ?? 'Libro no especificado' }}
                                    </td>
                                    
                                    <!-- Muestra la fecha de solicitud formateada de forma segura -->
                                    <td class="p-4">
                                        {{ $prestamo->fecha_solicitud ? $prestamo->fecha_solicitud->format('d/m/Y h:i A') : $prestamo->created_at->format('d/m/Y h:i A') }}
                                    </td>
                                    
                                    <!-- Muestra la fecha límite o Pendiente si aún no ha sido aprobado -->
                                    <td class="p-4 font-semibold text-amber-600">
                                        @if ($prestamo->fecha_devolucion_limite)
                                            {{ $prestamo->fecha_devolucion_limite->format('d/m/Y') }}
                                        @elseif ($prestamo->fecha_devolucion_esperada)
                                            {{ $prestamo->fecha_devolucion_esperada->format('d/m/Y') }}
                                        @else
                                            <span class="text-slate-400 font-normal italic">Por asignar</span>
                                        @endif
                                    </td>
                                    
                                    <!-- Estados visuales dinámicos -->
                                    <td class="p-4">
                                        @if ($prestamo->estado === 'pendiente')
                                            <span style="background-color: #fef3c7 !important; color: #d97706 !important;" class="font-bold px-2.5 py-1 rounded-md text-[10px] uppercase">
                                                Pendiente
                                            </span>
                                        @elseif ($prestamo->estado === 'activo' || $prestamo->estado === 'aprobado')
                                            <span style="background-color: #dbeafe !important; color: #1d4ed8 !important;" class="font-bold px-2.5 py-1 rounded-md text-[10px] uppercase">
                                                En Préstamo
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
=======
                                    <td class="p-4 font-bold text-slate-800">{{ $prestamo->libro->titulo ?? 'Libro no especificado' }}</td>
                                    <td class="p-4">
                                        {{ $prestamo->fecha_prestamo ? \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') : $prestamo->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="p-4 font-semibold text-amber-600">
                                        {{ $prestamo->fecha_devolucion_esperada ? \Carbon\Carbon::parse($prestamo->fecha_devolucion_esperada)->format('d/m/Y') : ($prestamo->fecha_limite ? \Carbon\Carbon::parse($prestamo->fecha_limite)->format('d/m/Y') : 'Pendiente') }}
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-blue-100 text-blue-700 font-bold px-2.5 py-1 rounded-md text-[10px] uppercase">
                                            {{ $prestamo->estado ?? 'EN PRÉSTAMO' }}
                                        </span>
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-slate-400 font-medium italic">
<<<<<<< HEAD
                                        No tienes préstamos ni solicitudes en este momento.
=======
                                        No tienes libros marcados como prestados en este momento.
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
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