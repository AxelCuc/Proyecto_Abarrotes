@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Agregar Producto</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Precio -->
        <div class="mb-4">
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Cantidad -->
        <div class="mb-4">
            <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Imagen -->
        <div class="mb-4">
            <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del producto</label>
            <input type="file" name="imagen" id="imagen" accept="image/*"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Botón de guardar -->
        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Guardar Producto
            </button>
        </div>
    </form>
</div>
@endsection
