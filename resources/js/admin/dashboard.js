/**
 * Admin Dashboard – Chart.js initialisation
 *
 * Los datos se inyectan desde la vista Blade en el objeto global
 * window.__dashboard antes de que se cargue este script.
 */
document.addEventListener('DOMContentLoaded', function () {
    const { ventasLabels, ventasData, productosLabels, productosPorcentajes } =
        window.__dashboard ?? {};

    const COLORS = ['#0f763e', '#f97316', '#0ea5e9', '#a855f7', '#e2e8f0'];

    // ── Gráfica de línea: Ventas semanales ────────────────────────────────
    const ctxVentas = document.getElementById('chartVentas');
    if (ctxVentas && ventasLabels && ventasData) {
        new Chart(ctxVentas.getContext('2d'), {
            type: 'line',
            data: {
                labels: ventasLabels,
                datasets: [{
                    data: ventasData,
                    borderColor: '#0f763e',
                    backgroundColor: 'rgba(15, 118, 62, 0.05)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#0f763e',
                    pointHoverRadius: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx =>
                                ' $' + ctx.parsed.y.toLocaleString('es-MX', {
                                    minimumFractionDigits: 2,
                                }),
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        border: { display: false },
                        ticks: {
                            callback: v =>
                                '$' + v.toLocaleString('es-MX', { maximumFractionDigits: 0 }),
                        },
                    },
                    x: {
                        grid: { display: false },
                        border: { display: false },
                    },
                },
            },
        });
    }

    // ── Gráfica de donut: Productos más vendidos ───────────────────────────
    const ctxProductos = document.getElementById('chartProductos');
    if (ctxProductos && productosLabels && productosPorcentajes) {
        new Chart(ctxProductos.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: productosLabels,
                datasets: [{
                    data: productosPorcentajes,
                    backgroundColor: COLORS.slice(0, productosLabels.length),
                    borderWidth: 0,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '80%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed}%`,
                        },
                    },
                },
            },
        });
    }

    // ── Total del donut (label central) ───────────────────────────────────
    const totalEl = document.getElementById('donutTotal');
    if (totalEl && productosPorcentajes) {
        const total = productosPorcentajes.reduce((s, v) => s + v, 0);
        totalEl.textContent = total > 0 ? total + '%' : '—';
    }
});
