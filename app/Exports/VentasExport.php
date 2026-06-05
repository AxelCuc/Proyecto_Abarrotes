<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentasExport implements FromCollection, WithHeadings
{
    /**
     * Retorna la colección de ventas para exportar
     */
    public function collection()
    {
        return Venta::with('usuario')
            ->get()
            ->map(function($venta) {
                return [
                    'ID' => $venta->id,
                    'Fecha' => $venta->created_at->format('d/m/Y H:i'),
                    'Cajero' => $venta->usuario->nombre ?? 'N/A',
                    'Total' => $venta->total,
                ];
            });
    }

    /**
     * Encabezados de las columnas
     */
    public function headings(): array
    {
        return ['ID Venta', 'Fecha', 'Cajero', 'Total'];
    }
}
