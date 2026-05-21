<div x-show="showModal" 
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-cloak>

    <div x-show="showModal"
         @click.away="showModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden relative border border-gray-100">
        
        <div class="p-8 pb-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="bg-green-100 p-3 rounded-2xl text-[#0f763e]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-gray-900 leading-tight">Detalle de Venta</h3>
                    <p class="text-sm text-gray-400 font-medium" x-text="'ID Transacción: #V-' + ventaDetalle.id"></p>
                </div>
            </div>
            <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="p-8 pt-4 space-y-6">
            <div class="bg-[#f8fafc] rounded-[2rem] p-6 text-center border border-gray-100 shadow-inner">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1">Monto Total Cobrado</p>
                <p class="text-5xl font-black text-[#0f763e] tracking-tight">
                    $<span x-text="ventaDetalle.total"></span>
                </p>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 ml-1">Artículos</label>
                <div class="space-y-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                    <template x-for="item in ventaDetalle.productos" :key="item.nombre">
                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <div>
                                <p class="font-black text-gray-800 text-sm" x-text="item.nombre"></p>
                                <p class="text-xs text-gray-400 font-bold" x-text="item.cant + ' unidad(es)'"></p>
                            </div>
                            <p class="font-black text-gray-900" x-text="'$' + item.precio"></p>
                        </div>
                    </template>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 rounded-3xl bg-gray-50 border border-gray-100 text-center">
                    <p class="text-[9px] font-black text-gray-400 uppercase mb-1">Método Pago</p>
                    <p class="font-bold text-gray-800 text-sm capitalize" x-text="ventaDetalle.metodo"></p>
                </div>
                <div class="p-4 rounded-3xl bg-gray-50 border border-gray-100 text-center">
                    <p class="text-[9px] font-black text-gray-400 uppercase mb-1">Cajero</p>
                    <p class="font-bold text-gray-800 text-sm" x-text="ventaDetalle.cajero"></p>
                </div>
            </div>
        </div>

        <div class="p-8 pt-0 flex gap-4">
            <button type="button" @click="showModal = false" class="flex-1 px-6 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] text-gray-400 hover:bg-gray-50">
                Cerrar
            </button>
            <a :href="ventaDetalle.url_ticket" class="flex-[2] flex items-center justify-center gap-2 px-6 py-5 bg-[#0f763e] text-white rounded-3xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-green-100 hover:bg-[#0c6132]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Imprimir Ticket
            </a>
        </div>
    </div>
</div>