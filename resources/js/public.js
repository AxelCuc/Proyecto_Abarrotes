/**
 * public.js
 *
 * Lógica del catálogo público — Vista: public/index.blade.php
 *
 * Responsabilidades:
 *  - Filtrar tarjetas de producto en tiempo real según el texto del buscador.
 *  - Filtrar por categoría al hacer clic en los botones .btn-filtro.
 *  - Gestionar el estilo activo/inactivo de los botones de categoría.
 *
 * Cargado a través de app.js → @vite(['resources/css/app.css', 'resources/js/app.js'])
 */
document.addEventListener('DOMContentLoaded', () => {
    const buscador = document.getElementById('input-buscador');
    const tarjetas = document.querySelectorAll('.card-producto');
    const botonesFiltro = document.querySelectorAll('.btn-filtro');
    let categoriaActual = 'Todos';

    const aplicarFiltros = () => {
        const texto = buscador.value.toLowerCase().trim();

        tarjetas.forEach(card => {
            // Los atributos data-nombre y data-cat son renderizados por el Blade
            const nombre    = card.dataset.nombre || '';
            const categoria = card.dataset.cat    || '';

            const coincideTexto     = nombre.includes(texto) || categoria.toLowerCase().includes(texto);
            const coincideCategoria = categoriaActual === 'Todos' || categoria === categoriaActual;

            card.style.display = (coincideTexto && coincideCategoria) ? '' : 'none';
        });
    };

    buscador.addEventListener('input', aplicarFiltros);

    botonesFiltro.forEach(btn => {
        btn.addEventListener('click', () => {
            botonesFiltro.forEach(b => {
                b.classList.remove('bg-green-600', 'text-white', 'shadow-lg', 'shadow-green-100');
                b.classList.add('text-gray-500', 'hover:bg-gray-100');
            });
            btn.classList.add('bg-green-600', 'text-white', 'shadow-lg', 'shadow-green-100');
            btn.classList.remove('text-gray-500', 'hover:bg-gray-100');
            
            categoriaActual = btn.getAttribute('data-cat');
            aplicarFiltros();
        });
    });
});
