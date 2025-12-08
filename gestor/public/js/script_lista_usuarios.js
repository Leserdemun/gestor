const modalEditar = document.getElementById('modalEditar')
modalEditar.addEventListener('show.bs.modal', event => {

    const button = event.relatedTarget

    const id = button.getAttribute('data-id')
    const nombre = button.getAttribute('data-nombre')
    const usuario = button.getAttribute('data-usuario')
    const rol = button.getAttribute('data-rol')
    const estado = button.getAttribute('data-estado')


    document.getElementById('edit_id').value = id
    document.getElementById('edit_nombre').value = nombre
    document.getElementById('edit_usuario').value = usuario
    document.getElementById('edit_rol').value = rol
    document.getElementById('edit_estado').value = estado
})