<div id="modal-editar" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden backdrop-blur-sm transition-opacity font-sans text-gray-800 p-4">
    <div class="bg-white rounded-[1.5rem] w-full max-w-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-start shrink-0">
            <div>
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Editar Producto
                </h3>
                <p class="text-sm text-gray-500 mt-1">Actualiza los detalles del artículo en el inventario.</p>
            </div>
            <button type="button" id="btn-cerrar-editar" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors p-1.5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form id="form-editar" data-base-url="{{ route('admin.productos.update', '__ID__') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto custom-scrollbar flex flex-col h-full">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-id" name="id">

            <div class="p-6 flex flex-col md:flex-row gap-8">
                
                <div class="w-full md:w-1/3 flex flex-col gap-3">
                    <label class="block text-sm font-bold text-gray-700">Imagen del Producto</label>
                    
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 flex flex-col items-center justify-center bg-gray-50 relative group overflow-hidden h-56 transition-colors hover:border-[#0f763e]/40">
                        
                        <img id="edit-img-preview" class="absolute inset-0 w-full h-full object-contain p-2 hidden bg-white z-10" src="" alt="Preview">
                        
                        <div class="text-center flex flex-col items-center z-0" id="edit-img-placeholder">
                            <svg class="w-8 h-8 text-gray-400 mb-2 group-hover:text-[#0f763e] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs text-gray-500 font-medium">Sin imagen</span>
                        </div>

                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-20" onclick="document.getElementById('edit-imagen').click()">
                            <span class="text-white text-xs font-bold px-3 py-1.5 border border-white/50 bg-black/30 rounded-lg backdrop-blur-sm">Cambiar Imagen</span>
                        </div>
                    </div>
                    
                    <input type="file" name="imagen" id="edit-imagen" accept="image/*" class="hidden">
                    <p class="text-[11px] text-gray-400 text-center font-medium px-2">Dejar vacío para mantener la imagen actual.</p>
                </div>

                <div class="w-full md:w-2/3 space-y-5">
                    
                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-gray-700">Nombre del Producto <span class="text-red-500">*</span></label>
                        <input type="text" id="edit-nombre" name="nombre" required 
                               class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-gray-700">Categoría <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="edit-categoria" name="categoria_id" required 
                                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all appearance-none cursor-pointer">
                                <option value="">Seleccione una categoría</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-gray-700">Precio de Venta <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 font-bold">$</span>
                                <input type="number" id="edit-precio" step="0.01" name="precio" required 
                                       class="w-full pl-7 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all">
                            </div>
                        </div>
                        
                        <div class="space-y-1.5">
                            <label class="flex justify-between items-center text-sm font-bold text-gray-700">
                                <span>Stock Actual <span class="text-red-500">*</span></span>
                                <span class="text-[10px] font-bold text-green-600 flex items-center gap-1 uppercase tracking-wider">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Nivel Válido
                                </span>
                            </label>
                            <input type="number" id="edit-stock" name="stock" required 
                                   class="w-full px-4 py-2.5 bg-green-50/30 border-2 border-green-100 rounded-xl text-sm focus:outline-none focus:border-[#0f763e] focus:ring-1 focus:ring-[#0f763e] transition-all font-semibold text-gray-800">
                        </div>
                    </div>

                </div>
            </div>

            <div class="p-6 pt-4 border-t border-gray-100 bg-gray-50/50 flex items-center justify-end gap-3 mt-auto shrink-0">
                <button type="button" onclick="document.getElementById('modal-editar').classList.add('hidden')" class="px-6 py-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-700 text-sm font-bold rounded-xl transition-colors">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2.5 bg-[#f97316] hover:bg-[#ea580c] text-white text-sm font-bold rounded-xl shadow-sm transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Actualizar Cambios
                </button>
            </div>
        </form>
    </div>
</div>