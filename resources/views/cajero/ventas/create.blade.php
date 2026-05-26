<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta - Abarrotes Central</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800">

    {{-- =====================================================================
         FORM PRINCIPAL: envuelve TODA la página para que el modal-confirmacion
         (con el botón type="submit") pueda enviar al backend.
    ====================================================================== --}}
    <form action="{{ route('cajero.ventas.store') }}" method="POST" id="form-venta" class="flex w-full h-full"
          x-data="{ showModal: false, totalVenta: 0 }" 
          @total-actualizado.window="totalVenta = $event.detail">
        @csrf

        {{-- Input oculto que el JS actualiza con el total calculado --}}
        <input type="hidden" name="total" id="input-total" value="0">

        {{-- ================================================================
             SIDEBAR NAVEGACIÓN
        ================================================================ --}}
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
                    <a href="{{ route('cajero.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Inicio
                    </a>
                    <a href="{{ route('cajero.ventas.create') }}" class="flex items-center gap-3 px-4 py-3 bg-green-50 text-[#0f763e] rounded-xl font-bold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        Registrar Venta
                    </a>
                    <a href="{{ route('cajero.inventario.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Inventario
                    </a>
                    <a href="{{ route('cajero.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Mis Ventas
                    </a>
                </nav>
            </div>

            <div class="p-6 border-t border-gray-100 space-y-4">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Turno
                </a>
            </div>
        </aside>

        {{-- ================================================================
             SIDEBAR CATEGORÍAS
        ================================================================ --}}
        <div class="w-60 bg-white border-r border-gray-200 flex flex-col h-full shrink-0 z-10">
            <div class="p-6 pb-2">
                <h2 class="text-xl font-bold text-gray-900">Categorías</h2>
            </div>
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                
                <a href="{{ route('cajero.ventas.create', 'todos') }}" 
                   class="flex items-center justify-between px-4 py-2.5 rounded-lg transition-colors {{ is_null($categoriaSeleccionada) ? 'bg-[#0f763e] text-white font-semibold shadow-sm' : 'text-gray-600 hover:bg-gray-50 font-medium' }}">
                    <div class="flex items-center gap-3">Todos</div>
                </a>

                @foreach($categorias as $categoria)
                    <a href="{{ route('cajero.ventas.categoria', $categoria->id) }}" 
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors {{ ($categoriaSeleccionada && $categoriaSeleccionada->id == $categoria->id) ? 'bg-[#0f763e] text-white font-semibold shadow-sm' : 'text-gray-600 hover:bg-gray-50 font-medium' }}">
                        {{ $categoria->nombre }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- ================================================================
             ÁREA PRINCIPAL DE PRODUCTOS
        ================================================================ --}}
        <main class="flex-1 flex flex-col h-full overflow-hidden bg-[#f8fafc] relative">
            
            <header class="bg-white border-b border-gray-200 h-[72px] px-8 flex justify-end items-center shrink-0">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre ?? 'Cajero' }}</p>
                        <p class="text-xs text-gray-500">Caja 01</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold border border-gray-200">
                        {{ substr(Auth::user()->nombre ?? 'C', 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 pb-32">
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ $categoriaSeleccionada ? $categoriaSeleccionada->nombre : 'Todos los productos' }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="contenedor-productos">
                    
                    @forelse($productos as $product)
                        @php
                            // Precio vigente: registro de precios_productos con fecha_fin IS NULL
                            $precioActual = $product->precioActual->precio ?? 0;
                        @endphp

                        <div class="producto-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col"
                             data-precio="{{ $precioActual }}">
                            
                            <div class="relative h-40 bg-gray-50 flex items-center justify-center p-4">
                                @if($product->stock <= 5)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded">POCO STOCK</span>
                                @endif
                                
                                @if($product->imagen)
                                    <img src="{{ asset('storage/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="h-full object-contain">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-full opacity-50 flex items-center justify-center text-gray-400">Sin img</div>
                                @endif
                            </div>

                            <div class="p-4 flex flex-col flex-1">
                                <p class="text-xs text-gray-400 mb-1">{{ $product->categoria->nombre ?? 'General' }}</p>
                                <h3 class="text-sm font-bold text-gray-800 leading-tight mb-2">{{ $product->nombre }}</h3>
                                
                                <div class="mt-auto">
                                    <div class="flex items-center justify-between mb-3">
                                        {{-- Precio vigente desde precios_productos --}}
                                        <span class="text-lg font-black text-[#0f763e]">${{ number_format($precioActual, 2) }}</span>
                                        <span class="text-xs font-medium {{ $product->stock > 5 ? 'text-green-600' : 'text-red-500' }} flex items-center gap-1">
                                            Stock: {{ $product->stock }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center gap-2">
                                        <div class="flex-1 flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-2 py-1.5">
                                            <button type="button" class="btn-restar text-gray-400 hover:text-gray-700 w-8 h-8 flex items-center justify-center font-bold text-lg">-</button>
                                            
                                            <input type="number" 
                                                   name="productos[{{ $product->id }}][cantidad]" 
                                                   class="input-cantidad w-10 text-center bg-transparent border-none p-0 font-bold text-gray-800 text-sm focus:ring-0" 
                                                   value="0" min="0" max="{{ $product->stock }}" readonly>

                                            {{-- Precio vigente en el momento de la venta --}}
                                            <input type="hidden" 
                                                   name="productos[{{ $product->id }}][precio]" 
                                                   value="{{ $precioActual }}">

                                            <button type="button" class="btn-sumar text-gray-400 hover:text-gray-700 w-8 h-8 flex items-center justify-center font-bold text-lg">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-10 text-center text-gray-500">
                            No se encontraron productos para esta categoría.
                        </div>
                    @endforelse

                </div>
            </div>

            {{-- ============================================================
                 BARRA INFERIOR: Total + Botón Cobrar
            ============================================================ --}}
            <div class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-6 flex justify-between items-center shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-20">
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Total de la Venta</p>
                    <p class="text-4xl font-black text-[#0f763e]" id="display-total-inferior">$0.00</p>
                </div>
                
                {{-- Abre el modal SOLO si totalVenta > 0 --}}
                <button type="button" 
                        @click="if(totalVenta > 0) showModal = true; else alert('Agregue al menos un producto.')" 
                        class="bg-[#0f763e] text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#0c6132] transition-colors shadow-lg shadow-green-200 flex items-center gap-3 disabled:opacity-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Cobrar / Generar Ticket
                </button>
            </div>

            {{-- Modal de confirmación (DENTRO del <form> para que type="submit" funcione) --}}
            @include('cajero.ventas.partials.modal-confirmacion')

        </main>
    </form>

    {{-- Form de logout independiente --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tarjetas    = document.querySelectorAll('.producto-card');
            const displayTotal = document.getElementById('display-total-inferior');
            const inputTotal   = document.getElementById('input-total');

            // Variable global accesible también por Alpine.js vía evento
            window.totalVenta = 0;

            function recalcularTotal() {
                let granTotal = 0;

                tarjetas.forEach(tarjeta => {
                    // Precio vigente desde data-precio (ya seteado desde precioActual)
                    const precio   = parseFloat(tarjeta.getAttribute('data-precio')) || 0;
                    const cantidad = parseInt(tarjeta.querySelector('.input-cantidad').value) || 0;
                    granTotal += (precio * cantidad);
                });

                // Actualizar display visual
                displayTotal.innerText = '$' + granTotal.toFixed(2);

                // Actualizar input oculto que se enviará al backend
                inputTotal.value = granTotal.toFixed(2);

                // Actualizar variable global y disparar evento para Alpine
                window.totalVenta = granTotal;
                window.dispatchEvent(new CustomEvent('total-actualizado', { detail: granTotal }));
            }

            tarjetas.forEach(tarjeta => {
                const btnSumar     = tarjeta.querySelector('.btn-sumar');
                const btnRestar    = tarjeta.querySelector('.btn-restar');
                const inputCantidad = tarjeta.querySelector('.input-cantidad');
                const maxStock     = parseInt(inputCantidad.getAttribute('max')) || 0;

                btnSumar.addEventListener('click', () => {
                    let cantActual = parseInt(inputCantidad.value);
                    if (cantActual < maxStock) {
                        inputCantidad.value = cantActual + 1;
                        recalcularTotal();
                    }
                });

                btnRestar.addEventListener('click', () => {
                    let cantActual = parseInt(inputCantidad.value);
                    if (cantActual > 0) {
                        inputCantidad.value = cantActual - 1;
                        recalcularTotal();
                    }
                });
            });
        });
    </script>
</body>
</html>