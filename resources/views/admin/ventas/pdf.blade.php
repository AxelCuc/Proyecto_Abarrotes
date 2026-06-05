<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
        .subtotal { text-align: right; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas</h2>

    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Cajero</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>#V-{{ $venta->id }}</td>
                <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $venta->usuario->nombre ?? 'N/A' }}</td>
                <td>${{ number_format($venta->total,2) }}</td>
            </tr>
            <tr>
                <td colspan="4">
                    <strong>Productos vendidos:</strong>
                    <table style="width:100%; margin-top:5px;">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre ?? 'Producto' }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>${{ number_format($detalle->precio_unitario,2) }}</td>
                                <td class="subtotal">${{ number_format($detalle->subtotal,2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
