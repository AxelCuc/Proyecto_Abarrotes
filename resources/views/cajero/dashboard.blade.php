<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cajero - Abarrotes Central</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden font-sans text-gray-800">

    {{-- SIDEBAR SEPARADO --}}
    @include('cajero.partials.sidebar')

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-[#f8fafc]">
        
        <header class="bg-white border-b border-gray-200 h-[72px] px-8 flex justify-between items-center shrink-0">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Panel de Control</h2>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->nombre }}</p>
                    <p class="text-xs text-gray-500">Cajero Activo</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-[#0f763e] font-black border border-gray-200">
                    {{ substr(Auth::user()->nombre, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 space-y-8">
            
            <div>
                <h3 class="text-2xl font-black text-gray-900">¡Hola, {{ Auth::user()->nombre }}!</h3>
                <p class="text-gray-500 font-medium text-sm mt-1">Aquí tienes el resumen operativo de tu turno el día de hoy.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Vendido Hoy</p>
                        <p class="text-3xl font-black text-[#0f763e]">${{ number_format($totalHoy, 2) }}</p>
                        
                        <p class="text-xs font-bold {{ $comparacion >= 0 ? 'text-green-600' : 'text-red-500' }} flex items-center gap-1">
                            @if($comparacion >= 0)
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                +{{ number_format($comparacion, 1) }}% vs ayer
                            @else
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
                                {{ number_format($comparacion, 1) }}% vs ayer
                            @endif
                        </p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-xl text-[#0f763e]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ventas Realizadas</p>
                        <p class="text-3xl font-black text-gray-800">{{ $ventasHoy }}</p>
                        <p class="text-xs text-gray-400 font-medium">Tickets generados hoy</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Productos Críticos</p>
                        <p class="text-3xl font-black text-red-600">{{ $productosBajos->count() }}</p>
                        <p class="text-xs text-gray-400 font-medium">Con un stock de 5 o menos</p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-xl text-red-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 lg:col-span-2 space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                        <h4 class="text-lg font-bold text-gray-900">Alertas de Inventario Bajo</h4>
                        <span class="bg-red-100 text-red-700 font-bold text-xs px-2.5 py-1 rounded-full">Atención Requerida</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead>
                                <tr class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                    <th class="pb-3">Producto</th>
                                    <th class="pb-3">Categoría</th>
                                    <th class="pb-3 text-right">Stock</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($productosBajos as $producto)
                                    <tr>
                                        <td class="py-3.5 font-bold text-gray-800">{{ $producto->nombre }}</td>
                                        <td class="py-3.5 text-gray-500">
                                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                        </td>
                                        <td class="py-3.5 text-right font-black text-red-500">{{ $producto->stock }} pzas.</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-gray-400 font-medium">
                                            🎉 ¡Excelente! No tienes productos con stock crítico actualmente.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between space-y-4">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 border-b border-gray-50 pb-4 mb-4">Accesos Rápidos</h4>
                        <div class="space-y-3">
                            <a href="{{ route('cajero.ventas.create') }}" class="flex items-center justify-between p-4 bg-green-50/50 hover:bg-green-50 border border-green-100 rounded-xl font-bold text-[#0f763e] transition-colors group">
                                <span class="text-sm">Registrar Venta</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            <a href="{{ route('cajero.inventario.index') }}" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 border border-gray-100 rounded-xl font-bold text-gray-700 transition-colors group">
                                <span class="text-sm">Inventario</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            <a href="{{ route('cajero.ventas.index') }}" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 border border-gray-100 rounded-xl font-bold text-gray-700 transition-colors group">
                                <span class="text-sm">Mis Ventas</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-50">
                        <div class="bg-gray-50 rounded-xl p-4 text-xs font-semibold text-gray-400 text-center">
                            Sistema Abarrotes Central &copy; {{ date('Y') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

</body>
</html>