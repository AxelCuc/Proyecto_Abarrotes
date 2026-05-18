<div x-show="showModal" 
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">

    <div x-show="showModal"
         x-data="{ metodo: 'efectivo', pagoCon: 0 }"
         @click.away="showModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden relative border border-gray-100">
        
        <div class="p-8 pb-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="bg-green-100 p-3 rounded-2xl text-[#0f763e]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-gray-900 leading-tight">Confirmar Venta</h3>
                    <p class="text-sm text-gray-400 font-medium">Revisa los montos antes de finalizar</p>
                </div>
            </div>
            <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="p-8 pt-4 space-y-8">
            
            <div class="bg-[#f8fafc] rounded-[2rem] p-8 text-center border border-gray-100 shadow-inner">
                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest mb-2">Total a cobrar</p>
                <p class="text-6xl font-black text-[#0f763e] tracking-tight">
                    $<span x-text="totalVenta.toFixed(2)"></span>
                </p>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 ml-1">Método de Pago</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="metodo_pago" value="efectivo" x-model="metodo" class="peer sr-only">
                        <div class="flex flex-col items-center gap-3 py-5 border-2 rounded-3xl transition-all duration-200 
                                    peer-checked:border-[#0f763e] peer-checked:bg-green-50 peer-checked:text-[#0f763e]
                                    border-gray-100 bg-white text-gray-400 group-hover:border-gray-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span class="font-black text-sm uppercase tracking-wider">Efectivo</span>
                        </div>
                    </label>
                    
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="metodo_pago" value="tarjeta" x-model="metodo" class="peer sr-only">
                        <div class="flex flex-col items-center gap-3 py-5 border-2 rounded-3xl transition-all duration-200 
                                    peer-checked:border-[#0f763e] peer-checked:bg-green-50 peer-checked:text-[#0f763e]
                                    border-gray-100 bg-white text-gray-400 group-hover:border-gray-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            <span class="font-black text-sm uppercase tracking-wider">Tarjeta</span>
                        </div>
                    </label>
                </div>
            </div>

            <div x-show="metodo === 'efectivo'" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="space-y-6">
                
                <div class="relative">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Monto Recibido</label>
                    <div class="relative group">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 font-black text-2xl group-focus-within:text-[#0f763e] transition-colors">$</span>
                        <input type="number" 
                               x-model.number="pagoCon"
                               step="0.01"
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-3xl py-5 pl-12 pr-6 text-3xl font-black text-gray-800 focus:ring-0 focus:border-[#0f763e] transition-all"
                               placeholder="0.00">
                    </div>
                </div>

                <div class="bg-orange-50 rounded-3xl p-6 border-2 border-orange-100 flex justify-between items-center shadow-sm"
                     x-show="pagoCon >= totalVenta">
                    <div>
                        <p class="text-orange-800 font-black text-xs uppercase tracking-widest">Cambio a entregar</p>
                        <p class="text-4xl font-black text-orange-600 tracking-tight">
                            $<span x-text="(pagoCon - totalVenta).toFixed(2)"></span>
                        </p>
                    </div>
                    <div class="bg-orange-200/50 p-3 rounded-2xl text-orange-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-0 flex gap-4">
            <button type="button" 
                    @click="showModal = false" 
                    class="flex-1 px-6 py-5 rounded-3xl font-black text-xs uppercase tracking-[0.2em] text-gray-400 hover:bg-gray-50 hover:text-gray-600 transition-all border-2 border-transparent">
                Cancelar
            </button>
            
            <button type="submit" 
                    :disabled="metodo === 'efectivo' && pagoCon < totalVenta"
                    class="flex-[2] px-6 py-5 bg-[#0f763e] text-white rounded-3xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-green-200 hover:bg-[#0c6132] active:scale-[0.98] transition-all disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed">
                Finalizar Venta
            </button>
        </div>
    </div>
</div>