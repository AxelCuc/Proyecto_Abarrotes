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
            <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Tienda Central</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-1.5 custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Panel de Control
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
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl font-bold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-[#f8fafc] h-[72px] px-8 flex justify-between items-center shrink-0 border-b border-gray-100">
            <h2 class="text-2xl font-black text-gray-800 tracking-tight hidden md:block">Panel de Administrador</h2>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden lg:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 italic">Gerente</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0f763e] flex items-center justify-center text-white font-bold uppercase shadow-md border-2 border-white">
                        {{ substr(Auth::user()->nombre ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 pt-6 custom-scrollbar">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-black text-gray-800 tracking-tight">Registro de Transacciones</h1>
                    <p class="text-sm text-gray-500 font-medium mt-1">Filtra, consulta y exporta los movimientos del negocio.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.ventas.export.excel') }}" class="px-5 py-2.5 bg-[#107c41] hover:bg-[#0c5e31] text-white rounded-xl text-sm font-bold shadow-md shadow-green-100 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Excel
                    </a>
                    <a href="{{ route('admin.ventas.export.pdf') }}" class="px-5 py-2.5 bg-[#b91c1c] hover:bg-[#991b1b] text-white rounded-xl text-sm font-bold shadow-md shadow-red-100 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        PDF
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.ventas.index') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-wrap gap-4 items-end mb-6">
                <div class="flex-1 min-w-[180px]">
                    <label class="block text-xs font-bold text-gray-600 mb-1.5 ml-1">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:bg-white focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-700">
                </div>
                <div class="flex-1 min-w-[180px]">
                    <label class="block text-xs font-bold text-gray-600 mb-1.5 ml-1">Fecha de Fin</label>
                    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:bg-white focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-700">
                </div>
                <div class="flex-1 min-w-[180px]">
                    <label class="block text-xs font-bold text-gray-600 mb-1.5 ml-1">Cajero / Usuario</label>
                    <div class="relative">
                        <select name="cajero_id" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:bg-white focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-700 appearance-none cursor-pointer">
                            <option value="">Todos los cajeros</option>
                            @foreach($cajeros as $cajero)
                                <option value="{{ $cajero->id }}" @selected(request('cajero_id') == $cajero->id)>
                                    {{ $cajero->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                <button type="submit" class="px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white rounded-xl text-sm font-bold shadow-md transition-colors h-[42px] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Aplicar Filtros
                </button>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Total Ventas</p>
                        <p class="text-2xl font-black text-gray-800 leading-none">{{ $totalVentas }}</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-50 text-[#0f763e] flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Ingresos Totales</p>
                        <p class="text-2xl font-black text-[#0f763e] leading-none">${{ number_format($totalIngresos,2) }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Transacciones</p>
                        <p class="text-2xl font-black text-gray-800 leading-none">{{ $numTransacciones }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Top Producto</p>
                        <p class="text-sm font-bold text-gray-800 truncate" title="{{ $productoMasVendido }}">{{ $productoMasVendido }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-[11px] font-black text-gray-400 uppercase tracking-wider">ID Venta</th>
                            <th class="px-6 py-4 text-[11px] font-black text-gray-400 uppercase tracking-wider">Fecha y Hora</th>
                            <th class="px-6 py-4 text-[11px] font-black text-gray-400 uppercase tracking-wider text-center">Artículos</th>
                            <th class="px-6 py-4 text-[11px] font-black text-gray-400 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-[11px] font-black text-gray-400 uppercase tracking-wider">Cajero</th>
                            <th class="px-6 py-4 text-[11px] font-black text-gray-400 uppercase tracking-wider text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($ventas as $venta)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-700">
                                        #V-{{ $venta->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-600">
                                    {{ $venta->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 text-center font-medium">
                                    <span class="px-2 py-1 bg-gray-50 rounded-lg border border-gray-100">
                                        {{ $venta->detalles->sum('cantidad') }} un.
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-black text-[#0f763e]">
                                    ${{ number_format($venta->total,2) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                                    {{ $venta->usuario->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button 
                                        @click="showModal = true; ventaDetalle = {
                                            id: '{{ $venta->id }}',
                                            total: '{{ number_format($venta->total,2) }}',
                                            cajero: '{{ $venta->usuario->nombre ?? 'N/A' }}',
                                            fecha: '{{ $venta->created_at->format('d/m/Y H:i') }}',
                                            productos: [
                                                @foreach($venta->detalles as $detalle)
                                                    {
                                                        nombre: '{{ $detalle->producto->nombre ?? 'Producto' }}',
                                                        cantidad: '{{ $detalle->cantidad }}',
                                                        precio_unitario: '{{ number_format($detalle->precio_unitario,2) }}',
                                                        subtotal: '{{ number_format($detalle->subtotal,2) }}'
                                                    },
                                                @endforeach
                                            ]
                                        }"
                                        class="px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 rounded-xl text-xs font-bold transition-colors inline-flex items-center gap-1.5"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Ver Detalles
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mb-3">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </div>
                                        <p class="text-gray-500 font-bold">No se encontraron ventas registradas con estos filtros.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $ventas->links() }}
            </div>

        </div>
    </main>

    @include('cajero.ventas.partials.modal-detalle')

</body>
</html>