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
            $sql = "INSERT INTO clientes (nombre, telefono, correo, direccion, fecha_registro) 
                    VALUES (:nombre, :telefono, :correo, :direccion, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $_POST['nombre'],
                ':telefono' => $_POST['telefono'],
                ':correo' => $_POST['correo'],
                ':direccion' => $_POST['direccion']
            ]);

            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Cliente registrado exitosamente.'];
        } elseif ($accion === 'editar') {
            $sql = "UPDATE clientes 
                    SET nombre = :nombre, telefono = :telefono, correo = :correo, direccion = :direccion 
                    WHERE id_cliente = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $_POST['nombre'],
                ':telefono' => $_POST['telefono'],
                ':correo' => $_POST['correo'],
                ':direccion' => $_POST['direccion'],
                ':id' => $_POST['id_cliente']
            ]);

            $_SESSION['mensaje'] = ['tipo' => 'primary', 'texto' => 'Datos del cliente actualizados.'];
        } elseif ($accion === 'eliminar') {
            $sql = "DELETE FROM clientes WHERE id_cliente = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $_POST['id_cliente']]);

            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Cliente eliminado correctamente.'];
        }

    } catch (Exception $e) {
        $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Error: ' . $e->getMessage()];
    }


    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


$sql_leer = "SELECT * FROM clientes ORDER BY id_cliente DESC";
$stmt_leer = $pdo->query($sql_leer);
$clientes = $stmt_leer->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/listado_clientes.css">

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
                    <h3 class="fw-bold mb-1">Directorio de Clientes</h3>
                    <p class="text-muted small mb-0">Administra la información de tus compradores.</p>
                </div>
                <button type="button" class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="fas fa-plus me-2"></i>Nuevo Cliente
                </button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Cliente / Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th class="text-center">Registrado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($clientes) > 0): ?>
                            <?php foreach ($clientes as $cli): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar shadow-sm"><?= strtoupper(substr($cli['nombre'], 0, 1)) ?></div>
                                            <div>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($cli['nombre']) ?></div>
                                                <div class="small text-muted"><i
                                                        class="far fa-envelope me-1"></i><?= htmlspecialchars($cli['correo']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-soft bg-soft-primary">
                                            <i class="fas fa-mobile-alt me-1"></i><?= htmlspecialchars($cli['telefono']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-muted small"
                                            style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <i class="fas fa-map-pin me-1 text-danger"></i>
                                            <?= htmlspecialchars($cli['direccion'] ?? 'No especificada') ?>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted small">
                                        <?= date('d/m/Y', strtotime($cli['fecha_registro'])) ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="action-btn btn-edit me-2" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar" data-id="<?= $cli['id_cliente'] ?>"
                                                data-nombre="<?= htmlspecialchars($cli['nombre']) ?>"
                                                data-telefono="<?= htmlspecialchars($cli['telefono']) ?>"
                                                data-correo="<?= htmlspecialchars($cli['correo']) ?>"
                                                data-direccion="<?= htmlspecialchars($cli['direccion']) ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form method="POST" action=""
                                                onsubmit="return confirm('¿Seguro que deseas eliminar a este cliente?');">
                                                <input type="hidden" name="accion" value="eliminar">
                                                <input type="hidden" name="id_cliente" value="<?= $cli['id_cliente'] ?>">
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
                                <td colspan="5" class="text-center py-5 text-muted">No hay clientes registrados en el
                                    sistema.</td>
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
                    <h5 class="modal-title fw-bold">Registrar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="accion" value="crear">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Teléfono</label>
                                <input type="text" name="telefono" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Correo</label>
                                <input type="email" name="correo" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Dirección</label>
                            <textarea name="direccion" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-gradient">Guardar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id_cliente" id="edit_id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Nombre Completo</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Teléfono</label>
                                <input type="text" name="telefono" id="edit_telefono" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Correo</label>
                                <input type="email" name="correo" id="edit_correo" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Dirección</label>
                            <textarea name="direccion" id="edit_direccion" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-gradient">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/script_lista_clientes.js"></script>

</body>

</html>