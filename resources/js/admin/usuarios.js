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
            rol_id: null,
            updateUrl: '',
            deleteUrl: ''
        },

        // Abrir modal de edición con datos cargados
        editUser(id, nombre, email, rol_id) {
            this.selectedUser = { 
                id: id, 
                nombre: nombre, 
                email: email, 
                rol_id: rol_id, 
                updateUrl: `/admin/usuarios/${id}` 
            };
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
