export default function usuariosHandler() {
    return {
        // Estados de los modales
        openCreateModal: false,
        openEditModal: false,
        openDeleteModal: false,

        // Datos del usuario seleccionado
        selectedUser: {},
        selectedUserId: null,

        // Abrir modal de edición con datos cargados
        editUser(id, nombre, email, rol) {
            this.selectedUser = { id, nombre, email, rol };
            this.openEditModal = true;
        },

        // Abrir modal de eliminación con ID del usuario
        deleteUser(id) {
            this.selectedUserId = id;
            this.openDeleteModal = true;
        }
    }
}

// Registro global para que AlpineJS lo reconozca
window.usuariosHandler = usuariosHandler;
