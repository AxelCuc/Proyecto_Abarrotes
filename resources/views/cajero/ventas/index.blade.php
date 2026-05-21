<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas - Abarrotes Central</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* Opcional: Personalización del scroll para la lista de productos */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #0f763e; border-radius: 10px; }
    </style>
</head>

<body x-data="{ showModal: false, ventaDetalle: {} }" 
      class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800">

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
                <a href="{{ route('cajero.ventas.create') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Registrar Venta
                </a>
                <a href="{{ route('cajero.inventario.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Inventario
                </a>
                <a href="{{ route('cajero.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 bg-green-50 text-[#0f763e] rounded-xl font-bold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Mis Ventas
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Turno
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-white border-b border-gray-200 h-[72px] px-8 flex justify-between items-center shrink-0">
            <h2 class="text-xl font-bold text-gray-800">Historial de Transacciones</h2>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre }}</p>
                    <p class="text-xs text-gray-500 italic">Cajero Activo</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-[#0f763e] font-bold border border-green-200 uppercase">
                    {{ substr(Auth::user()->nombre, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">Ventas de Hoy</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-[#0f763e]">${{ number_format(\App\Models\Venta::whereDate('created_at', today())->sum('total'), 2) }}</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mb-1">Transacciones</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-gray-800">{{ \App\Models\Venta::whereDate('created_at', today())->count() }}</span>
                        <span class="text-sm font-medium text-gray-400 italic">hoy</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 mb-6 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    @php
                        $btnBase = "px-6 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider transition-all duration-200";
                        $btnActive = "bg-[#0f763e] text-white shadow-lg shadow-green-100";
                        $btnInactive = "text-gray-400 hover:bg-gray-50 hover:text-gray-600";
                    @endphp

                    <a href="{{ route('cajero.ventas.filtro', 'todas') }}" class="{{ $btnBase }} {{ $periodo == 'todas' ? $btnActive : $btnInactive }}">Todas</a>
                    <a href="{{ route('cajero.ventas.filtro', 'hoy') }}" class="{{ $btnBase }} {{ $periodo == 'hoy' ? $btnActive : $btnInactive }}">Hoy</a>
                    <a href="{{ route('cajero.ventas.filtro', 'semana') }}" class="{{ $btnBase }} {{ $periodo == 'semana' ? $btnActive : $btnInactive }}">Semana</a>
                    <a href="{{ route('cajero.ventas.filtro', 'mes') }}" class="{{ $btnBase }} {{ $periodo == 'mes' ? $btnActive : $btnInactive }}">Mes</a>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">ID Venta</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Fecha y Hora</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">Artículos</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($ventas as $venta)
                        <tr class="hover:bg-gray-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <span class="font-black text-[#0f763e] text-sm">#V-{{ $venta->id }}</span>
                            </td>
                            <td class="px-8 py-5 text-sm text-gray-500 font-bold">
                                {{ $venta->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-xl text-xs font-black">
                                    {{ $venta->detalles->sum('cantidad') }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="font-black text-gray-900 text-base">${{ number_format($venta->total, 2) }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button 
                                    type="button"
                                    @click="
                                        ventaDetalle = {
                                            id: '{{ $venta->id }}',
                                            total: '{{ number_format($venta->total, 2) }}',
                                            fecha: '{{ $venta->created_at->format('d/m/Y H:i') }}',
                                            metodo: '{{ $venta->metodo_pago ?? 'Efectivo' }}',
                                            cajero: '{{ addslashes(Auth::user()->nombre) }}',
                                            url_ticket: '{{ route('cajero.ventas.ticket', $venta->id) }}',
                                            productos: {{ $venta->detalles->map(fn($d) => [
                                                'nombre' => addslashes($d->producto->nombre),
                                                'cant' => $d->cantidad,
                                                'precio' => number_format($d->subtotal, 2)
                                            ])->toJson() }}
                                        };
                                        showModal = true;
                                    "
                                    class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-[#0f763e] hover:text-[#0a5a2f] transition-colors"
                                >
                                    Detalles
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <p class="text-gray-400 font-bold">No se encontraron ventas en este periodo.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $ventas->links() }}
            </div>

        </div>
    </main>

    @include('cajero.ventas.partials.modal-detalle')

</body>
</html>