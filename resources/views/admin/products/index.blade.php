<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Abarrotes Central</title>
    @vite(['resources/css/app.css', 'resources/js/admin/products.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>

<body class="bg-[#f8fafc] font-sans text-gray-800" x-data="{ sidebarOpen: false }">

    {{-- Overlay para móvil --}}
    <div x-show="sidebarOpen"
         x-cloak
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

    <div class="flex h-screen overflow-hidden">

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed lg:static lg:translate-x-0 w-64 bg-white border-r border-gray-200 flex flex-col h-full shrink-0 z-40 transition-transform duration-300 ease-in-out">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Tienda Central</h1>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-1.5 custom-scrollbar">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Panel de Control
                </a>
                <a href="{{ route('admin.productos.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#0f763e] text-white rounded-xl font-medium transition-colors shadow-md shadow-green-100">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Inventario
                </a>
                <a href="{{ route('admin.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Ventas
                </a>
                <a href="{{ route('admin.reportes.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Reportes
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Usuarios &amp; Roles
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100 space-y-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-full overflow-hidden min-w-0">

            @if(session('success'))
                <div id="flash-message" data-type="success" data-message="{{ session('success') }}"></div>
            @endif
            @if($errors->any())
                <div id="flash-message" data-type="error" data-message="{{ $errors->first() }}"></div>
            @endif

            <header class="bg-[#f8fafc] h-[72px] px-4 md:px-8 flex justify-between items-center shrink-0 border-b border-gray-100">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight hidden md:block shrink-0">Administrador</h2>
                    <div class="flex-1 max-w-xl mx-0 md:mx-4">
                        <form action="{{ route('admin.productos.index') }}" method="GET" class="relative" id="form-buscar">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" name="q" value="{{ request('q') }}" id="input-buscar" placeholder="Buscar productos..."
                                   class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-colors shadow-sm">
                            @if(request('categoria'))
                                <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                            @endif
                            @if(request('stock'))
                                <input type="hidden" name="stock" value="{{ request('stock') }}">
                            @endif
                        </form>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0 ml-2">
                    <div class="text-right hidden lg:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre ?? 'Marta Sánchez' }}</p>
                        <p class="text-xs text-gray-500 italic">Gerente</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0f763e] flex items-center justify-center text-white font-bold uppercase shadow-md border-2 border-white">
                        {{ substr(Auth::user()->nombre ?? 'M', 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8 custom-scrollbar">

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-6 md:mb-8">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-gray-800 tracking-tight">Inventario de Productos</h1>
                        <p class="text-gray-500 font-medium mt-1 text-sm">Gestiona el catálogo, precios y existencias.</p>
                    </div>
                    <button type="button" id="btn-nuevo-producto" class="bg-[#f97316] hover:bg-[#ea580c] text-white px-5 py-2.5 rounded-xl font-bold flex items-center justify-center gap-2 shadow-sm transition-colors shrink-0 w-full sm:w-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nuevo Producto
                    </button>
                </div>

                <div class="flex flex-wrap items-center gap-2 mb-6 md:mb-8">
                    <a href="{{ route('admin.productos.index') }}" class="px-4 py-1.5 {{ !request('categoria') && !request('stock') ? 'bg-[#0f763e] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }} text-sm font-bold rounded-full shadow-sm transition-colors">Todos</a>

                    @foreach($categorias as $cat)
                        <a href="{{ route('admin.productos.index', ['categoria' => $cat->id, 'q' => request('q')]) }}" class="px-4 py-1.5 {{ request('categoria') == $cat->id ? 'bg-[#0f763e] text-white' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }} text-sm font-bold rounded-full transition-colors">{{ $cat->nombre }}</a>
                    @endforeach

                    <a href="{{ route('admin.productos.index', ['stock' => 'critico', 'q' => request('q')]) }}" class="px-4 py-1.5 {{ request('stock') == 'critico' ? 'bg-red-600 text-white' : 'bg-red-50 text-red-600 hover:bg-red-100' }} text-sm font-bold rounded-full transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Bajo Stock
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                    @forelse($productos as $producto)
                        @php
                            $isLowStock = $producto->stock > 0 && $producto->stock <= 10;
                            $isCriticalStock = $producto->stock > 0 && $producto->stock <= 5;
                            $isOutStock = $producto->stock == 0;

                            $stockBg = 'bg-green-50'; $stockText = 'text-[#0f763e]'; $stockBorder = 'border-green-100';
                            if ($isCriticalStock) {
                                $stockBg = 'bg-red-50'; $stockText = 'text-red-600'; $stockBorder = 'border-red-100';
                            } elseif ($isLowStock) {
                                $stockBg = 'bg-yellow-50'; $stockText = 'text-yellow-600'; $stockBorder = 'border-yellow-100';
                            } elseif ($isOutStock) {
                                $stockBg = 'bg-gray-100'; $stockText = 'text-gray-500'; $stockBorder = 'border-gray-200';
                            }
                        @endphp

                        <div class="bg-white rounded-[1.5rem] border {{ $isCriticalStock ? 'border-red-100' : 'border-gray-100' }} shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow relative {{ $isOutStock ? 'opacity-75 grayscale hover:grayscale-0' : '' }}">
                            @if($isCriticalStock)
                                <div class="absolute top-3 right-3 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                            @endif

                            <div class="h-40 md:h-48 bg-gray-100 relative overflow-hidden group">
                                @if($isOutStock)
                                    <div class="absolute inset-0 bg-white/40 backdrop-blur-[2px] z-10"></div>
                                    <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-800 text-white text-xs font-black px-3 py-1 rounded uppercase tracking-widest z-20">Agotado</span>
                                @endif
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                                         alt="{{ $producto->nombre }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 {{ $isOutStock ? 'opacity-50' : 'opacity-90' }}">
                                @else
                                    <div class="flex items-center justify-center w-full h-full text-gray-400 text-sm font-medium">
                                        Sin imagen
                                    </div>
                                @endif
                            </div>

                            <div class="p-4 md:p-5 flex flex-col flex-1">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</span>
                                <h3 class="text-base font-bold text-gray-800 leading-tight mb-3 md:mb-4 line-clamp-2">{{ $producto->nombre }}</h3>

                                <div class="flex items-center justify-between mb-4 md:mb-5 mt-auto">
                                    <span class="text-xl md:text-2xl font-black {{ $isOutStock ? 'text-gray-500' : 'text-[#0f763e]' }}">${{ number_format($producto->precioActual->precio ?? 0, 2) }}</span>
                                    <span class="px-3 py-1 {{ $stockBg }} {{ $stockText }} text-xs font-bold rounded-full border {{ $stockBorder }}">
                                        {{ $producto->stock }} unid.
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-2 pt-3 md:pt-4 border-t border-gray-100">
                                    <button type="button" data-action="editar"
                                        data-id="{{ $producto->id }}"
                                        data-nombre="{{ $producto->nombre }}"
                                        data-stock="{{ $producto->stock }}"
                                        data-precio="{{ $producto->precioActual->precio ?? '' }}"
                                        data-categoria="{{ $producto->categoria_id }}"
                                        data-imagen="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : '' }}"
                                        class="flex items-center justify-center gap-1.5 py-2 text-sm font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Editar
                                    </button>
                                    <button type="button" data-action="eliminar"
                                        data-id="{{ $producto->id }}"
                                        data-nombre="{{ $producto->nombre }}"
                                        class="flex items-center justify-center gap-1.5 py-2 text-sm font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center bg-white rounded-[1.5rem] border border-gray-100">
                            <p class="text-gray-500 font-medium">No se encontraron productos.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 md:mt-8">
                    {{ $productos->links() }}
                </div>

            </div>
        </main>

    </div>

    {{-- MODALES --}}
    @include('admin.products.partials.modal-create')
    @include('admin.products.partials.modal-edit')
    @include('admin.products.partials.modal-delete')
</body>
</html>