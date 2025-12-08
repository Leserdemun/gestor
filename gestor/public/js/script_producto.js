function cargarEditar(data) {
    document.getElementById('edit_id').value = data.id_producto;
    document.getElementById('edit_nombre').value = data.nombre;
    document.getElementById('edit_categoria').value = data.categoria;
    document.getElementById('edit_compra').value = data.precio_compra;
    document.getElementById('edit_venta').value = data.precio_venta;
    document.getElementById('edit_unidad').value = data.unidad_medida;
    document.getElementById('edit_proveedor').value = data.id_proveedor;
    document.getElementById('edit_desc').value = data.descripcion;
}