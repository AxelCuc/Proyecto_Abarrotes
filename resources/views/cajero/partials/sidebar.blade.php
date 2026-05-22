<aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-full shrink-0 z-20">
    <div>
        <div class="p-6 pb-8 border-b border-gray-50 flex items-center justify-center flex-col text-center">
            <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-[#0f763e] mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Abarrotes Central</h1>
            <p class="text-xs text-gray-400 font-medium mt-1">Terminal #01</p>
        </div>

        <nav class="p-4 space-y-1.5">
            <a href="{{ route('cajero.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('cajero.dashboard') ? 'bg-green-50 text-[#0f763e]' : 'text-gray-600 hover:bg-gray-50' }} rounded-xl font-bold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Inicio
            </a>
            <a href="{{ route('cajero.ventas.create') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('cajero.ventas.create') ? 'bg-green-50 text-[#0f763e]' : 'text-gray-600 hover:bg-gray-50' }} rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Registrar Venta
            </a>
            <a href="{{ route('cajero.inventario.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('cajero.inventario*') ? 'bg-green-50 text-[#0f763e]' : 'text-gray-600 hover:bg-gray-50' }} rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Inventario
            </a>
            <a href="{{ route('cajero.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('cajero.ventas.index') ? 'bg-green-50 text-[#0f763e]' : 'text-gray-600 hover:bg-gray-50' }} rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Mis Ventas
            </a>
        </nav>
    </div>

    <div class="p-4 border-t border-gray-100">
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        <button onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            Cerrar Turno
        </button>
    </div>
</aside>