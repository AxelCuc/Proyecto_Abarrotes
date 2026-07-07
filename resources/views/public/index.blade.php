<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abarrotes Don Pepe - Catálogo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6 flex flex-col lg:flex-row items-center justify-between gap-4 md:gap-6 lg:gap-10">
            
            <div class="flex items-center justify-between lg:justify-start w-full lg:w-auto gap-4 shrink-0 order-1 lg:order-none">
                {{-- Logo Mobile --}}
                <div class="flex flex-col items-center shrink-0 lg:hidden">
                    <div class="bg-green-600 p-1.5 md:p-2 rounded-lg md:rounded-xl shadow-md">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.login') }}" 
                       class="bg-green-50 text-green-700 hover:bg-green-100 px-3 md:px-6 py-2 md:py-3 rounded-xl md:rounded-2xl flex items-center gap-1.5 md:gap-2 text-xs md:text-sm font-black border border-green-200 transition-all shadow-sm">
                        <svg class="w-4 h-4 md:w-5 md:h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="hidden sm:inline">Administrador</span>
                        <span class="sm:hidden">Admin</span>
                    </a>
                    <a href="{{ route('cajero.login') }}" 
                       class="bg-blue-50 text-blue-700 hover:bg-blue-100 px-3 md:px-6 py-2 md:py-3 rounded-xl md:rounded-2xl flex items-center gap-1.5 md:gap-2 text-xs md:text-sm font-black border border-blue-200 transition-all shadow-sm">
                        <svg class="w-4 h-4 md:w-5 md:h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        Cajero
                    </a>
                </div>
            </div>

            <div class="flex-1 w-full max-w-3xl relative group order-3 lg:order-2">
                <input type="text" id="input-buscador" placeholder="¿Qué estás buscando hoy?..." 
                       class="w-full pl-5 md:pl-8 pr-12 md:pr-14 py-3 md:py-4 bg-gray-100 border-2 border-transparent rounded-2xl md:rounded-3xl focus:bg-white focus:border-green-600 focus:ring-4 md:focus:ring-8 focus:ring-green-50 outline-none transition-all duration-300 text-sm md:text-lg font-medium shadow-inner">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 md:pr-6 text-gray-400 group-focus-within:text-green-600 transition-colors">
                    <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- Logo Desktop --}}
            <div class="hidden lg:flex flex-col items-center shrink-0 order-2 lg:order-3">
                <div class="bg-green-600 p-2 rounded-xl shadow-md">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                </div>
                <span class="text-[11px] font-black tracking-[0.2em] text-green-700 uppercase mt-1">Tienda Central</span>
            </div>
        </div>

        <div class="bg-white border-t border-gray-100 shadow-sm overflow-x-auto custom-scrollbar">
            <div class="max-w-7xl mx-auto px-4 flex gap-3 md:gap-6 py-3 md:py-4 justify-start sm:justify-center w-max sm:w-auto" id="contenedor-filtros">
                <button data-cat="Todos" class="btn-filtro px-6 md:px-8 py-2 md:py-2.5 rounded-xl md:rounded-2xl text-xs md:text-sm font-black bg-green-600 text-white shadow-md md:shadow-lg shadow-green-100 transition-all shrink-0">Todos</button>
                <button data-cat="Alimentos" class="btn-filtro px-6 md:px-8 py-2 md:py-2.5 rounded-xl md:rounded-2xl text-xs md:text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100 shrink-0">Alimentos</button>
                <button data-cat="Bebidas" class="btn-filtro px-6 md:px-8 py-2 md:py-2.5 rounded-xl md:rounded-2xl text-xs md:text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100 shrink-0">Bebidas</button>
                <button data-cat="Higiene" class="btn-filtro px-6 md:px-8 py-2 md:py-2.5 rounded-xl md:rounded-2xl text-xs md:text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100 shrink-0">Higiene</button>
                <button data-cat="Limpieza" class="btn-filtro px-6 md:px-8 py-2 md:py-2.5 rounded-xl md:rounded-2xl text-xs md:text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100 shrink-0">Limpieza</button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-8 lg:gap-10" id="grid-productos">
            @forelse($products as $product)
                @php $precioActual = $product->precioActual->precio ?? 0; @endphp
                <div class="card-producto bg-white rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative flex flex-col group hover:shadow-xl md:hover:shadow-2xl hover:-translate-y-1 md:hover:-translate-y-2 transition-all duration-500"
                     data-nombre="{{ strtolower($product->nombre) }}"
                     data-cat="{{ $product->categoria->nombre ?? '' }}">
                    
                    {{-- Badge de stock --}}
                    @if($product->stock > 0 && $product->stock <= 5)
                        <span class="absolute top-2 left-2 md:top-4 md:left-4 bg-red-600 text-white text-[8px] md:text-[10px] font-black px-2 md:px-3 py-1 md:py-1.5 rounded-full shadow-lg z-10 animate-pulse md:animate-bounce">
                            ¡ÚLTIMAS {{ $product->stock }}!
                        </span>
                    @elseif($product->stock == 0)
                        <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] z-20 flex items-center justify-center">
                            <span class="bg-gray-800 text-white text-[10px] md:text-xs font-black px-3 py-1.5 md:px-4 md:py-2 rounded-lg md:rounded-xl shadow-xl rotate-12">AGOTADO</span>
                        </div>
                    @else
                        <span class="absolute top-2 left-2 md:top-4 md:left-4 bg-green-700 text-white text-[8px] md:text-[10px] font-black px-2 md:px-3 py-1 md:py-1.5 rounded-full shadow-md z-10 uppercase tracking-wider">
                            En Existencia
                        </span>
                    @endif

                    <div class="relative h-36 sm:h-48 md:h-56 bg-gray-100 overflow-hidden">
                        @if($product->imagen)
                            <img src="{{ asset('storage/' . $product->imagen) }}" 
                                 alt="{{ $product->nombre }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-gray-400 text-xs md:text-sm font-medium">
                                Sin imagen
                            </div>
                        @endif
                    </div>

                    <div class="p-3 md:p-6 flex flex-col flex-grow">
                        <span class="text-cat-prod text-[9px] md:text-[11px] font-black text-green-600/50 uppercase tracking-widest md:tracking-[0.2em] mb-1.5 md:mb-2">{{ $product->categoria->nombre ?? 'General' }}</span>
                        <h2 class="text-nombre-prod text-sm md:text-lg font-bold text-gray-800 leading-tight mb-3 md:mb-4 group-hover:text-green-700 transition-colors line-clamp-2 md:line-clamp-none">
                            {{ $product->nombre }}
                        </h2>
                        
                        <div class="mt-auto pt-3 md:pt-4 border-t border-gray-50 flex items-end justify-between">
                            <div class="flex flex-col">
                                {{-- Precio vigente desde precios_productos --}}
                                <span class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900">${{ number_format($precioActual, 2) }}</span>
                                <span class="text-[8px] md:text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 md:mt-1">Precio Unitario</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 md:py-20 text-center">
                    <p class="text-gray-400 text-base md:text-lg font-medium">No hay productos disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white py-8 md:py-12 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-green-700 font-black text-xl md:text-2xl tracking-tighter">Tienda Central</span>
            <p class="text-gray-400 text-xs md:text-sm mt-2">Calidad y frescura en cada producto.</p>
        </div>
    </footer>

    {{-- El JS de esta vista es gestionado por resources/js/public.js (cargado via app.js) --}}
</body>
</html>