import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    // Helper para leer datos desde data-values
    const getData = (id) => {
        const el = document.getElementById(id);
        return el ? JSON.parse(el.dataset.values) : {};
    };

    const dataVentasDia = getData('chartVentasDia');
    const dataIngresos = getData('chartIngresosAcumulados');
    const dataTopProd = getData('chartTopProductos');
    const dataCategorias = getData('chartCategorias');
    const dataCajeros = getData('chartVentasCajero');

    // Configuración general
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748b';
    Chart.defaults.scale.grid.color = '#f1f5f9';

    // 1. Ventas por Día
    new Chart(document.getElementById('chartVentasDia'), {
        type: 'bar',
        data: {
            labels: Object.keys(dataVentasDia),
            datasets: [{
                label: 'Ventas',
                data: Object.values(dataVentasDia),
                backgroundColor: '#0f763e',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 2. Ingresos Acumulados
    new Chart(document.getElementById('chartIngresosAcumulados'), {
        type: 'line',
        data: {
            labels: Object.keys(dataIngresos),
            datasets: [{
                label: 'Ingresos ($)',
                data: Object.values(dataIngresos),
                borderColor: '#ea580c',
                backgroundColor: 'rgba(234, 88, 12, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // 3. Top Productos
    new Chart(document.getElementById('chartTopProductos'), {
        type: 'bar',
        data: {
            labels: Object.keys(dataTopProd),
            datasets: [{
                label: 'Unidades Vendidas',
                data: Object.values(dataTopProd),
                backgroundColor: '#10b981',
                borderRadius: 4,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 4. Categorías
    new Chart(document.getElementById('chartCategorias'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(dataCategorias),
            datasets: [{
                data: Object.values(dataCategorias),
                backgroundColor: ['#0f763e', '#b45309', '#0369a1', '#94a3b8'],
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { usePointStyle: true, boxWidth: 8 } }
            }
        }
    });

    // 5. Rendimiento por Cajero
    new Chart(document.getElementById('chartVentasCajero'), {
        type: 'bar',
        data: {
            labels: Object.keys(dataCajeros),
            datasets: [{
                label: 'Tickets Atendidos',
                data: Object.values(dataCajeros),
                backgroundColor: '#6366f1',
                borderRadius: 4,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
});
