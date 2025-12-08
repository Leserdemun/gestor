<?php
require_once '../conexion/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    try {
        if ($_POST['accion'] === 'crear') {
            $sql = "INSERT INTO productos (nombre, categoria, descripcion, precio_compra, precio_venta, stock, unidad_medida, id_proveedor, fecha_registro) 
                    VALUES (:nom, :cat, :desc, :p_compra, :p_venta, :stock, :unidad, :id_prov, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nom' => $_POST['nombre'],
                ':cat' => $_POST['categoria'],
                ':desc' => $_POST['descripcion'],
                ':p_compra' => $_POST['precio_compra'],
                ':p_venta' => $_POST['precio_venta'],
                ':stock' => $_POST['stock'],
                ':unidad' => $_POST['unidad_medida'],
                ':id_prov' => $_POST['id_proveedor']
            ]);
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Producto creado correctamente.'];
        } elseif ($_POST['accion'] === 'editar') {
            $sql = "UPDATE productos SET nombre=:nom, categoria=:cat, descripcion=:desc, precio_compra=:p_compra, 
                    precio_venta=:p_venta, unidad_medida=:unidad, id_proveedor=:id_prov WHERE id_producto=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nom' => $_POST['nombre'],
                ':cat' => $_POST['categoria'],
                ':desc' => $_POST['descripcion'],
                ':p_compra' => $_POST['precio_compra'],
                ':p_venta' => $_POST['precio_venta'],
                ':unidad' => $_POST['unidad_medida'],
                ':id_prov' => $_POST['id_proveedor'],
                ':id' => $_POST['id_producto']
            ]);
            $_SESSION['mensaje'] = ['tipo' => 'primary', 'texto' => 'Producto actualizado.'];
        } elseif ($_POST['accion'] === 'eliminar') {
            $stmt = $pdo->prepare("DELETE FROM productos WHERE id_producto = :id");
            $stmt->execute([':id' => $_POST['id_producto']]);
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Producto eliminado.'];
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (Exception $e) {
        $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Error (Posiblemente el producto tiene movimientos asociados): ' . $e->getMessage()];
    }
}


$sql_prod = "SELECT p.*, prov.nombre as nombre_proveedor 
             FROM productos p 
             LEFT JOIN proveedores prov ON p.id_proveedor = prov.id_proveedor 
             ORDER BY p.id_producto DESC";
$productos = $pdo->query($sql_prod)->fetchAll();


$proveedores = $pdo->query("SELECT id_proveedor, nombre FROM proveedores ORDER BY nombre")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inventario de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/lista_productos.css">
</head>

<body>
    <div class="container mt-5 mb-5">
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?= $_SESSION['mensaje']['tipo'] ?> alert-dismissible fade show">
                <?= $_SESSION['mensaje']['texto'] ?><button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Catálogo de Productos</h3>
                <button class="btn btn-gradient px-4 py-2 rounded-3" data-bs-toggle="modal"
                    data-bs-target="#modalCrear">
                    <i class="fas fa-box-open me-2"></i>Nuevo Producto
                </button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="text-uppercase text-secondary small">
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precios (C/V)</th>
                            <th>Stock</th>
                            <th>Proveedor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $prod): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3"><?= strtoupper(substr($prod['nombre'], 0, 1)) ?></div>
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars($prod['nombre']) ?></div><small
                                                class="text-muted"><?= $prod['unidad_medida'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-light text-dark border"><?= htmlspecialchars($prod['categoria']) ?></span>
                                </td>
                                <td><small class="text-muted">$<?= $prod['precio_compra'] ?> / </small>
                                    <strong>$<?= $prod['precio_venta'] ?></strong>
                                </td>
                                <td>
                                    <span class="badge badge-soft-<?= $prod['stock'] < 5 ? 'warning' : 'success' ?> fs-6">
                                        <?= $prod['stock'] ?>
                                    </span>
                                </td>
                                <td class="small text-muted"><i
                                        class="fas fa-truck me-1"></i><?= htmlspecialchars($prod['nombre_proveedor'] ?? 'N/A') ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-light text-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar"
                                        onclick="cargarEditar(<?= htmlspecialchars(json_encode($prod)) ?>)"><i
                                            class="fas fa-pen"></i></button>
                                    <form method="POST" style="display:inline"
                                        onsubmit="return confirm('¿Eliminar producto?');">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="id_producto" value="<?= $prod['id_producto'] ?>">
                                        <button class="btn btn-sm btn-light text-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCrear" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Registrar Producto</h5><button class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <input type="hidden" name="accion" value="crear">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6"><label>Nombre</label><input type="text" name="nombre"
                                    class="form-control" required></div>
                            <div class="col-md-6"><label>Categoría</label><input type="text" name="categoria"
                                    class="form-control"></div>
                            <div class="col-md-4"><label>Precio Compra</label><input type="number" step="0.01"
                                    name="precio_compra" class="form-control" required></div>
                            <div class="col-md-4"><label>Precio Venta</label><input type="number" step="0.01"
                                    name="precio_venta" class="form-control" required></div>
                            <div class="col-md-4"><label>Stock Inicial</label><input type="number" name="stock"
                                    class="form-control" required></div>
                            <div class="col-md-6"><label>Unidad Medida</label><input type="text" name="unidad_medida"
                                    placeholder="pza, kg, lt..." class="form-control"></div>
                            <div class="col-md-6"><label>Proveedor</label>
                                <select name="id_proveedor" class="form-select">
                                    <option value="">Seleccione...</option>
                                    <?php foreach ($proveedores as $prov): ?>
                                        <option value="<?= $prov['id_proveedor'] ?>"><?= $prov['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12"><label>Descripción</label><textarea name="descripcion"
                                    class="form-control" rows="2"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer border-0"><button class="btn btn-gradient">Guardar</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Editar Producto</h5><button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id_producto" id="edit_id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6"><label>Nombre</label><input type="text" name="nombre" id="edit_nombre"
                                    class="form-control" required></div>
                            <div class="col-md-6"><label>Categoría</label><input type="text" name="categoria"
                                    id="edit_categoria" class="form-control"></div>
                            <div class="col-md-6"><label>Precio Compra</label><input type="number" step="0.01"
                                    name="precio_compra" id="edit_compra" class="form-control"></div>
                            <div class="col-md-6"><label>Precio Venta</label><input type="number" step="0.01"
                                    name="precio_venta" id="edit_venta" class="form-control"></div>
                            <div class="col-md-6"><label>Unidad</label><input type="text" name="unidad_medida"
                                    id="edit_unidad" class="form-control"></div>
                            <div class="col-md-6"><label>Proveedor</label>
                                <select name="id_proveedor" id="edit_proveedor" class="form-select">
                                    <?php foreach ($proveedores as $prov): ?>
                                        <option value="<?= $prov['id_proveedor'] ?>"><?= $prov['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12"><label>Descripción</label><textarea name="descripcion" id="edit_desc"
                                    class="form-control"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer border-0"><button class="btn btn-gradient">Actualizar</button></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/script_producto.js"></script>

</body>

</html>