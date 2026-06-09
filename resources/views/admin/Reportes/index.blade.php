<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Abarrotes Central</title>
    @vite(['resources/css/app.css'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>

<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800" x-data="{ showPreviewModal: false }">

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
            <a href="{{ route('admin.ventas.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Ventas
            </a>
            <a href="{{ route('admin.reportes.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#0f763e] text-white rounded-xl font-medium transition-colors shadow-md shadow-green-100">
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
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        {{-- Topbar --}}
        <header class="bg-[#f8fafc] h-[72px] px-8 flex justify-between items-center shrink-0">
            <h2 class="text-2xl font-black text-gray-800 tracking-tight">Panel de Control Administrador</h2>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre ?? 'Administrador' }}</p>
                        <p class="text-xs text-gray-500 italic">Gerente</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0f763e] flex items-center justify-center text-white font-bold uppercase shadow-md border-2 border-white">
                        {{ substr(Auth::user()->nombre ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 pt-6 custom-scrollbar">

            <div class="mb-6">
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Reportes y Estadísticas</h1>
                <p class="text-sm text-gray-500 font-medium mt-1">Análisis detallado de rendimiento de la tienda.</p>
            </div>

            <form method="GET" action="{{ route('admin.reportes.index') }}" 
                  class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-wrap gap-4 items-end mb-8">
                
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-wider mb-1.5 ml-1">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:bg-white focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-700">
                </div>
                
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-wider mb-1.5 ml-1">Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:bg-white focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-700">
                </div>
                
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-wider mb-1.5 ml-1">Cajero</label>
                    <div class="relative">
                        <select name="cajero_id" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:bg-white focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-700 appearance-none cursor-pointer">
                            <option value="">Todos</option>
                            @foreach($cajeros ?? [] as $cajero)
                                <option value="{{ $cajero->id }}" @selected(request('cajero_id') == $cajero->id)>{{ $cajero->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                
                <div class="flex-1 min-w-[150px]">
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-wider mb-1.5 ml-1">Categoría</label>
                    <div class="relative">
                        <select name="categoria_id" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:bg-white focus:ring-1 focus:ring-[#0f763e] transition-all font-medium text-gray-700 appearance-none cursor-pointer">
                            <option value="">Todas</option>
                            @foreach($categorias ?? [] as $categoria)
                                <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white rounded-xl text-sm font-bold shadow-md transition-colors h-[42px] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filtrar
                </button>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">
                
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-50 text-[#0f763e] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Total de Ventas</p>
                        <p class="text-2xl font-black text-gray-900 leading-none">{{ $totalVentas ?? 0 }}</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Ingresos Acumulados</p>
                        <p class="text-2xl font-black text-[#0f763e] leading-none">${{ number_format($totalIngresos ?? 0, 2) }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Ticket Promedio</p>
                        <p class="text-2xl font-black text-gray-900 leading-none">${{ number_format($ticketPromedio ?? 0, 2) }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Producto Top</p>
                        <p class="text-lg font-bold text-gray-900 truncate" title="{{ $productoMasVendido ?? 'N/A' }}">{{ $productoMasVendido ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex flex-col gap-3">
                    <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-0.5">Top Cajero</p>
                        <p class="text-lg font-bold text-gray-900 truncate" title="{{ $cajeroTop ?? 'N/A' }}">{{ $cajeroTop ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Ventas por Día</h3>
                    <div class="h-64 relative">
                        <canvas id="chartVentasDia" data-values='@json($ventasPorDia ?? ["Lun"=>120,"Mar"=>200])'></canvas>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Ingresos Acumulados</h3>
                    <div class="h-64 relative">
                        <canvas id="chartIngresosAcumulados" data-values='@json($ingresosPorDia ?? ["1 May"=>1000,"5 May"=>2500])'></canvas>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Top Productos</h3>
                    <div class="h-64 relative">
                        <canvas id="chartTopProductos" data-values='@json($topProductos ?? ["Leche"=>420,"Pan"=>385])'></canvas>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
                    <h3 class="font-bold text-gray-900 mb-4">Categorías</h3>
                    <div class="flex-1 flex items-center justify-center relative min-h-[256px]">
                        <div class="h-full w-full max-w-[280px]">
                            <canvas id="chartCategorias" data-values='@json($categoriasDistribucion ?? ["Abarrotes"=>45,"Bebidas"=>25])'></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 lg:col-span-2">
                    <h3 class="font-bold text-gray-900 mb-4">Rendimiento por Cajero</h3>
                    <div class="h-64 relative">
                        <canvas id="chartVentasCajero" data-values='@json($ventasPorCajero ?? ["María L."=>1200,"Carlos M."=>950])'></canvas>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 justify-end pt-4 border-t border-gray-200 mt-4">
                <button @click="showPreviewModal = true" class="px-5 py-2.5 bg-[#0369a1] hover:bg-[#0284c7] text-white rounded-xl text-sm font-bold shadow-md shadow-blue-100 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Vista Previa
                </button>
                <a href="{{ route('admin.reportes.export.excel', request()->all()) }}" class="px-5 py-2.5 bg-[#107c41] hover:bg-[#0c5e31] text-white rounded-xl text-sm font-bold shadow-md shadow-green-100 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Exportar Excel
                </a>
                <a href="{{ route('admin.reportes.export.pdf', request()->all()) }}" class="px-5 py-2.5 bg-[#b91c1c] hover:bg-[#991b1b] text-white rounded-xl text-sm font-bold shadow-md shadow-red-100 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Exportar PDF
                </a>
            </div>

            @include('admin.reportes.partials.modal-preview')

        </div>

    </main>
    
    @vite(['resources/js/admin/reportes.js'])

</body>
</html>