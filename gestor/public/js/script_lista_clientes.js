const modalEditar = document.getElementById('modalEditar');
if (modalEditar) {
    modalEditar.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;


        modalEditar.querySelector('#edit_id').value = button.getAttribute('data-id');
        modalEditar.querySelector('#edit_nombre').value = button.getAttribute('data-nombre');
        modalEditar.querySelector('#edit_telefono').value = button.getAttribute('data-telefono');
        modalEditar.querySelector('#edit_correo').value = button.getAttribute('data-correo');
        modalEditar.querySelector('#edit_direccion').value = button.getAttribute('data-direccion');
    });
}