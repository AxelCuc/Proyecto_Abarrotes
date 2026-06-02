export default function usuariosHandler() {
    return {
        // Estados de los modales
        openCreateModal: false,
        openEditModal: false,
        openDeleteModal: false,

        // Datos del usuario seleccionado
        selectedUser: {
            id: null,
            nombre: '',
            email: '',
            rol: '',
            deleteUrl: ''
        },

        // Abrir modal de edición con datos cargados
        editUser(id, nombre, email, rol) {
            this.selectedUser = { id, nombre, email, rol };
            this.openEditModal = true;
        },

        // Abrir modal de eliminación con URL correcta
        deleteUser(id, nombre) {
            this.selectedUser = { 
                id: id, 
                nombre: nombre, 
                deleteUrl: `/admin/usuarios/${id}` 
            };
            this.openDeleteModal = true;
        }
    }
}

// Registro global para que AlpineJS lo reconozca
window.usuariosHandler = usuariosHandler;
