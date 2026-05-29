<div id="modal-crear" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50 shrink-0">
            <h3 class="text-lg font-bold text-gray-800">Nuevo Producto</h3>
            <button type="button" id="btn-cerrar-crear" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form id="form-crear" action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto p-6 space-y-4 custom-scrollbar">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" required class="w-full border-gray-200 rounded-xl focus:border-[#0f763e] focus:ring-[#0f763e] shadow-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Precio ($)</label>
                    <input type="number" step="0.01" min="0" name="precio" required class="w-full border-gray-200 rounded-xl focus:border-[#0f763e] focus:ring-[#0f763e] shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Stock</label>
                    <input type="number" min="0" name="stock" required class="w-full border-gray-200 rounded-xl focus:border-[#0f763e] focus:ring-[#0f763e] shadow-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Categoría</label>
                <select name="categoria_id" required class="w-full border-gray-200 rounded-xl focus:border-[#0f763e] focus:ring-[#0f763e] shadow-sm">
                    <option value="">Seleccione...</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Imagen</label>
                <input type="file" name="imagen" id="crear-imagen" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#0f763e] file:text-white hover:file:bg-green-700">
                <img id="crear-img-preview" class="mt-2 h-32 object-contain hidden border rounded-xl" src="">
            </div>
            <div class="pt-4 flex justify-end gap-3 mt-auto shrink-0">
                <button type="button" id="btn-cancelar-crear" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-xl font-bold transition-colors">Cancelar</button>
                <button type="submit" class="bg-[#0f763e] hover:bg-green-700 text-white px-5 py-2 rounded-xl font-bold transition-colors">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>