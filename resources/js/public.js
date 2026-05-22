document.addEventListener('DOMContentLoaded', () => {
    const buscador = document.getElementById('input-buscador');
    const tarjetas = document.querySelectorAll('.card-producto');
    const botonesFiltro = document.querySelectorAll('.btn-filtro');
    let categoriaActual = 'Todos';

    const aplicarFiltros = () => {
        const query = buscador.value.toLowerCase().trim();

        tarjetas.forEach(card => {
            const nombre = card.querySelector('.text-nombre-prod').textContent.toLowerCase();
            const categoria = card.querySelector('.text-cat-prod').textContent.trim();

            const coincideTexto = nombre.includes(query) || categoria.toLowerCase().includes(query);
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
