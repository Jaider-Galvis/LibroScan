<x-guest-layout>
    <div class="w-full max-w-sm px-4">
        
        <!-- Logo LibroScan Header -->
        <div class="flex items-center justify-center space-x-2 mb-6">
            <div class="p-2 bg-blue-900 rounded-lg text-white shadow-md">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <span class="text-3xl font-extrabold text-blue-950 tracking-tight">LibroScan</span>
        </div>

        <!-- Tarjeta de Login -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden relative">
            
            <!-- Encabezado Azul -->
            <div class="bg-blue-950 text-white text-center py-3 relative">
                <h2 class="text-xs font-bold tracking-widest uppercase">INICIAR SESIÓN</h2>
                <div class="absolute right-4 -bottom-4 w-9 h-9 rounded-full bg-sky-500 border-2 border-white flex items-center justify-center text-xs font-bold shadow">
                    ER
                </div>
            </div>

            <!-- Título Institucional -->
            <div class="px-6 pt-6 pb-2 text-center">
                <h3 class="text-xs font-bold text-sky-800 leading-snug">
                    Institución Educativa <span class="font-normal text-slate-600">Monseñor</span><br>
                    <span class="font-normal text-slate-600">Ricardo Trujillo Gutiérrez</span>
                </h3>
                <p class="text-[11px] font-semibold text-slate-500 mt-2">Plataforma para Estudiantes y Bibliotecarios</p>
            </div>

            <!-- Formulario -->
            <div class="px-6 pb-6 pt-3">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:outline-none transition"
                                placeholder="Usuario / Email">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-[10px] mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            </span>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:outline-none transition"
                                placeholder="Contraseña">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-[10px] mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                        <div class="text-right mt-1">
                            <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-slate-600 underline hover:text-blue-900">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-3.5 h-3.5 rounded border-slate-300 text-blue-900 focus:ring-blue-900">
                        <label for="remember_me" class="ml-2 text-xs text-slate-500 font-medium">Recordarme</label>
                    </div>

                    <!-- Botón Entrar -->
                    <button type="submit" class="w-full bg-blue-950 hover:bg-blue-900 text-white font-bold py-2.5 rounded-lg text-xs tracking-wider shadow transition">
                        INICIAR SESIÓN
                    </button>
                </form>

                <!-- Botón Crear Cuenta -->
                <div class="mt-4 pt-3 border-t border-slate-100">
                    <a href="{{ route('register') }}" class="block w-full text-center bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 rounded-lg text-xs tracking-wider transition">
                        CREAR CUENTA (ESTUDIANTE)
                    </a>
                </div>
            </div>
        </div>

        <p class="text-[10px] text-slate-400 text-center max-w-xs mt-4 leading-normal mx-auto">
            Si eres un bibliotecario y necesitas acceso, utiliza la opción del panel de administrador una vez logueado.
        </p>
    </div>
</x-guest-layout>