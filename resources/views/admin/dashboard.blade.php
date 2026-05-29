<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Abarrotes Central</title>
    @vite(['resources/css/app.css', 'resources/js/admin/dashboard.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>

<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800">

    {{-- ══════════════════ SIDEBAR ══════════════════ --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-full shrink-0 z-20">
        <div class="p-6 border-b border-gray-50">
            <h1 class="text-xl font-bold text-[#0f763e] leading-tight">Abarrotes Central</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-1.5 custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-[#0f763e] text-white rounded-xl font-medium transition-colors shadow-md shadow-green-100">
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
            <a href="{{ route('admin.reportes.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Reportes
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#0f763e] rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Usuarios &amp; Roles
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

    {{-- ══════════════════ CONTENIDO PRINCIPAL ══════════════════ --}}
    <main class="flex-1 flex flex-col h-full overflow-hidden">

        {{-- Topbar --}}
        <header class="bg-[#f8fafc] h-[72px] px-8 flex justify-between items-center shrink-0">
            <h2 class="text-2xl font-black text-gray-800 tracking-tight">Panel de Control Administrador</h2>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre ?? 'Administrador' }}</p>
                        <p class="text-xs text-gray-500 italic">Store Manager</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0f763e] flex items-center justify-center text-white font-bold uppercase shadow-md border-2 border-white">
                        {{ substr(Auth::user()->nombre ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 pt-2">

            {{-- ── Tarjetas KPI ──────────────────────────────────────────── --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                {{-- Ventas del día --}}
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-gray-100">
                    <div class="w-10 h-10 bg-green-50 text-[#0f763e] rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Ventas de Hoy</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-gray-800">
                            ${{ number_format($ventasHoy, 2) }}
                        </span>
                        <span class="text-xs font-bold text-gray-400">
                            {{ $transaccionesHoy }} {{ Str::plural('ticket', $transaccionesHoy) }}
                        </span>
                    </div>
                </div>

                {{-- Ingresos del mes --}}
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-gray-100">
                    <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Ingresos del Mes</p>
                    <span class="text-3xl font-black text-gray-800">
                        ${{ number_format($ingresosMes, 2) }}
                    </span>
                    <p class="text-xs font-bold mt-2 {{ $porcentajeIngresos >= 0 ? 'text-green-500' : 'text-red-500' }}">
                        {{ $porcentajeIngresos >= 0 ? '+' : '' }}{{ number_format($porcentajeIngresos, 1) }}% VS MES ANTERIOR
                    </p>
                </div>

                {{-- Alertas de inventario --}}
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-red-100">
                    <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Alertas Sistema</p>
                    <span class="text-3xl font-black {{ $productosCriticos->count() > 0 ? 'text-red-600' : 'text-gray-400' }}">
                        {{ $productosCriticos->count() }}
                        {{ $productosCriticos->count() === 1 ? 'crítica' : 'críticas' }}
                    </span>
                </div>
            </div>

            {{-- ── Gráficas ───────────────────────────────────────────────── --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                {{-- Gráfica de línea: Rendimiento Semanal / Personalizado --}}
                <div class="bg-white rounded-[1.5rem] shadow-sm border border-gray-100 p-6 flex flex-col">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-800 tracking-tight">Rendimiento en Ventas</h3>
                        <div class="flex flex-col lg:flex-row items-center gap-3">
                            <select id="rangoVentas" class="text-sm border-gray-200 rounded-lg text-gray-600 focus:ring-[#0f763e] focus:border-[#0f763e] cursor-pointer outline-none">
                                <option value="semana">Últimos 7 días</option>
                                <option value="mes">Este mes</option>
                                <option value="trimestre">Este trimestre</option>
                                <option value="personalizado">Personalizado</option>
                            </select>
                            <div id="fechasPersonalizadas" class="hidden items-center gap-2">
                                <input type="date" id="fechaInicio" class="text-sm border-gray-200 rounded-lg text-gray-600 focus:ring-[#0f763e] focus:border-[#0f763e] outline-none">
                                <span class="text-gray-400">-</span>
                                <input type="date" id="fechaFin" class="text-sm border-gray-200 rounded-lg text-gray-600 focus:ring-[#0f763e] focus:border-[#0f763e] outline-none">
                                <button id="btnFiltrarFechas" class="bg-[#0f763e] text-white px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-[#0c5d31] transition-colors shadow-sm">Filtrar</button>
                            </div>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="chartVentas"></canvas>
                    </div>
                </div>

                {{-- Gráfica de donut: Productos más vendidos --}}
                <div class="bg-white rounded-[1.5rem] shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 tracking-tight">Productos más Vendidos</h3>
                    <div class="flex items-center h-64">
                        <div class="w-1/2 h-full relative">
                            <canvas id="chartProductos"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <span id="donutTotal" class="text-2xl font-black text-gray-800">—</span>
                                <span class="text-[10px] text-gray-500 uppercase font-bold">Total</span>
                            </div>
                        </div>
                        <div class="w-1/2 pl-8 space-y-3">
                            @php
                                $legendColors = ['#0f763e', '#f97316', '#0ea5e9', '#a855f7', '#e2e8f0'];
                            @endphp
                            @forelse ($productosMasVendidos as $i => $producto)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full shrink-0"
                                              style="background-color: {{ $legendColors[$i] ?? '#e2e8f0' }}"></span>
                                        <span class="text-sm font-medium text-gray-600 truncate max-w-[120px]"
                                              title="{{ $producto['nombre'] }}">
                                            {{ $producto['nombre'] }}
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-bold text-gray-800 block">{{ $producto['cantidad'] }} ventas</span>
                                        <span class="text-[10px] font-bold text-gray-400">{{ $producto['porcentaje'] }}% del total</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic">Sin datos de ventas aún.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Stock Crítico + Accesos rápidos ────────────────────────── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Stock crítico --}}
                <div class="col-span-1 bg-white rounded-[1.5rem] shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 tracking-tight">Stock Crítico</h3>
                    <div class="space-y-4 max-h-64 overflow-y-auto custom-scrollbar">
                        @forelse ($productosCriticos as $producto)
                            <div class="flex items-center gap-4 p-3 border border-gray-100 rounded-2xl hover:bg-gray-50 transition-colors">
                                <span class="text-2xl select-none">📦</span>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold truncate">{{ $producto->nombre }}</h4>
                                    <p class="text-xs font-bold {{ $producto->stock <= 3 ? 'text-red-500' : 'text-orange-500' }}">
                                        {{ $producto->stock }} {{ $producto->stock === 1 ? 'unidad' : 'unidades' }}
                                    </p>
                                </div>
                                @if ($producto->stock === 0)
                                    <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded-full shrink-0">
                                        AGOTADO
                                    </span>
                                @endif
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-8 text-center">
                                <span class="text-3xl mb-2">✅</span>
                                <p class="text-sm text-gray-500 font-medium">Todo el inventario está bien abastecido.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Accesos rápidos --}}
                <div class="col-span-2 grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.productos.index') }}" class="bg-white p-6 rounded-2xl border border-gray-100 flex flex-col items-center justify-center gap-3 hover:border-[#0f763e] transition-all group">
                        <div class="w-12 h-12 bg-green-50 text-[#0f763e] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <span class="font-bold text-gray-700">Inventario</span>
                    </a>
                    <a href="{{ route('admin.ventas.index') }}" class="bg-white p-6 rounded-2xl border border-gray-100 flex flex-col items-center justify-center gap-3 hover:border-orange-500 transition-all group">
                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="font-bold text-gray-700">Ventas</span>
                    </a>
                    <a href="{{ route('admin.reportes.index') }}" class="bg-white p-6 rounded-2xl border border-gray-100 flex flex-col items-center justify-center gap-3 hover:border-blue-500 transition-all group">
                        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <span class="font-bold text-gray-700">Reportes</span>
                    </a>
                    <a href="{{ route('admin.usuarios.index') }}" class="bg-white p-6 rounded-2xl border border-gray-100 flex flex-col items-center justify-center gap-3 hover:border-purple-500 transition-all group">
                        <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <span class="font-bold text-gray-700">Usuarios</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    {{-- ── Datos para Chart.js (inyectados antes del módulo JS) ────────── --}}
    <script>
        window.__dashboard = {
            ventasLabels:        @json($ventasPorDia->keys()),
            ventasData:          @json($ventasPorDia->values()),
            productosLabels:     @json($productosMasVendidos->pluck('nombre')),
            productosPorcentajes:@json($productosMasVendidos->pluck('porcentaje')),
        };
    </script>

</body>
</html>