<div 
    x-show="openCreateModal" 
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
>
    <div 
        @click.away="openCreateModal = false"
        class="bg-white w-full max-w-[450px] rounded-[2rem] shadow-2xl overflow-hidden relative"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="scale-95 translate-y-4"
        x-transition:enter-end="scale-100 translate-y-0"
    >
        <div class="p-6 pb-2 flex justify-between items-start">
            <div class="flex items-start gap-3.5">
                <div class="w-11 h-11 rounded-full bg-green-50 flex items-center justify-center text-[#0f763e] shrink-0 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 leading-tight">Crear Usuario</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Registra un nuevo miembro del personal y asigna su rol.</p>
                </div>
            </div>
            <button @click="openCreateModal = false" class="text-gray-400 hover:text-gray-600 transition-colors p-1.5 hover:bg-gray-100 rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('admin.usuarios.store') }}" method="POST" class="p-6 pt-2 space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-gray-600 ml-1">Nombre Completo</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input type="text" name="nombre" required placeholder="Ej. Carlos Mendoza" 
                           class="w-full pl-11 pr-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-800 placeholder-gray-400">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-gray-600 ml-1">Correo Electrónico</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </span>
                    <input type="email" name="email" required placeholder="ejemplo@correo.com" 
                           class="w-full pl-11 pr-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-800 placeholder-gray-400">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-gray-600 ml-1">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </span>
                    <input type="password" name="password" required placeholder="Mínimo 8 caracteres" 
                           class="w-full pl-11 pr-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-800 placeholder-gray-400">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-gray-600 ml-1">Rol de Sistema</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                    </span>
                    <select name="rol_id" required class="w-full pl-11 pr-10 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-800 appearance-none cursor-pointer">
                        <option value="" disabled selected>Selecciona un rol</option>
                        <option value="1">Administrador</option>
                        <option value="2">Cajero</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </div>
            </div>

            <div class="flex justify-end items-center gap-3 pt-5 mt-2 border-t border-gray-100">
                <button type="button" @click="openCreateModal = false" class="px-5 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-[#0f763e] hover:bg-[#0a522b] text-white text-sm font-bold rounded-xl shadow-md shadow-green-100 transition-all flex items-center gap-2">
                    Guardar Usuario
                </button>
            </div>
        </form>
    </div>
</div>