<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas – Abarrotes Central</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #ffffff;
            padding: 32px 36px;
        }

        /* ── Encabezado ── */
        .header {
            border-bottom: 3px solid #0f763e;
            padding-bottom: 14px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #0f763e;
            letter-spacing: -0.5px;
        }
        .header .meta {
            font-size: 10px;
            color: #64748b;
            text-align: right;
            line-height: 1.6;
        }

        /* ── Sección ── */
        .section-title {
            font-size: 12px;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-left: 4px solid #0f763e;
            padding-left: 10px;
            margin-bottom: 12px;
            margin-top: 22px;
        }

        /* ── KPI Grid ── */
        .kpi-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }
        .kpi-grid td {
            width: 20%;
            padding: 12px 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .kpi-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #94a3b8;
            margin-bottom: 4px;
        }
        .kpi-value {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }
        .kpi-value.accent { color: #0f763e; }

        /* ── Tablas de datos ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
        }
        .data-table thead th {
            background: #0f763e;
            color: #ffffff;
            padding: 7px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table tbody tr:nth-child(even) td {
            background: #f8fafc;
        }
        .data-table tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #374151;
        }
        .data-table .num {
            text-align: right;
            font-weight: 600;
            color: #0f763e;
        }
        .data-table .rank {
            width: 30px;
            text-align: center;
            color: #94a3b8;
            font-size: 10px;
        }

        /* ── Columnas lado a lado ── */
        .two-col { width: 100%; border-collapse: collapse; }
        .two-col > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }
        .two-col > tbody > tr > td:first-child { padding-right: 10px; }
        .two-col > tbody > tr > td:last-child  { padding-left: 10px; }

        /* ── Footer ── */
        .footer {
            margin-top: 32px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
            font-size: 9px;
            color: #94a3b8;
            text-align: center;
        }

        /* ── Nota sin datos ── */
        .empty-note {
            padding: 12px;
            background: #f8fafc;
            border: 1px dashed #e2e8f0;
            border-radius: 6px;
            color: #94a3b8;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- ── Encabezado ── --}}
    <div class="header">
        <div>
            <h1>Abarrotes Central</h1>
            <div style="font-size:12px; color:#64748b; margin-top:2px;">Reporte de Ventas y Estadísticas</div>
        </div>
        <div class="meta">
            Generado: {{ now()->format('d/m/Y H:i') }}<br>
            Sistema POS v1.0
        </div>
    </div>

    {{-- ── KPIs ── --}}
    <div class="section-title">Indicadores Clave (KPIs)</div>
    <table class="kpi-grid">
        <tr>
            <td>
                <div class="kpi-label">Total Ventas</div>
                <div class="kpi-value">{{ number_format($totalVentas ?? 0) }}</div>
            </td>
            <td>
                <div class="kpi-label">Ingresos Acumulados</div>
                <div class="kpi-value accent">${{ number_format($totalIngresos ?? 0, 2) }}</div>
            </td>
            <td>
                <div class="kpi-label">Ticket Promedio</div>
                <div class="kpi-value">${{ number_format($ticketPromedio ?? 0, 2) }}</div>
            </td>
            <td>
                <div class="kpi-label">Producto Top</div>
                <div class="kpi-value" style="font-size:12px;">{{ $productoMasVendido ?? '—' }}</div>
            </td>
            <td>
                <div class="kpi-label">Top Cajero</div>
                <div class="kpi-value" style="font-size:12px;">{{ $cajeroTop ?? '—' }}</div>
            </td>
        </tr>
    </table>

    {{-- ── Ventas por Día / Ingresos por Día ── --}}
    <table class="two-col" style="margin-top:0;">
        <tr>
            <td>
                <div class="section-title">Ventas por Día</div>
                @if(empty($ventasPorDia))
                    <div class="empty-note">Sin datos en el período seleccionado.</div>
                @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th style="text-align:right;">Núm. Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventasPorDia as $dia => $total)
                            <tr>
                                <td>{{ $dia }}</td>
                                <td class="num">{{ $total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </td>
            <td>
                <div class="section-title">Ingresos por Día</div>
                @if(empty($ingresosPorDia))
                    <div class="empty-note">Sin datos en el período seleccionado.</div>
                @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th style="text-align:right;">Ingresos ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingresosPorDia as $dia => $ingresos)
                            <tr>
                                <td>{{ $dia }}</td>
                                <td class="num">${{ number_format($ingresos, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </td>
        </tr>
    </table>

    {{-- ── Top Productos / Categorías ── --}}
    <table class="two-col">
        <tr>
            <td>
                <div class="section-title">Top 5 Productos</div>
                @if(empty($topProductos))
                    <div class="empty-note">Sin datos de ventas.</div>
                @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="rank">#</th>
                                <th>Producto</th>
                                <th style="text-align:right;">Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProductos as $nombre => $count)
                            <tr>
                                <td class="rank">{{ $loop->iteration }}</td>
                                <td>{{ $nombre }}</td>
                                <td class="num">{{ $count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </td>
            <td>
                <div class="section-title">Distribución por Categoría</div>
                @if(empty($categoriasDistribucion))
                    <div class="empty-note">Sin categorías registradas.</div>
                @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th style="text-align:right;">Productos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoriasDistribucion as $nombre => $count)
                            <tr>
                                <td>{{ $nombre }}</td>
                                <td class="num">{{ $count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </td>
        </tr>
    </table>

    {{-- ── Rendimiento por Cajero ── --}}
    <div class="section-title">Rendimiento por Cajero</div>
    @if(empty($ventasPorCajero))
        <div class="empty-note">Sin cajeros con ventas registradas.</div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th class="rank">#</th>
                    <th>Cajero</th>
                    <th style="text-align:right;">Núm. Ventas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventasPorCajero as $nombre => $count)
                <tr>
                    <td class="rank">{{ $loop->iteration }}</td>
                    <td>{{ $nombre }}</td>
                    <td class="num">{{ $count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- ── Footer ── --}}
    <div class="footer">
        Abarrotes Central &bull; Sistema POS &bull; Documento generado automáticamente el {{ now()->format('d/m/Y \a \l\a\s H:i') }}
    </div>

</body>
</html>
