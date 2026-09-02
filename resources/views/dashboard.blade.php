<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroScan — Catálogo Estudiante</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<<<<<<< HEAD
    <!-- Alpine.js para la interactividad del Modal -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-200 font-sans antialiased p-4 md:p-6 min-h-screen flex items-center justify-center" 
      x-data="{ openModal: false, libroId: null, libroTitulo: '' }">
=======
</head>
<body class="bg-slate-200 font-sans antialiased p-4 md:p-6 min-h-screen flex items-center justify-center">
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb

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

<<<<<<< HEAD
                <!-- Mensajes de Notificación y Errores de Validación -->
=======
                <!-- Mensajes de Notificación -->
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
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

<<<<<<< HEAD
                @if ($errors->any())
                    <div class="mb-4 bg-rose-100 border border-rose-300 text-rose-800 px-4 py-3 rounded-xl text-xs font-bold shadow-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

=======
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
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
                                    
<<<<<<< HEAD
                                    <!-- Botón que activa el Modal -->
                                    <button type="button" 
                                            @click="openModal = true; libroId = '{{ $libro->id }}'; libroTitulo = '{{ addslashes($libro->titulo) }}'" 
                                            style="background-color: #2563eb !important; color: #ffffff !important; padding: 6px 14px !important; border-radius: 8px !important; font-weight: bold !important; font-size: 12px !important; text-transform: uppercase !important; border: none !important; cursor: pointer !important; display: inline-block !important;">
                                        Prestar
                                    </button>
=======
                                    <form method="POST" action="{{ route('prestamos.store') }}" style="display: inline-block !important;">
                                        @csrf
                                        <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                                        <button type="submit" style="background-color: #2563eb !important; color: #ffffff !important; padding: 6px 14px !important; border-radius: 8px !important; font-weight: bold !important; font-size: 12px !important; text-transform: uppercase !important; border: none !important; cursor: pointer !important; display: inline-block !important;">
                                            Prestar
                                        </button>
                                    </form>
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
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

<<<<<<< HEAD
    <!-- MODAL POPUP: Formulario de Solicitud de Préstamo -->
    <div x-show="openModal" 
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50" 
         x-cloak>
        <div class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full shadow-2xl border border-slate-100">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wide">Solicitud de Préstamo</h3>
                <button type="button" @click="openModal = false" class="text-slate-400 hover:text-slate-600 font-bold text-lg">&times;</button>
            </div>

            <p class="text-xs text-slate-500 mb-4 font-semibold">
                Libro a solicitar: <span class="text-blue-600 font-bold" x-text="libroTitulo"></span>
            </p>

            <form method="POST" action="{{ route('prestamos.store') }}" class="space-y-3">
                @csrf
                <input type="hidden" name="libro_id" :value="libroId">

                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Nombre del Estudiante</label>
                    <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full bg-slate-100 border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-600 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Documento de Identidad *</label>
                    <input type="text" name="documento" value="{{ old('documento', Auth::user()->documento ?? '') }}" required placeholder="Ej: 1098765432" class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Celular (10 dígitos) *</label>
                        <input type="tel" name="telefono" value="{{ old('telefono', Auth::user()->telefono ?? '') }}" required pattern="3[0-9]{9}" maxlength="10" placeholder="Ej: 3001234567" title="Debe ser un número celular colombiano de 10 dígitos (inicia con 3)" class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Curso / Grado *</label>
                        <select name="grado" required class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                            <option value="" disabled {{ old('grado', Auth::user()->grado ?? '') == '' ? 'selected' : '' }}>Seleccionar...</option>
                            <option value="Transición" {{ old('grado', Auth::user()->grado ?? '') == 'Transición' ? 'selected' : '' }}>Transición</option>
                            <option value="1° Primero" {{ old('grado', Auth::user()->grado ?? '') == '1° Primero' ? 'selected' : '' }}>1° Primero</option>
                            <option value="2° Segundo" {{ old('grado', Auth::user()->grado ?? '') == '2° Segundo' ? 'selected' : '' }}>2° Segundo</option>
                            <option value="3° Tercero" {{ old('grado', Auth::user()->grado ?? '') == '3° Tercero' ? 'selected' : '' }}>3° Tercero</option>
                            <option value="4° Cuarto" {{ old('grado', Auth::user()->grado ?? '') == '4° Cuarto' ? 'selected' : '' }}>4° Cuarto</option>
                            <option value="5° Quinto" {{ old('grado', Auth::user()->grado ?? '') == '5° Quinto' ? 'selected' : '' }}>5° Quinto</option>
                            <option value="6° Sexto" {{ old('grado', Auth::user()->grado ?? '') == '6° Sexto' ? 'selected' : '' }}>6° Sexto</option>
                            <option value="7° Séptimo" {{ old('grado', Auth::user()->grado ?? '') == '7° Séptimo' ? 'selected' : '' }}>7° Séptimo</option>
                            <option value="8° Octavo" {{ old('grado', Auth::user()->grado ?? '') == '8° Octavo' ? 'selected' : '' }}>8° Octavo</option>
                            <option value="9° Noveno" {{ old('grado', Auth::user()->grado ?? '') == '9° Noveno' ? 'selected' : '' }}>9° Noveno</option>
                            <option value="10° Décimo" {{ old('grado', Auth::user()->grado ?? '') == '10° Décimo' ? 'selected' : '' }}>10° Décimo</option>
                            <option value="11° Undécimo" {{ old('grado', Auth::user()->grado ?? '') == '11° Undécimo' ? 'selected' : '' }}>11° Undécimo</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Observaciones / Motivo (Opcional)</label>
                    <textarea name="observaciones" rows="2" placeholder="Motivo o detalle del préstamo..." class="w-full border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('observaciones') }}</textarea>
                </div>

                <div class="flex items-center space-x-2 pt-3">
                    <button type="button" @click="openModal = false" class="w-1/2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs uppercase py-2.5 rounded-xl transition">
                        Cancelar
                    </button>
                    <button type="submit" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase py-2.5 rounded-xl transition shadow-sm">
                        Confirmar y Solicitar
                    </button>
                </div>
            </form>
        </div>
    </div>

=======
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
</body>
</html>