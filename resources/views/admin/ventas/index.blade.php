<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas - Abarrotes Central</title>
    @vite(['resources/css/app.css'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>

<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800" x-data="{ showModal: false, ventaDetalle: {} }">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-full shrink-0 z-20">
        <div class="p-6 border-b border-gray-50">
            <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Abarrotes Central</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-1.5 custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.productos.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Inventario
            </a>
            <a href="{{ route('admin.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#0f763e] text-white rounded-xl font-medium transition-colors shadow-md shadow-green-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Ventas
            </a>
            <a href="{{ route('admin.reportes.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Reportes
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios & Roles
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100 space-y-3">
            <a href="{{ route('admin.productos.index') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-[#f97316] hover:bg-[#ea580c] text-white rounded-xl font-bold transition-colors shadow-md shadow-orange-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nuevo Producto
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-[#f8fafc] h-[72px] px-8 flex justify-between items-center shrink-0 border-b border-gray-100">
            <h2 class="text-2xl font-black text-gray-800 tracking-tight hidden md:block">Historial de Ventas</h2>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden lg:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 italic">Store Manager</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0f763e] flex items-center justify-center text-white font-bold uppercase shadow-md border-2 border-white">
                        {{ substr(Auth::user()->nombre ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">ID Venta</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Fecha y Hora</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">Artículos</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Cajero</th>
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
                            <td class="px-8 py-5 text-sm font-bold text-gray-700">
                                {{ $venta->usuario->nombre ?? 'N/A' }}
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button 
                                    type="button"
                                    @click="
                                        ventaDetalle = {
                                            id: '{{ $venta->id }}',
                                            total: '{{ number_format($venta->total, 2) }}',
                                            fecha: '{{ $venta->created_at->format('d/m/Y H:i') }}',
                                            metodo_pago: '{{ $venta->metodo_pago ?? 'Efectivo' }}',
                                            cajero: '{{ addslashes($venta->usuario->nombre ?? 'N/A') }}',
                                            url_ticket: '{{ route('cajero.ventas.ticket', $venta->id) }}',
                                            productos: {{ $venta->detalles->map(fn($d) => [
                                                'nombre' => addslashes($d->producto->nombre ?? 'Desconocido'),
                                                'cant' => $d->cantidad,
                                                'precio_unitario' => number_format($d->precio_unitario, 2),
                                                'subtotal' => number_format($d->subtotal, 2)
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
                            <td colspan="6" class="px-8 py-20 text-center">
                                <p class="text-gray-400 font-bold">No se encontraron ventas registradas.</p>
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
