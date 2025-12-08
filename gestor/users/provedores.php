<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once '../conexion/conexion.php';


function redirigirConMensaje($msg, $tipo = 'success')
{
    $_SESSION['mensaje'] = [
        'texto' => $msg,
        'tipo' => $tipo
    ];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {

    $accion = $_POST['accion'];

    try {

        if ($accion === 'crear') {
            $sql = "INSERT INTO proveedores (nombre, telefono, correo, direccion, fecha_registro) 
                    VALUES (:nombre, :telefono, :correo, :direccion, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $_POST['nombre'],
                ':telefono' => $_POST['telefono'],
                ':correo' => $_POST['correo'],
                ':direccion' => $_POST['direccion']
            ]);

            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Proveedor registrado exitosamente.'];
        } elseif ($accion === 'editar') {
            $sql = "UPDATE proveedores 
                    SET nombre = :nombre, telefono = :telefono, correo = :correo, direccion = :direccion 
                    WHERE id_proveedor = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $_POST['nombre'],
                ':telefono' => $_POST['telefono'],
                ':correo' => $_POST['correo'],
                ':direccion' => $_POST['direccion'],
                ':id' => $_POST['id_proveedor']
            ]);

            $_SESSION['mensaje'] = ['tipo' => 'primary', 'texto' => 'Datos del proveedor actualizados.'];
        } elseif ($accion === 'eliminar') {
            $sql = "DELETE FROM proveedores WHERE id_proveedor = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $_POST['id_proveedor']]);

            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Proveedor eliminado correctamente.'];
        }

    } catch (Exception $e) {
        $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Error: ' . $e->getMessage()];
    }


    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


$sql_leer = "SELECT * FROM proveedores ORDER BY id_proveedor DESC";
$stmt_leer = $pdo->query($sql_leer);
$proveedores = $stmt_leer->fetchAll();


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/listado_provedores.css">


</head>

<body>
    <div class="container mt-5 mb-5">

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?= $_SESSION['mensaje']['tipo'] ?> shadow-sm border-0 alert-dismissible fade show mb-4"
                role="alert">
                <i class="fas fa-info-circle me-2"></i><?= $_SESSION['mensaje']['texto'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h3 class="fw-bold mb-1">Listado de Proveedores</h3>
                    <p class="text-muted small mb-0">Gestiona tus socios comerciales y contactos.</p>
                </div>
                <button type="button" class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="fas fa-plus me-2"></i>Nuevo Proveedor
                </button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Proveedor / Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th class="text-center">Fecha Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($proveedores) && count($proveedores) > 0): ?>
                            <?php foreach ($proveedores as $prov): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar shadow-sm"><?= strtoupper(substr($prov['nombre'], 0, 1)) ?></div>
                                            <div>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($prov['nombre']) ?></div>
                                                <div class="small text-muted"><i
                                                        class="far fa-envelope me-1"></i><?= htmlspecialchars($prov['correo']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-soft bg-soft-info">
                                            <i class="fas fa-phone-alt me-1"></i><?= htmlspecialchars($prov['telefono']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-muted small"
                                            style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                            <?= htmlspecialchars($prov['direccion'] ?? 'Sin dirección') ?>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted small">
                                        <?= date('d M, Y', strtotime($prov['fecha_registro'])) ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="action-btn btn-edit me-2" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar" data-id="<?= $prov['id_proveedor'] ?>"
                                                data-nombre="<?= htmlspecialchars($prov['nombre']) ?>"
                                                data-telefono="<?= htmlspecialchars($prov['telefono']) ?>"
                                                data-correo="<?= htmlspecialchars($prov['correo']) ?>"
                                                data-direccion="<?= htmlspecialchars($prov['direccion']) ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form method="POST" action=""
                                                onsubmit="return confirm('¿Confirma eliminar a este proveedor?');">
                                                <input type="hidden" name="accion" value="eliminar">
                                                <input type="hidden" name="id_proveedor" value="<?= $prov['id_proveedor'] ?>">
                                                <button type="submit" class="action-btn btn-del">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3 opacity-50"></i><br>
                                    No hay proveedores registrados.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCrear" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Registrar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="accion" value="crear">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Nombre Empresa /
                                Proveedor</label>
                            <input type="text" name="nombre" class="form-control" required
                                placeholder="Ej. Tech Solutions S.A.">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="+52 555...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Correo
                                    Electrónico</label>
                                <input type="email" name="correo" class="form-control"
                                    placeholder="contacto@empresa.com">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Dirección Física</label>
                            <textarea name="direccion" class="form-control" rows="2"
                                placeholder="Calle, Número, Colonia..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-gradient">Guardar Proveedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id_proveedor" id="edit_id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Nombre Empresa /
                                Proveedor</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Teléfono</label>
                                <input type="text" name="telefono" id="edit_telefono" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Correo
                                    Electrónico</label>
                                <input type="email" name="correo" id="edit_correo" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Dirección Física</label>
                            <textarea name="direccion" id="edit_direccion" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-gradient">Actualizar Datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/script_lista_provedores.js"></script>
</body>

</html>