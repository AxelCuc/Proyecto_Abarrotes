@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Listado de Productos</h1>

    <!-- Botón para crear nuevo producto -->
    <div class="mb-4">
        <a href="{{ route('products.create') }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
           Agregar Producto
        </a>
    </div>

    <!-- Tabla de productos -->
    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">Precio</th>
                <th class="px-4 py-2 border">Cantidad</th>
                <th class="px-4 py-2 border">Imagen</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="px-4 py-2 border">{{ $product->id }}</td>
                    <td class="px-4 py-2 border">{{ $product->nombre }}</td>
                    <td class="px-4 py-2 border">${{ $product->precio }}</td>
                    <td class="px-4 py-2 border">{{ $product->cantidad }}</td>
                    <td class="px-4 py-2 border">
                        @if($product->imagen)
                            <img src="{{ asset('storage/' . $product->imagen) }}" 
                                 alt="{{ $product->nombre }}" class="h-16 w-16 object-cover">
                        @else
                            <span class="text-gray-500">Sin imagen</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('products.edit', $product) }}" 
                           class="px-2 py-1 bg-blue-600 text-white rounded">Editar</a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-2 py-1 bg-red-600 text-white rounded"
                                    onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                        No hay productos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
