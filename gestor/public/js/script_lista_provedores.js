
const modalEditar = document.getElementById('modalEditar');
if (modalEditar) {
    modalEditar.addEventListener('show.bs.modal', event => {

        const button = event.relatedTarget;


        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');
        const telefono = button.getAttribute('data-telefono');
        const correo = button.getAttribute('data-correo');
        const direccion = button.getAttribute('data-direccion');


        modalEditar.querySelector('#edit_id').value = id;
        modalEditar.querySelector('#edit_nombre').value = nombre;
        modalEditar.querySelector('#edit_telefono').value = telefono;
        modalEditar.querySelector('#edit_correo').value = correo;
        modalEditar.querySelector('#edit_direccion').value = direccion;
    });
}