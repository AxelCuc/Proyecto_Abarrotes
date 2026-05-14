<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abarrotes Don Pepe - Punto de Venta</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <header class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        
        <div class="flex-1 flex items-center gap-4">
            <!-- Botón Administrador -->
            <a href="{{ route('admin.login') }}" 
               class="bg-green-50 text-green-700 hover:bg-green-100 px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm font-bold border border-green-200 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Administrador
            </a>

            <!-- Botón Cajero -->
            <a href="{{ route('cajero.login') }}" 
               class="bg-blue-50 text-blue-700 hover:bg-blue-100 px-3 py-1.5 rounded-lg flex items-center gap-2 text-sm font-bold border border-blue-200 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Cajero
            </a>
        </div>

        <!-- Logo central -->
        <div class="flex-1 flex justify-center items-center flex-col">
            <div class="bg-green-600 p-1.5 rounded-lg mb-1">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
            </div>
            <span class="text-xs font-black tracking-widest text-green-700 uppercase">Abarrotes</span>
        </div>

        <div class="flex-1"></div>
    </div>
</header>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        @if(session('error'))
            <div class="mb-8 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                <p class="font-bold">Error de Autenticación</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative flex flex-col group hover:shadow-xl transition-all duration-300">
                    
                    @if($product->cantidad <= 5)
                        <span class="absolute top-3 left-3 bg-orange-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm z-10">
                            POCO STOCK
                        </span>
                    @else
                        <span class="absolute top-3 left-3 bg-green-700 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm z-10">
                            FRESCO HOY
                        </span>
                    @endif

                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($product->imagen)
                            <img src="{{ asset('storage/' . $product->imagen) }}" 
                                 alt="{{ $product->nombre }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h2 class="text-base font-bold text-gray-800 leading-tight mb-1 group-hover:text-green-700 transition-colors">
                            {{ $product->nombre }}
                        </h2>
                        
                        <p class="text-xs text-gray-400 mb-4 font-medium">1 unidad / Stock: {{ $product->cantidad }}</p>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-2xl font-black text-gray-900">
                                ${{ number_format($product->precio, 2) }}
                            </span>
                            
                            <button class="w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-orange-200 transition-all shadow-md active:scale-95">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-400 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <svg class="w-20 h-20 mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-xl font-medium text-gray-500">No hay productos en inventario.</p>
                    <p class="text-sm">Inicia sesión como administrador para agregar nuevos productos.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white text-gray-400 border-t border-gray-200 mt-20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="text-green-700 font-black text-lg">Abarrotes Don Pepe</span>
                <span class="hidden md:block text-gray-300">|</span>
            </div>
            
        </div>
    </footer>
</body>
</html>