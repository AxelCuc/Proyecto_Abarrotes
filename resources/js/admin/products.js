/**
 * resources/js/admin/products.js
 * Lógica de modales y filtros del inventario de productos.
 */
document.addEventListener('DOMContentLoaded', () => {

    // ── Referencias a modales ──────────────────────────────────────────────
    const modalCrear   = document.getElementById('modal-crear');
    const modalEditar  = document.getElementById('modal-editar');
    const modalElim    = document.getElementById('modal-eliminar');

    // ── Helpers para abrir / cerrar modales ────────────────────────────────
    const openCreateModal = () => modalCrear?.classList.remove('hidden');
    const openEditModal   = () => modalEditar?.classList.remove('hidden');
    const openDeleteModal = () => modalElim?.classList.remove('hidden');

    const closeModal = (el) => {
        el?.classList.add('hidden');
        // Resetear formularios al cerrar modales
        const form = el?.querySelector('form');
        if (form) form.reset();
        const imgPreview = el?.querySelector('img');
        if (imgPreview) imgPreview.classList.add('hidden');
    };

    // Cerrar al hacer clic en el backdrop
    [modalCrear, modalEditar, modalElim].forEach(modal => {
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) closeModal(modal);
        });
    });

    // Cerrar con Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal(modalCrear);
            closeModal(modalEditar);
            closeModal(modalElim);
        }
    });

    // ── Botón Nuevo Producto ───────────────────────────────────────────────
    document.getElementById('btn-nuevo-producto')
        ?.addEventListener('click', () => {
            openCreateModal();
        });

    document.getElementById('btn-cerrar-crear')
        ?.addEventListener('click', () => closeModal(modalCrear));
    document.getElementById('btn-cancelar-crear')
        ?.addEventListener('click', () => closeModal(modalCrear));

    // ── Botones Editar ─────────────────────────────────────────────────────
    document.querySelectorAll('[data-action="editar"]').forEach(btn => {
        btn.addEventListener('click', () => {
            const d = btn.dataset;

            // Precargar datos en el modal de edición usando atributos data-*
            document.getElementById('edit-id').value            = d.id;
            document.getElementById('edit-nombre').value        = d.nombre;
            document.getElementById('edit-stock').value         = d.stock;
            document.getElementById('edit-precio').value        = d.precio;
            document.getElementById('edit-categoria').value     = d.categoria;

            // Actualizar action del form
            const form = document.getElementById('form-editar');
            form.action = form.dataset.baseUrl.replace('__ID__', d.id);

            // Preview imagen actual
            const imgPreview = document.getElementById('edit-img-preview');
            if (imgPreview) {
                imgPreview.src = d.imagen || '';
                imgPreview.classList.toggle('hidden', !d.imagen);
            }

            openEditModal();
        });
    });

    document.getElementById('btn-cerrar-editar')
        ?.addEventListener('click', () => closeModal(modalEditar));

    // ── Botones Eliminar ───────────────────────────────────────────────────
    document.querySelectorAll('[data-action="eliminar"]').forEach(btn => {
        btn.addEventListener('click', () => {
            const nombre = btn.dataset.nombre;
            document.getElementById('elim-nombre').textContent = nombre;

            const form = document.getElementById('form-eliminar');
            form.action = form.dataset.baseUrl.replace('__ID__', btn.dataset.id);

            openDeleteModal();
        });
    });

    // Confirmación en el modal de eliminación antes de enviar el formulario DELETE
    document.getElementById('form-eliminar')?.addEventListener('submit', (e) => {
        const confirmed = confirm("¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.");
        if (!confirmed) {
            e.preventDefault();
        }
    });

    document.getElementById('btn-cerrar-elim')
        ?.addEventListener('click', () => closeModal(modalElim));

    // ── Búsqueda en tiempo real (submit con debounce) ─────────────────────
    const searchInput = document.getElementById('input-buscar');
    let debounceTimer;
    searchInput?.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const url = new URL(window.location.href);
            const val = searchInput.value.trim();
            if (val) {
                url.searchParams.set('q', val);
            } else {
                url.searchParams.delete('q');
            }
            url.searchParams.delete('page');
            window.location.href = url.toString();
        }, 500);
    });

    // Preview de imagen en modal crear
    document.getElementById('crear-imagen')?.addEventListener('change', (e) => {
        const preview = document.getElementById('crear-img-preview');
        const file = e.target.files[0];
        if (file && preview) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });

    // Preview de imagen en modal editar
    document.getElementById('edit-imagen')?.addEventListener('change', (e) => {
        const preview = document.getElementById('edit-img-preview');
        const file = e.target.files[0];
        if (file && preview) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });

    // ── Sistema de Toasts (Notificaciones) ─────────────────────────────────
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        showToast(flashMessage.dataset.message, flashMessage.dataset.type);
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-[#0f763e]' : 'bg-red-600';
        toast.className = `fixed bottom-6 right-6 px-6 py-3 rounded-xl shadow-lg font-bold text-white transition-all duration-300 transform translate-y-10 opacity-0 z-[100] ${bgColor}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Trigger animation
        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
        });

        // Hide and remove
        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});
