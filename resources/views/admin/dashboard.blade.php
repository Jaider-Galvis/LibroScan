<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroScan - Panel de Administración</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-200 font-sans antialiased p-4 md:p-6 min-h-screen flex items-center justify-center">

    <!-- Contenedor Principal (Tarjeta Flotante Azul) -->
    <div class="w-full max-w-7xl bg-[#0f2a4a] rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-slate-700 min-h-[750px]">

        <!-- Sidebar Lateral Izquierdo -->
        <aside class="w-full md:w-64 bg-[#0a1e36] text-white p-6 flex flex-col justify-between shrink-0">
            <div>
                <!-- Logo LibroScan -->
                <div class="flex items-center space-x-3 mb-4">
                    <div class="bg-blue-500 p-2 rounded-xl text-white">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight">LibroScan</span>
                </div>

                <!-- Tag Admin Panel -->
                <div class="mb-8">
                    <span class="bg-blue-900/60 text-blue-300 border border-blue-500/30 text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wider">
                        ADMIN PANEL
                    </span>
                </div>

                <!-- Menú de Navegación Lateral Conectado con Rutas Laravel -->
                <nav class="space-y-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition shadow-sm">
                        <span>✏️</span>
                        <span>PANEL DE CONTROL</span>
                    </a>
                    <a href="{{ route('admin.usuarios.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.usuarios.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>👥</span>
                        <span>GESTIÓN DE USUARIOS</span>
                    </a>
                    <a href="{{ route('admin.libros.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.libros.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>📖</span>
                        <span>CATÁLOGO DE LIBROS</span>
                    </a>
                    <a href="{{ route('admin.logistica.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.logistica.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>🔄</span>
                        <span>LOGÍSTICA Y ENTREGAS</span>
                    </a>
                    <a href="{{ route('admin.informes.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.informes.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>📄</span>
                        <span>INFORMES</span>
                    </a>
                </nav>
            </div>

            <!-- Salir de sesión -->
            <form method="POST" action="{{ route('logout') }}" class="pt-6 border-t border-slate-800">
                @csrf
                <button type="submit" class="w-full text-left flex items-center space-x-2 text-rose-400 hover:text-rose-300 font-bold text-xs uppercase">
                    <span>🚪</span>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </aside>

        <!-- Área de Contenido Derecha -->
        <main class="flex-1 bg-slate-100 p-6 md:p-8 flex flex-col justify-between rounded-t-3xl md:rounded-l-3xl md:rounded-tr-none">
            <div>
                <!-- Header Superior Interno -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 pb-4 border-b border-slate-200 gap-4">
                    <h2 class="text-xs md:text-sm font-bold text-slate-600 tracking-wide uppercase">
                        INSTITUCCIÓN EDUCATIVA MONSEÑOR RICARDO TRUJILLO GUTIÉRREZ
                    </h2>
                    
                    <div class="flex items-center space-x-3">
                        <span class="text-xs font-bold text-slate-700 bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200">
                            🔔
                        </span>
                        <div class="flex items-center space-x-2 bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200">
                            <span class="text-xs font-bold text-slate-800">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Título e Indicadores de Estado -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <h1 class="text-2xl font-black text-slate-900">Dashboard</h1>
                    
                    <div class="flex items-center space-x-2 text-[11px] font-bold">
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full border border-emerald-300">● Usuarios Activos</span>
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full border border-emerald-300">● Préstamos</span>
                        <span class="px-3 py-1 bg-rose-100 text-rose-800 rounded-full border border-rose-300">● Pendientes</span>
                    </div>
                </div>

                <!-- Tarjetas de Métricas Estadísticas -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-[#0c1f38] text-white p-5 rounded-2xl shadow-md text-center">
                        <p class="text-3xl font-black mb-1">{{ $librosCount ?? 0 }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-300">Libros Totales</p>
                    </div>

                    <div class="bg-[#52779c] text-white p-5 rounded-2xl shadow-md text-center">
                        <p class="text-3xl font-black mb-1">{{ $prestamosActivos ?? 0 }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-100">Préstamos Activos</p>
                    </div>

                    <div class="bg-[#c3d9f2] text-slate-900 p-5 rounded-2xl shadow-md text-center">
                        <p class="text-3xl font-black mb-1">{{ $usuariosCount ?? \App\Models\User::count() }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-700">Usuarios Registrados</p>
                    </div>

                    <div class="bg-white border border-slate-200 text-slate-800 p-5 rounded-2xl shadow-md text-center">
                        <p class="text-3xl font-black mb-1">{{ $devolucionesPendientes ?? 0 }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Devoluciones Pendientes</p>
                    </div>
                </div>

                <!-- Tabla de Movimientos -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-base font-bold text-slate-800">Últimos Movimientos</h3>
                        <a href="{{ route('admin.libros.create') }}" class="bg-[#0c1f38] hover:bg-[#163156] text-white px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition">
                            Registrar Nuevo Libro
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[11px] font-extrabold text-slate-400 uppercase border-b border-slate-100">
                                    <th class="pb-3">Libro</th>
                                    <th class="pb-3">Usuario</th>
                                    <th class="pb-3">Tipo Movimiento</th>
                                    <th class="pb-3">Fecha</th>
                                    <th class="pb-3">Estado</th>
                                    <th class="pb-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                                @forelse ($ultimosMovimientos ?? [] as $movimiento)
                                    <tr>
                                        <td class="py-3 font-bold">{{ $movimiento->libro->titulo ?? 'Sin libro registrado' }}</td>
                                        <td class="py-3">{{ $movimiento->user->name ?? 'Usuario no encontrado' }}</td>
                                        <td class="py-3">Préstamo</td>
                                        <td class="py-3">{{ $movimiento->created_at->format('d/m/Y') }}</td>
                                        <td class="py-3">
                                            <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase {{ $movimiento->estado === 'activo' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                                {{ $movimiento->estado }}
                                            </span>
                                        </td>
                                        <td class="py-3 text-right">
                                            <a href="{{ route('admin.logistica.index') }}" class="text-blue-600 hover:underline font-bold">Ver en Logística</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-slate-400 font-bold">
                                            No hay movimientos o préstamos registrados en la base de datos todavía.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>