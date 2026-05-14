@extends('layouts.app')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">Inventario</h1>

    <table class="w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Producto</th>
                <th class="border px-4 py-2">Cantidad</th>
                <th class="border px-4 py-2">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->nombre }}</td>
                    <td class="border px-4 py-2">{{ $product->cantidad }}</td>
                    <td class="border px-4 py-2">${{ number_format($product->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
