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


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];
    $fecha = date('Y-m-d H:i:s');

    try {
        $sql = "INSERT INTO usuarios (nombre, usuario, password, rol, fecha_registro, estado) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $usuario, $password, $rol, $fecha, $estado]);


        redirigirConMensaje('Usuario creado exitosamente.', 'success');

    } catch (PDOException $e) {

        redirigirConMensaje('Error: ' . $e->getMessage(), 'danger');
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'editar') {
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];
    $pass_input = $_POST['password'];

    try {
        if (!empty($pass_input)) {
            $password = password_hash($pass_input, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nombre=?, usuario=?, password=?, rol=?, estado=? WHERE id_usuario=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre, $usuario, $password, $rol, $estado, $id]);
        } else {
            $sql = "UPDATE usuarios SET nombre=?, usuario=?, rol=?, estado=? WHERE id_usuario=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre, $usuario, $rol, $estado, $id]);
        }


        redirigirConMensaje('Usuario actualizado correctamente.', 'primary');

    } catch (PDOException $e) {
        redirigirConMensaje('Error al actualizar: ' . $e->getMessage(), 'danger');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $id = $_POST['id_usuario'];
    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmt->execute([$id]);


        redirigirConMensaje('Usuario eliminado.', 'warning');

    } catch (PDOException $e) {
        redirigirConMensaje('Error al eliminar: ' . $e->getMessage(), 'danger');
    }
}


$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id_usuario DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/listado_usuarios.css">


</head>

<body>
    <div class="container mt-5 mb-5">
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?= $_SESSION['mensaje']['tipo'] ?> shadow-sm border-0 alert-dismissible fade show"
                role="alert">
                <?= $_SESSION['mensaje']['texto'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Equipo de Trabajo</h3>
                    <p class="text-muted small mb-0">Gestiona los accesos y roles de la plataforma.</p>
                </div>
                <button type="button" class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="fas fa-plus me-2"></i>Nuevo Usuario
                </button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Usuario</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Fecha Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($usuarios) > 0): ?>
                            <?php foreach ($usuarios as $user): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar shadow-sm"><?= strtoupper(substr($user['nombre'], 0, 1)) ?></div>
                                            <div>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($user['nombre']) ?></div>
                                                <div class="small text-muted">@<?= htmlspecialchars($user['usuario']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge badge-soft <?= $user['rol'] == 'Administrador' ? 'bg-soft-purple' : 'bg-soft-primary' ?>">
                                            <i
                                                class="fas <?= $user['rol'] == 'Administrador' ? 'fa-crown' : 'fa-user' ?> me-1"></i>
                                            <?= $user['rol'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge badge-soft <?= $user['estado'] == 'Activo' ? 'bg-soft-success' : 'bg-soft-danger' ?>">
                                            <i
                                                class="fas <?= $user['estado'] == 'Activo' ? 'fa-check-circle' : 'fa-ban' ?> me-1"></i>
                                            <?= $user['estado'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center text-muted small"><i class="far fa-calendar-alt me-1"></i>
                                        <?= date('d M, Y', strtotime($user['fecha_registro'])) ?></td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="action-btn btn-edit me-2" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar" data-id="<?= $user['id_usuario'] ?>"
                                                data-nombre="<?= htmlspecialchars($user['nombre']) ?>"
                                                data-usuario="<?= htmlspecialchars($user['usuario']) ?>"
                                                data-rol="<?= $user['rol'] ?>" data-estado="<?= $user['estado'] ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form method="POST" action=""
                                                onsubmit="return confirm('¿Estás seguro de eliminar a este usuario?');">
                                                <input type="hidden" name="accion" value="eliminar">
                                                <input type="hidden" name="id_usuario" value="<?= $user['id_usuario'] ?>">
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
                                <td colspan="5" class="text-center py-5 text-muted">No hay usuarios registrados aún.</td>
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
                    <h5 class="modal-title fw-bold">Crear Nuevo Usuario</h5>
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
                                <label class="form-label small fw-bold text-uppercase text-muted">Usuario</label>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Rol</label>
                                <select name="rol" class="form-select" required>
                                    <option value="Empleado">Empleado</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Estado</label>
                                <select name="estado" class="form-select" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-gradient">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id_usuario" id="edit_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Nombre Completo</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Usuario</label>
                                <input type="text" name="usuario" id="edit_usuario" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Contraseña
                                    (Opcional)</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Dejar vacío para no cambiar">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Rol</label>
                                <select name="rol" id="edit_rol" class="form-select" required>
                                    <option value="Empleado">Empleado</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-uppercase text-muted">Estado</label>
                                <select name="estado" id="edit_estado" class="form-select" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
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

    <script src="../public/js/script_lista_usuarios.js"></script>
</body>

</html>