/**
 * cajero/inventario.js
 *
 * Lógica del inventario (solo lectura) — Vista: cajero/inventario/index.blade.php
 *
 * Responsabilidades:
 *  - Filtrar las filas de la tabla en tiempo real según el texto ingresado
 *    en el buscador (#input-buscador).
 *  - Filtrar las filas por categoría al hacer clic en los botones .btn-filtro.
 *  - Gestionar el estilo activo/inactivo de los botones de categoría.
 */
document.addEventListener('DOMContentLoaded', () => {
    const buscador      = document.getElementById('input-buscador');
    const filas         = document.querySelectorAll('.fila-producto');
    const botonesFiltro = document.querySelectorAll('.btn-filtro');

    let categoriaActual = 'Todos';

    const filtrarTabla = () => {
        const texto = buscador.value.toLowerCase().trim();

        filas.forEach(fila => {
            const nombre    = fila.querySelector('.nombre-prod').textContent.toLowerCase();
            const categoria = fila.querySelector('.cat-prod').textContent.trim();

            const coincideTexto     = nombre.includes(texto) || categoria.toLowerCase().includes(texto);
            const coincideCategoria = categoriaActual === 'Todos' || categoria === categoriaActual;

            fila.style.display = (coincideTexto && coincideCategoria) ? '' : 'none';
        });
    };

    buscador.addEventListener('input', filtrarTabla);

    botonesFiltro.forEach(boton => {
        boton.addEventListener('click', () => {
            // Resetear estilos de todos los botones
            botonesFiltro.forEach(b => {
                b.classList.remove('bg-[#0f763e]', 'text-white', 'shadow-md', 'shadow-green-100');
                b.classList.add('bg-white', 'text-gray-500', 'border-gray-200');
            });

            // Activar el botón seleccionado
            boton.classList.add('bg-[#0f763e]', 'text-white', 'shadow-md', 'shadow-green-100');
            boton.classList.remove('bg-white', 'text-gray-500', 'border-gray-200');

            categoriaActual = boton.getAttribute('data-cat');
            filtrarTabla();
        });
    });
});
