<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta - Abarrotes Central</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        /* Hide scrollbar for category tabs on mobile for cleaner look */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800">

    <form action="{{ route('cajero.ventas.store') }}" method="POST" id="form-venta" class="flex w-full h-full"
          x-data="{ showModal: false, totalVenta: 0, sidebarOpen: false }" 
          @total-actualizado.window="totalVenta = $event.detail">
        @csrf
        <input type="hidden" name="total" id="input-total" value="0">

        {{-- Overlay Nav --}}
        <div x-show="sidebarOpen"
             x-cloak
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed lg:static lg:translate-x-0 w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-full shrink-0 z-50 transition-transform duration-300 ease-in-out">
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                <div class="p-6 pb-8 border-b border-gray-50 flex items-center justify-center flex-col text-center relative">
                    <button type="button" @click="sidebarOpen = false" class="absolute top-4 right-4 lg:hidden text-gray-400 hover:text-gray-600">
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
                    <a href="{{ route('cajero.ventas.create') }}" class="flex items-center gap-3 px-4 py-3 bg-green-50 text-[#0f763e] rounded-xl font-bold transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        Registrar Venta
                    </a>
                    <a href="{{ route('cajero.inventario.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
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
                <button type="button" onclick="document.getElementById('logout-form').submit();" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Turno
                </button>
            </div>
        </aside>

        {{-- Wrapper principal derecho --}}
        <div class="flex-1 flex flex-col h-full min-w-0 bg-[#f8fafc] relative">
            
            <header class="bg-white border-b border-gray-200 h-[64px] md:h-[72px] px-4 md:px-8 flex justify-between items-center shrink-0">
                <div class="flex items-center gap-3">
                    <button type="button" @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 hidden sm:block">Punto de Venta</h2>
                    <h2 class="text-lg font-bold text-gray-800 sm:hidden">POS</h2>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre }}</p>
                        <p class="text-xs text-gray-500">Cajero Activo</p>
                    </div>
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold border border-gray-200 shrink-0 text-sm md:text-base">
                        {{ substr(Auth::user()->nombre ?? 'C', 0, 1) }}
                    </div>
                </div>
            </header>

            {{-- Contenido con Sidebar de Categorias + Grid --}}
            <div class="flex-1 flex flex-col md:flex-row overflow-hidden relative pb-[88px] md:pb-[96px]">
                
                {{-- Categorias --}}
                <div class="w-full md:w-56 lg:w-64 bg-white border-b md:border-b-0 md:border-r border-gray-200 flex flex-col shrink-0 z-10 h-auto md:h-full">
                    <div class="p-4 md:p-6 pb-2 hidden md:block">
                        <h2 class="text-lg font-bold text-gray-900">Categorías</h2>
                    </div>
                    
                    <nav class="flex-1 overflow-x-auto md:overflow-y-auto no-scrollbar md:custom-scrollbar p-2 md:p-4 flex flex-row md:flex-col gap-2 md:gap-1 items-center md:items-stretch">
                        
                        <a href="{{ route('cajero.ventas.categoria', 'todos') }}" 
                           class="flex items-center gap-2 px-4 py-2 md:px-4 md:py-2.5 rounded-full md:rounded-lg transition-colors whitespace-nowrap shrink-0 text-xs md:text-sm {{ is_null($categoriaSeleccionada) ? 'bg-[#0f763e] text-white font-bold shadow-sm' : 'bg-gray-50 md:bg-transparent text-gray-600 hover:bg-gray-100 font-medium border border-gray-100 md:border-transparent' }}">
                            Todos
                        </a>

                        <a href="{{ route('cajero.ventas.categoria', 'mas-vendidos') }}" 
                           class="flex items-center gap-2 px-4 py-2 md:px-4 md:py-2.5 rounded-full md:rounded-lg transition-colors whitespace-nowrap shrink-0 text-xs md:text-sm {{ ($categoriaSeleccionada && $categoriaSeleccionada->nombre === 'Más vendidos') ? 'bg-[#0f763e] text-white font-bold shadow-sm' : 'bg-gray-50 md:bg-transparent text-gray-600 hover:bg-gray-100 font-medium border border-gray-100 md:border-transparent' }}">
                            Más vendidos
                        </a>

                        @foreach($categorias as $categoria)
                            <a href="{{ route('cajero.ventas.categoria', $categoria->id) }}" 
                               class="flex items-center gap-2 px-4 py-2 md:px-4 md:py-2.5 rounded-full md:rounded-lg transition-colors whitespace-nowrap shrink-0 text-xs md:text-sm {{ ($categoriaSeleccionada && $categoriaSeleccionada->id == $categoria->id) ? 'bg-[#0f763e] text-white font-bold shadow-sm' : 'bg-gray-50 md:bg-transparent text-gray-600 hover:bg-gray-100 font-medium border border-gray-100 md:border-transparent' }}">
                                {{ $categoria->nombre }}
                            </a>
                        @endforeach
                    </nav>
                </div>

                {{-- Productos --}}
                <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8 custom-scrollbar">
                    
                    <div class="flex justify-between items-end mb-4 md:mb-6 hidden md:flex">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900">
                            {{ $categoriaSeleccionada ? $categoriaSeleccionada->nombre : 'Todos los productos' }}
                        </h2>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3 md:gap-4 lg:gap-6" id="contenedor-productos">
                        
                        @forelse($productos as $product)
                            @php
                                $precioActual = $product->precioActual->precio ?? 0;
                            @endphp

                            <div class="producto-card bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col group hover:shadow-md transition-shadow"
                                 data-precio="{{ $precioActual }}">
                                
                                <div class="relative h-28 sm:h-32 md:h-40 bg-gray-100 overflow-hidden border-b border-gray-100">
                                    @if($product->stock <= 5)
                                        <span class="absolute top-1.5 left-1.5 md:top-2 md:left-2 bg-red-500 text-white text-[8px] md:text-[10px] font-bold px-1.5 md:px-2 py-0.5 md:py-1 rounded shadow-sm z-10">POCO STOCK</span>
                                    @endif
                                    
                                    @if($product->imagen)
                                        <img src="{{ asset('storage/' . $product->imagen) }}" 
                                             alt="{{ $product->nombre }}" 
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full text-gray-400 text-xs md:text-sm font-medium">
                                            Sin imagen
                                        </div>
                                    @endif
                                </div>

                                <div class="p-3 md:p-4 flex flex-col flex-1">
                                    <p class="text-[9px] md:text-xs text-gray-400 mb-0.5 md:mb-1 truncate">{{ $product->categoria->nombre ?? 'General' }}</p>
                                    <h3 class="text-xs md:text-sm font-bold text-gray-800 leading-tight mb-2 line-clamp-2">{{ $product->nombre }}</h3>
                                    
                                    <div class="mt-auto">
                                        <div class="flex items-center justify-between mb-2.5 md:mb-3">
                                            <span class="text-sm md:text-lg font-black text-[#0f763e]">${{ number_format($precioActual, 2) }}</span>
                                            <span class="text-[9px] md:text-xs font-medium {{ $product->stock > 5 ? 'text-green-600' : 'text-red-500' }}">
                                                Disp: {{ $product->stock }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center">
                                            <div class="w-full flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg md:rounded-xl px-1.5 md:px-2 py-1 md:py-1.5">
                                                <button type="button" class="btn-restar text-gray-400 hover:text-gray-700 w-6 h-6 md:w-8 md:h-8 flex items-center justify-center font-bold text-sm md:text-lg">-</button>
                                                
                                                <input type="number" 
                                                       name="productos[{{ $product->id }}][cantidad]" 
                                                       class="input-cantidad w-8 md:w-10 text-center bg-transparent border-none p-0 font-bold text-gray-800 text-xs md:text-sm focus:ring-0" 
                                                       value="0" min="0" max="{{ $product->stock }}" readonly>

                                                <input type="hidden" 
                                                       name="productos[{{ $product->id }}][precio]" 
                                                       value="{{ $precioActual }}">

                                                <button type="button" class="btn-sumar text-gray-400 hover:text-gray-700 w-6 h-6 md:w-8 md:h-8 flex items-center justify-center font-bold text-sm md:text-lg">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-10 md:py-20 text-center text-gray-500 text-sm md:text-base">
                                No se encontraron productos para esta categoría.
                            </div>
                        @endforelse

                    </div>
                </main>
            </div>

            {{-- Barra Inferior Fija --}}
            <div class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 md:p-6 flex justify-between items-center shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-20 h-[88px] md:h-[96px]">
                <div>
                    <p class="text-[10px] md:text-sm text-gray-500 font-bold uppercase tracking-wider mb-0.5 md:mb-1">Total Venta</p>
                    <p class="text-2xl md:text-4xl font-black text-[#0f763e] leading-none" id="display-total-inferior">$0.00</p>
                </div>
                
                <button type="button" 
                        @click="if(totalVenta > 0) showModal = true; else alert('Agregue al menos un producto.')" 
                        class="bg-[#0f763e] text-white px-5 md:px-8 py-3 md:py-4 rounded-xl font-bold text-sm md:text-lg hover:bg-[#0c6132] transition-colors shadow-lg shadow-green-200 flex items-center gap-2 md:gap-3 disabled:opacity-50">
                    <svg class="w-5 h-5 md:w-6 md:h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="hidden sm:inline">Cobrar / Generar Ticket</span>
                    <span class="sm:hidden">Cobrar</span>
                </button>
            </div>

        </div>

        @include('cajero.ventas.partials.modal-confirmacion')
    </form>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    @vite('resources/js/cajero/ventas-create.js')
</body>
</html>