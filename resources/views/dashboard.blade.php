<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroScan — Catálogo Estudiante</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-200 font-sans antialiased p-4 md:p-6 min-h-screen flex items-center justify-center">

    <!-- Contenedor Principal -->
    <div class="w-full max-w-7xl bg-[#0f2a4a] rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-slate-700 min-h-[750px]">

        <!-- Sidebar Lateral Izquierdo -->
        <aside class="w-full md:w-64 bg-[#0a1e36] text-white p-6 flex flex-col justify-between shrink-0">
            <div>
                <!-- Logo LibroScan -->
                <div class="flex items-center space-x-3 mb-8">
                    <div class="bg-blue-500 p-2 rounded-xl text-white">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight">LibroScan</span>
                </div>

                <!-- Menú Estudiante -->
                <nav class="space-y-3 mb-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 {{ request()->routeIs('dashboard') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition shadow-sm">
                        <span>🗂️</span>
                        <span>CATÁLOGO</span>
                    </a>
                    <a href="{{ route('prestamos.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('prestamos.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>🛒</span>
                        <span>MIS PRÉSTAMOS</span>
                    </a>
                    <a href="{{ route('historial.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('historial.*') ? 'bg-blue-600/50 border border-blue-400/30 text-white' : 'text-slate-300 hover:bg-white/5' }} px-4 py-3 rounded-xl font-bold text-xs uppercase tracking-wide transition">
                        <span>📜</span>
                        <span>HISTORIAL</span>
                    </a>
                </nav>

                <!-- Panel Lateral de Recientes -->
                <div class="bg-white/5 border border-white/10 p-4 rounded-2xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">ÚLTIMAS ACTIVIDADES</p>
                    <p class="text-xs text-slate-400 italic">No tienes préstamos recientes.</p>
                </div>
            </div>

            <!-- Salir de sesión -->
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

                <!-- Mensajes de Notificación -->
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

                <!-- Buscador de Libros -->
                <form method="GET" action="{{ route('dashboard') }}" class="mb-8">
                    <div class="relative w-full max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar libro o autor..." class="w-full pl-4 pr-10 py-2.5 rounded-full border border-slate-300 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                        <button type="submit" class="absolute right-3 top-2.5 text-slate-400 text-xs hover:text-slate-600">🔍</button>
                    </div>
                </form>

                <!-- Parrilla de Catálogo -->
                <div>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4">Catálogo Disponible</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @forelse ($libros ?? [] as $libro)
                            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                                <div>
                                    <div class="h-40 bg-slate-100 rounded-xl mb-3 overflow-hidden flex items-center justify-center text-3xl">
                                        @if ($libro->portada)
                                            <img src="{{ asset('storage/' . $libro->portada) }}" alt="{{ $libro->titulo }}" class="w-full h-full object-cover">
                                        @else
                                            📖
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-slate-800 text-sm leading-tight line-clamp-1" title="{{ $libro->titulo }}">{{ $libro->titulo }}</h4>
                                    <p class="text-xs text-slate-500 mb-3">{{ $libro->autor }}</p>
                                </div>
                                
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                    <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-md bg-emerald-100 text-emerald-700">
                                        Disponible ({{ $libro->stock ?? 1 }})
                                    </span>
                                    
                                    <form method="POST" action="{{ route('prestamos.store') }}" style="display: inline-block !important;">
                                        @csrf
                                        <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                                        <button type="submit" style="background-color: #2563eb !important; color: #ffffff !important; padding: 6px 14px !important; border-radius: 8px !important; font-weight: bold !important; font-size: 12px !important; text-transform: uppercase !important; border: none !important; cursor: pointer !important; display: inline-block !important;">
                                            Prestar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white p-12 rounded-2xl border border-slate-200 text-center shadow-sm">
                                <span class="text-4xl mb-3 block">📚</span>
                                <h4 class="text-base font-bold text-slate-800 mb-1">El catálogo está vacío</h4>
                                <p class="text-xs text-slate-500">Aún no se han registrado libros en el sistema por parte del administrador.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>