<?php
require_once '../conexion/conexion.php';

$mensaje = '';

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
        $mensaje = '<div class="alert alert-success shadow-sm border-0">Usuario creado exitosamente.</div>';
    } catch (PDOException $e) {
        $mensaje = '<div class="alert alert-danger shadow-sm border-0">Error: ' . $e->getMessage() . '</div>';
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
        $mensaje = '<div class="alert alert-primary shadow-sm border-0">Usuario actualizado correctamente.</div>';
    } catch (PDOException $e) {
        $mensaje = '<div class="alert alert-danger shadow-sm border-0">Error al actualizar: ' . $e->getMessage() . '</div>';
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $id = $_POST['id_usuario'];
    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmt->execute([$id]);
        $mensaje = '<div class="alert alert-warning shadow-sm border-0">Usuario eliminado.</div>';
    } catch (PDOException $e) {
        $mensaje = '<div class="alert alert-danger shadow-sm border-0">Error al eliminar: ' . $e->getMessage() . '</div>';
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
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; color: #444; }
        .main-card { background: white; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: none; padding: 30px; }
        .table { border-collapse: separate; border-spacing: 0 10px; }
        .table thead th { border: none; background: transparent; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: #8898aa; font-weight: 600; padding-bottom: 15px; }
        .table tbody tr { background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.02); transition: transform 0.2s, box-shadow 0.2s; border-radius: 10px; }
        .table tbody tr:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.08); z-index: 2; position: relative; }
        .table td { border: none; padding: 15px 20px; vertical-align: middle; font-size: 0.95rem; }
        .table tbody td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .table tbody td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
        .avatar { width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 15px; font-size: 0.9rem; }
        .btn-gradient { background: linear-gradient(90deg, #4776E6 0%, #8E54E9 100%); border: none; color: white; padding: 10px 25px; border-radius: 50px; font-weight: 500; box-shadow: 0 4px 15px rgba(100, 100, 255, 0.3); transition: all 0.3s ease; }
        .btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(100, 100, 255, 0.4); color: white; }
        .action-btn { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s; border: 1px solid transparent; background: transparent; cursor: pointer;}
        .btn-edit { color: #4776E6; background: rgba(71, 118, 230, 0.1); }
        .btn-edit:hover { background: #4776E6; color: white; }
        .btn-del { color: #ff4b2b; background: rgba(255, 75, 43, 0.1); }
        .btn-del:hover { background: #ff4b2b; color: white; }
        .badge-soft { padding: 8px 12px; border-radius: 30px; font-weight: 500; font-size: 0.75rem; }
        .bg-soft-success { background-color: #d1fae5; color: #065f46; }
        .bg-soft-danger { background-color: #fee2e2; color: #991b1b; }
        .bg-soft-primary { background-color: #dbeafe; color: #1e40af; }
        .bg-soft-purple { background-color: #f3e8ff; color: #6b21a8; }
        .modal-content { border-radius: 20px; border: none; }
        .modal-header { border-bottom: 1px solid #f0f0f0; padding: 20px 30px; }
        .modal-body { padding: 30px; }
        .form-control, .form-select { background-color: #f9f9f9; border: 1px solid #eee; border-radius: 10px; padding: 10px 15px; }
        .form-control:focus, .form-select:focus { box-shadow: none; border-color: #4776E6; background-color: #fff; }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <?= $mensaje ?>

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
                                        <span class="badge badge-soft <?= $user['rol'] == 'Administrador' ? 'bg-soft-purple' : 'bg-soft-primary' ?>">
                                            <i class="fas <?= $user['rol'] == 'Administrador' ? 'fa-crown' : 'fa-user' ?> me-1"></i> <?= $user['rol'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-soft <?= $user['estado'] == 'Activo' ? 'bg-soft-success' : 'bg-soft-danger' ?>">
                                            <i class="fas <?= $user['estado'] == 'Activo' ? 'fa-check-circle' : 'fa-ban' ?> me-1"></i> <?= $user['estado'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center text-muted small"><i class="far fa-calendar-alt me-1"></i> <?= date('d M, Y', strtotime($user['fecha_registro'])) ?></td>
                                    
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="action-btn btn-edit me-2" data-bs-toggle="modal" data-bs-target="#modalEditar"
                                                data-id="<?= $user['id_usuario'] ?>"
                                                data-nombre="<?= htmlspecialchars($user['nombre']) ?>"
                                                data-usuario="<?= htmlspecialchars($user['usuario']) ?>"
                                                data-rol="<?= $user['rol'] ?>"
                                                data-estado="<?= $user['estado'] ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form method="POST" action="" onsubmit="return confirm('¿Estás seguro de eliminar a este usuario?');">
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
                            <tr><td colspan="5" class="text-center py-5 text-muted">No hay usuarios registrados aún.</td></tr>
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
                    <input type="hidden" name="id_usuario" id="edit_id"> <div class="modal-body">
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
                                <label class="form-label small fw-bold text-uppercase text-muted">Contraseña (Opcional)</label>
                                <input type="password" name="password" class="form-control" placeholder="Dejar vacío para no cambiar">
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
    
    <script>
        const modalEditar = document.getElementById('modalEditar')
        modalEditar.addEventListener('show.bs.modal', event => {
            // Botón que disparó el modal
            const button = event.relatedTarget
            
            // Extraer info de los atributos data-*
            const id = button.getAttribute('data-id')
            const nombre = button.getAttribute('data-nombre')
            const usuario = button.getAttribute('data-usuario')
            const rol = button.getAttribute('data-rol')
            const estado = button.getAttribute('data-estado')

            // Actualizar los inputs del modal
            document.getElementById('edit_id').value = id
            document.getElementById('edit_nombre').value = nombre
            document.getElementById('edit_usuario').value = usuario
            document.getElementById('edit_rol').value = rol
            document.getElementById('edit_estado').value = estado
        })
    </script>
</body>
</html>