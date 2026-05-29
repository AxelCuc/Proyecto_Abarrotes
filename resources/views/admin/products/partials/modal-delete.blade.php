<div id="modal-eliminar" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden backdrop-blur-sm transition-opacity p-4 font-sans text-gray-800">
    <div class="bg-white rounded-[1.5rem] w-full max-w-sm shadow-2xl overflow-hidden">
        <div class="p-8 text-center">
            
            <div class="w-16 h-16 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L1 21h22L12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"></path>
                </svg>
            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight">
                ¿Seguro que deseas eliminar este producto?
            </h3>
            <p class="text-sm text-gray-500 mb-8">
                Estás a punto de eliminar <strong id="elim-nombre" class="text-gray-800 font-bold"></strong>.<br>
                Esta acción no se puede deshacer.
            </p>
            
            <form id="form-eliminar" data-base-url="{{ route('admin.productos.destroy', '__ID__') }}" method="POST" class="flex gap-3">
                @csrf
                @method('DELETE')
                
                <button type="button" id="btn-cerrar-elim" class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 py-2.5 rounded-[1rem] text-sm font-bold transition-colors">
                    Cancelar
                </button>
                
                <button type="submit" class="flex-1 bg-[#b91c1c] hover:bg-[#991b1b] text-white py-2.5 rounded-[1rem] text-sm font-bold shadow-sm transition-colors">
                    Eliminar
                </button>
            </form>

        </div>
    </div>
</div>