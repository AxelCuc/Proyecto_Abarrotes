{{-- Modal de Vista Previa de Exportación --}}
{{-- Requiere x-data="{ showPreviewModal: false }" en el elemento padre (ya definido en <body> de index.blade.php) --}}

<div x-show="showPreviewModal"
     x-cloak
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">

    <div @click.away="showPreviewModal = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="bg-white rounded-[2rem] w-full max-w-[780px] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">

        {{-- ── Header ── --}}
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-[#0369a1] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 leading-tight">Vista Previa de Exportación</h3>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">Revisa los parámetros antes de descargar</p>
                </div>
            </div>
            <button @click="showPreviewModal = false"
                    class="text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-full p-1.5 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- ── Body ── --}}
        <div class="p-8 overflow-y-auto custom-scrollbar flex-1 bg-gray-50 space-y-5">

            {{-- Filtros aplicados --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <h4 class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-3">
                    Parámetros del Reporte
                </h4>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex items-start gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Fecha Inicio</p>
                            <p class="text-sm font-semibold text-gray-800 mt-0.5">
                                {{ request('fecha_inicio') ?: 'Sin restricción' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Fecha Fin</p>
                            <p class="text-sm font-semibold text-gray-800 mt-0.5">
                                {{ request('fecha_fin') ?: 'Hoy' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Cajero</p>
                            <p class="text-sm font-semibold text-gray-800 mt-0.5">
                                @php
                                    $cajeroId = request('cajero_id');
                                    $cajeroNombre = $cajeroId
                                        ? ($cajeros->firstWhere('id', $cajeroId)?->nombre ?? 'Desconocido')
                                        : 'Todos';
                                @endphp
                                {{ $cajeroNombre }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Categoría</p>
                            <p class="text-sm font-semibold text-gray-800 mt-0.5">
                                @php
                                    $catId = request('categoria_id');
                                    $catNombre = $catId
                                        ? ($categorias->firstWhere('id', $catId)?->nombre ?? 'Desconocida')
                                        : 'Todas';
                                @endphp
                                {{ $catNombre }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KPIs calculados --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <h4 class="text-[11px] font-black text-gray-400 uppercase tracking-wider mb-3">
                    KPIs del Período
                </h4>
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-green-50 rounded-xl p-3 text-center">
                        <p class="text-[10px] font-bold text-green-700 uppercase tracking-wide">Total Ventas</p>
                        <p class="text-2xl font-black text-green-800 mt-1">{{ number_format($totalVentas ?? 0) }}</p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-3 text-center">
                        <p class="text-[10px] font-bold text-emerald-700 uppercase tracking-wide">Ingresos</p>
                        <p class="text-xl font-black text-emerald-800 mt-1">${{ number_format($totalIngresos ?? 0, 2) }}</p>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-3 text-center">
                        <p class="text-[10px] font-bold text-blue-700 uppercase tracking-wide">Ticket Prom.</p>
                        <p class="text-xl font-black text-blue-800 mt-1">${{ number_format($ticketPromedio ?? 0, 2) }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div class="flex items-center gap-3 bg-yellow-50 rounded-xl p-3">
                        <svg class="w-5 h-5 text-yellow-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        <div>
                            <p class="text-[10px] font-bold text-yellow-700 uppercase tracking-wide">Producto Top</p>
                            <p class="text-sm font-bold text-yellow-900 mt-0.5 truncate">{{ $productoMasVendido ?? '—' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-purple-50 rounded-xl p-3">
                        <svg class="w-5 h-5 text-purple-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <div>
                            <p class="text-[10px] font-bold text-purple-700 uppercase tracking-wide">Top Cajero</p>
                            <p class="text-sm font-bold text-purple-900 mt-0.5 truncate">{{ $cajeroTop ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Nota informativa --}}
            <p class="text-xs text-gray-400 text-center leading-relaxed">
                El documento incluirá tablas detalladas de ventas por día, ingresos, top productos,
                distribución por categorías y rendimiento por cajero.
            </p>
        </div>

        {{-- ── Footer con botones de acción ── --}}
        <div class="px-8 py-5 border-t border-gray-100 flex justify-end gap-3 bg-white shrink-0">
            <button @click="showPreviewModal = false"
                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-bold transition-colors">
                Cancelar
            </button>
            <a href="{{ route('admin.reportes.export.excel', request()->all()) }}"
               @click="showPreviewModal = false"
               class="px-5 py-2.5 bg-[#107c41] hover:bg-[#0c5e31] text-white rounded-xl text-sm font-bold shadow-md shadow-green-100 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exportar Excel
            </a>
            <a href="{{ route('admin.reportes.export.pdf', request()->all()) }}"
               @click="showPreviewModal = false"
               class="px-5 py-2.5 bg-[#b91c1c] hover:bg-[#991b1b] text-white rounded-xl text-sm font-bold shadow-md shadow-red-100 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Exportar PDF
            </a>
        </div>
    </div>
</div>
