<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abarrotes Don Pepe - Catálogo</title>
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between gap-10">
            
            <div class="flex items-center gap-4 shrink-0">
                <a href="{{ route('admin.login') }}" 
                   class="bg-green-50 text-green-700 hover:bg-green-100 px-6 py-3 rounded-2xl flex items-center gap-2 text-sm font-black border border-green-200 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Administrador
                </a>
                <a href="{{ route('cajero.login') }}" 
                   class="bg-blue-50 text-blue-700 hover:bg-blue-100 px-6 py-3 rounded-2xl flex items-center gap-2 text-sm font-black border border-blue-200 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Cajero
                </a>
            </div>

            <div class="flex-1 max-w-3xl relative group">
                <input type="text" id="input-buscador" placeholder="¿Qué estás buscando hoy?..." 
                       class="w-full pl-8 pr-14 py-4 bg-gray-100 border-2 border-transparent rounded-3xl focus:bg-white focus:border-green-600 focus:ring-8 focus:ring-green-50 outline-none transition-all duration-300 text-lg font-medium shadow-inner">
                <div class="absolute inset-y-0 right-0 flex items-center pr-6 text-gray-400 group-focus-within:text-green-600 transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex flex-col items-center shrink-0">
                <div class="bg-green-600 p-2 rounded-xl shadow-md">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                </div>
                <span class="text-[11px] font-black tracking-[0.2em] text-green-700 uppercase mt-1">Don Pepe</span>
            </div>
        </div>

        <div class="bg-white border-t border-gray-100 overflow-x-auto shadow-sm">
            <div class="max-w-7xl mx-auto px-4 flex gap-6 py-4 justify-center" id="contenedor-filtros">
                <button data-cat="Todos" class="btn-filtro px-8 py-2.5 rounded-2xl text-sm font-black bg-green-600 text-white shadow-lg shadow-green-100 transition-all">Todos</button>
                <button data-cat="Alimentos" class="btn-filtro px-8 py-2.5 rounded-2xl text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100">Alimentos</button>
                <button data-cat="Bebidas" class="btn-filtro px-8 py-2.5 rounded-2xl text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100">Bebidas</button>
                <button data-cat="Higiene" class="btn-filtro px-8 py-2.5 rounded-2xl text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100">Higiene</button>
                <button data-cat="Limpieza" class="btn-filtro px-8 py-2.5 rounded-2xl text-sm font-bold text-gray-500 hover:bg-gray-100 hover:text-green-700 transition-all border border-transparent hover:border-green-100">Limpieza</button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10" id="grid-productos">
            @forelse($products as $product)
                <div class="card-producto bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative flex flex-col group hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    
                    {{-- Usamos $product->stock para asegurar consistencia con la base de datos --}}
                    @if($product->stock > 0 && $product->stock <= 5)
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg z-10 animate-bounce">
                            ¡ÚLTIMAS {{ $product->stock }} PIEZAS!
                        </span>
                    @elseif($product->stock == 0)
                        <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] z-20 flex items-center justify-center">
                            <span class="bg-gray-800 text-white text-xs font-black px-4 py-2 rounded-xl shadow-xl rotate-12">AGOTADO</span>
                        </div>
                    @else
                        <span class="absolute top-4 left-4 bg-green-700 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-md z-10 uppercase tracking-wider">
                            En Existencia
                        </span>
                    @endif

                    <div class="relative h-56 overflow-hidden bg-gray-50">
                        @if($product->imagen)
                            <img src="{{ asset('storage/' . $product->imagen) }}" alt="{{ $product->nombre }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-cat-prod text-[11px] font-black text-green-600/50 uppercase tracking-[0.2em] mb-2">{{ $product->categoria->nombre ?? 'General' }}</span>
                        <h2 class="text-nombre-prod text-lg font-bold text-gray-800 leading-tight mb-4 group-hover:text-green-700 transition-colors">
                            {{ $product->nombre }}
                        </h2>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-end justify-between">
                            <div class="flex flex-col">
                                <span class="text-3xl font-black text-gray-900">${{ number_format($product->precio, 2) }}</span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Precio Unitario</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 text-lg font-medium">No hay productos disponibles en este momento.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white py-12 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-green-700 font-black text-2xl tracking-tighter">Abarrotes Don Pepe</span>
            <p class="text-gray-400 text-sm mt-2">Calidad y frescura en cada producto.</p>
        </div>
    </footer>
</body>
</html>