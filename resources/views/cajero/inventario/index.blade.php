<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Abarrotes Central</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800" x-data="{ sidebarOpen: false }">

    {{-- Overlay para móvil --}}
    <div x-show="sidebarOpen"
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed lg:static lg:translate-x-0 w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-full shrink-0 z-40 transition-transform duration-300 ease-in-out">
        
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <div class="p-6 pb-8 border-b border-gray-50 flex items-center justify-center flex-col text-center relative">
                <button @click="sidebarOpen = false" class="absolute top-4 right-4 lg:hidden text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-[#0f763e] mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Tienda Central</h1>
                <p class="text-xs text-gray-400 font-medium mt-1">Terminal #01</p>
            </div>

            <nav class="p-4 space-y-1.5">
                <a href="{{ route('cajero.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Inicio
                </a>
                <a href="{{ route('cajero.ventas.create') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Registrar Venta
                </a>
                <a href="{{ route('cajero.inventario.index') }}" class="flex items-center gap-3 px-4 py-3 bg-green-50 text-[#0f763e] rounded-xl font-bold transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Inventario
                </a>
                <a href="{{ route('cajero.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Mis Ventas
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-100 shrink-0">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Cerrar Turno
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-[#f8fafc] min-w-0">
        
        <header class="bg-white border-b border-gray-200 h-[72px] px-4 md:px-8 flex justify-between items-center shrink-0">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h2 class="text-lg md:text-xl font-bold text-gray-800 hidden md:block">Panel de Control</h2>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre }}</p>
                    <p class="text-xs text-gray-500">Cajero Activo</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-[#0f763e] font-black border border-gray-200 shrink-0">
                    {{ substr(Auth::user()->nombre, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 custom-scrollbar">
            
            <div class="flex flex-col gap-4 md:gap-6 mb-6 md:mb-10 max-w-7xl mx-auto">
                <div>
                    <h2 class="text-2xl md:text-4xl font-black text-gray-900 mb-1 md:mb-2">Inventario de Productos</h2>
                    <p class="text-xs md:text-base text-gray-500">Vista de solo lectura del almacén actual.</p>
                </div>

                <div class="relative w-full max-w-2xl group">
                    <input type="text" id="input-buscador" placeholder="Buscar producto o categoría..." 
                           class="w-full pl-5 md:pl-6 pr-12 md:pr-14 py-3 md:py-4 border-2 border-gray-100 rounded-xl md:rounded-2xl focus:outline-none focus:ring-4 focus:ring-green-50 focus:border-[#0f763e] text-sm md:text-lg bg-white shadow-sm transition-all duration-300 placeholder:text-gray-400">
                    
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 md:pr-5 text-gray-400 group-focus-within:text-[#0f763e] transition-colors">
                        <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-10 max-w-7xl mx-auto">
                <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-100 shadow-sm flex items-center gap-3 md:gap-5">
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-green-50 flex items-center justify-center text-[#0f763e] shrink-0">
                        <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] md:text-sm font-bold text-gray-400 uppercase tracking-widest mb-0.5">Total Productos</p>
                        <p class="text-xl md:text-3xl font-black text-gray-900">{{ number_format($totalProductos ?? 0) }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-100 shadow-sm flex items-center gap-3 md:gap-5">
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-red-50 flex items-center justify-center text-red-500 shrink-0">
                        <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] md:text-sm font-bold text-gray-400 uppercase tracking-widest mb-0.5">Stock Bajo</p>
                        <p class="text-xl md:text-3xl font-black text-gray-900">{{ number_format($stockBajo ?? 0) }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-100 shadow-sm flex items-center gap-3 md:gap-5">
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                        <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] md:text-sm font-bold text-gray-400 uppercase tracking-widest mb-0.5">Categorías</p>
                        <p class="text-xl md:text-3xl font-black text-gray-900">{{ number_format($categoriasActivas ?? 0) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 overflow-hidden max-w-7xl mx-auto flex flex-col">
                
                <div class="px-4 md:px-8 py-4 md:py-5 border-b border-gray-100 flex items-center justify-start bg-gray-50/30 overflow-x-auto custom-scrollbar">
                    <div class="flex gap-2 md:gap-3 w-max" id="contenedor-filtros">
                        <button data-cat="Todos" class="btn-filtro px-4 md:px-6 py-1.5 md:py-2 rounded-xl text-xs md:text-sm font-bold bg-[#0f763e] text-white shadow-md shadow-green-100 transition-all shrink-0">Todos</button>
                        <button data-cat="Alimentos" class="btn-filtro px-4 md:px-6 py-1.5 md:py-2 rounded-xl text-xs md:text-sm font-bold bg-white border border-gray-200 text-gray-500 hover:border-[#0f763e] hover:text-[#0f763e] transition-all shrink-0">Alimentos</button>
                        <button data-cat="Bebidas" class="btn-filtro px-4 md:px-6 py-1.5 md:py-2 rounded-xl text-xs md:text-sm font-bold bg-white border border-gray-200 text-gray-500 hover:border-[#0f763e] hover:text-[#0f763e] transition-all shrink-0">Bebidas</button>
                        <button data-cat="Higiene" class="btn-filtro px-4 md:px-6 py-1.5 md:py-2 rounded-xl text-xs md:text-sm font-bold bg-white border border-gray-200 text-gray-500 hover:border-[#0f763e] hover:text-[#0f763e] transition-all shrink-0">Higiene</button>
                        <button data-cat="Limpieza" class="btn-filtro px-4 md:px-6 py-1.5 md:py-2 rounded-xl text-xs md:text-sm font-bold bg-white border border-gray-200 text-gray-500 hover:border-[#0f763e] hover:text-[#0f763e] transition-all shrink-0">Limpieza</button>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse min-w-[600px]" id="tabla-productos">
                        <thead>
                            <tr class="bg-white border-b border-gray-100 text-[10px] md:text-xs text-gray-400 uppercase tracking-[0.15em]">
                                <th class="px-4 md:px-8 py-3 md:py-5 font-black text-center">Imagen</th>
                                <th class="px-4 md:px-8 py-3 md:py-5 font-black">Nombre del Producto</th>
                                <th class="px-4 md:px-8 py-3 md:py-5 font-black">Categoría</th>
                                <th class="px-4 md:px-8 py-3 md:py-5 font-black text-right">Precio</th>
                                <th class="px-4 md:px-8 py-3 md:py-5 font-black text-center">Stock</th>
                                <th class="px-4 md:px-8 py-3 md:py-5 font-black text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($productos as $producto)
                                <tr class="fila-producto hover:bg-gray-50/80 transition-colors group">
                                    <td class="px-4 md:px-8 py-3 md:py-4 whitespace-nowrap">
                                        <div class="w-12 h-12 md:w-16 md:h-16 bg-gray-100 rounded-xl overflow-hidden border border-gray-100 shadow-sm mx-auto">
                                            @if($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                                     alt="{{ $producto->nombre }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full text-gray-400 text-[8px] md:text-[10px] text-center leading-tight font-medium">
                                                    Sin<br>imagen
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 md:px-8 py-3 md:py-4 whitespace-nowrap">
                                        <span class="nombre-prod font-bold text-gray-900 text-sm md:text-base">{{ $producto->nombre }}</span>
                                    </td>
                                    <td class="px-4 md:px-8 py-3 md:py-4 whitespace-nowrap">
                                        <span class="cat-prod px-2 md:px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-[10px] md:text-xs font-bold">{{ $producto->categoria->nombre ?? 'General' }}</span>
                                    </td>
                                    <td class="px-4 md:px-8 py-3 md:py-4 whitespace-nowrap text-right">
                                        <span class="font-black text-gray-900 text-base md:text-lg">${{ number_format($producto->precioActual->precio ?? 0, 2) }}</span>
                                    </td>
                                    <td class="px-4 md:px-8 py-3 md:py-4 whitespace-nowrap text-center">
                                        <span class="text-sm md:text-base font-black {{ $producto->stock <= 5 ? 'text-red-600' : 'text-gray-900' }}">
                                            {{ $producto->stock }}
                                        </span>
                                    </td>
                                    <td class="px-4 md:px-8 py-3 md:py-4 whitespace-nowrap text-center">
                                        @if($producto->stock <= 5)
                                            <span class="inline-flex items-center gap-1.5 md:gap-2 px-2 md:px-3 py-1 md:py-1.5 rounded-full text-[9px] md:text-[11px] font-black bg-red-50 text-red-600 border border-red-100 uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-red-600 animate-pulse"></span> <span class="hidden sm:inline">Stock Bajo</span><span class="sm:hidden">Bajo</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 md:gap-2 px-2 md:px-3 py-1 md:py-1.5 rounded-full text-[9px] md:text-[11px] font-black bg-green-50 text-[#0f763e] border border-green-100 uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-[#0f763e]"></span> <span class="hidden sm:inline">En Stock</span><span class="sm:hidden">OK</span>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-8 py-12 md:py-20 text-center text-gray-400 font-medium">No se encontraron productos disponibles.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    @vite('resources/js/cajero/inventario.js')
</body>
</html>