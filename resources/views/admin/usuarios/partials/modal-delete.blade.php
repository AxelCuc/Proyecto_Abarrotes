<div id="modal-eliminar-usuario" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden backdrop-blur-sm transition-opacity p-4 font-sans text-gray-800">
    
    <div class="bg-white rounded-[2rem] w-full max-w-[400px] shadow-2xl overflow-hidden transform transition-all">
        <div class="p-8 text-center">
            
            <div class="w-16 h-16 bg-red-50 text-[#b91c1c] rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L1 21h22L12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"></path>
                </svg>
            </div>
            
            <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-tight">
                Confirmar Eliminación
            </h3>
            <p class="text-base text-gray-500 mb-8">
                ¿Seguro que deseas eliminar este usuario?<br>
                Esta acción no se puede deshacer.
            </p>
            
            <form id="form-eliminar-usuario" data-base-url="{{ route('admin.usuarios.destroy', '__ID__') }}" method="POST" class="flex gap-4 mt-2">
                @csrf
                @method('DELETE')
                
                <button type="button" id="btn-cerrar-elim-usuario" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-2xl text-sm font-bold transition-colors">
                    Cancelar
                </button>
                
                <button type="submit" class="flex-1 bg-[#b91c1c] hover:bg-[#991b1b] text-white py-3 rounded-2xl text-sm font-bold shadow-md shadow-red-100 transition-colors">
                    Eliminar
                </button>
            </form>

        </div>
    </div>
</div>