<?php
require_once '../conexion/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    if ($_POST['accion'] === 'crear') {
        try {

            $pdo->beginTransaction();


            $sql = "INSERT INTO movimientos (id_producto, id_usuario, tipo_movimiento, cantidad, observaciones, fecha_movimiento) 
                    VALUES (:prod, :user, :tipo, :cant, :obs, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':prod' => $_POST['id_producto'],
                ':user' => $_POST['id_usuario'],
                ':tipo' => $_POST['tipo_movimiento'],
                ':cant' => $_POST['cantidad'],
                ':obs' => $_POST['observaciones']
            ]);


            $operador = ($_POST['tipo_movimiento'] == 'Entrada') ? '+' : '-';
            $sqlUpdate = "UPDATE productos SET stock = stock $operador :cant WHERE id_producto = :id";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->execute([':cant' => $_POST['cantidad'], ':id' => $_POST['id_producto']]);


            $pdo->commit();
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Movimiento registrado y Stock actualizado.'];

        } catch (Exception $e) {
            $pdo->rollBack();
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Error: ' . $e->getMessage()];
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


$movimientos = $pdo->query("SELECT m.*, p.nombre as producto, u.nombre as usuario 
                            FROM movimientos m 
                            JOIN productos p ON m.id_producto = p.id_producto 
                            JOIN usuarios u ON m.id_usuario = u.id_usuario 
                            ORDER BY m.fecha_movimiento DESC")->fetchAll();

$productos = $pdo->query("SELECT id_producto, nombre, stock FROM productos ORDER BY nombre")->fetchAll();
$usuarios = $pdo->query("SELECT id_usuario, nombre FROM usuarios ORDER BY nombre")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Control de Movimientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/listado_movimientos.css">
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
                <div>
                    <h3 class="fw-bold mb-0">Ink / Movimientos</h3>
                    <p class="text-muted small">Historial de Entradas y Salidas</p>
                </div>
                <button class="btn btn-gradient px-4" data-bs-toggle="modal" data-bs-target="#modalMovimiento">
                    <i class="fas fa-exchange-alt me-2"></i>Registrar Movimiento
                </button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movimientos as $mov): ?>
                            <tr>
                                <td class="small text-muted"><?= date('d/m/Y H:i', strtotime($mov['fecha_movimiento'])) ?>
                                </td>
                                <td class="fw-bold"><?= htmlspecialchars($mov['producto']) ?></td>
                                <td>
                                    <span class="badge badge-<?= strtolower($mov['tipo_movimiento']) ?>">
                                        <i
                                            class="fas fa-<?= $mov['tipo_movimiento'] == 'Entrada' ? 'arrow-down' : 'arrow-up' ?> me-1"></i>
                                        <?= $mov['tipo_movimiento'] ?>
                                    </span>
                                </td>
                                <td class="fw-bold fs-5 text-center"><?= $mov['cantidad'] ?></td>
                                <td class="small"><i
                                        class="fas fa-user-circle me-1"></i><?= htmlspecialchars($mov['usuario']) ?></td>
                                <td class="text-muted small fst-italic"><?= htmlspecialchars($mov['observaciones']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMovimiento" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="fw-bold">Nuevo Movimiento</h5><button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <input type="hidden" name="accion" value="crear">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold small text-muted">TIPO DE MOVIMIENTO</label>
                            <div class="d-flex gap-3 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_movimiento" value="Entrada"
                                        id="t1" checked>
                                    <label class="form-check-label text-success fw-bold" for="t1"><i
                                            class="fas fa-arrow-down"></i> Entrada (Relleno)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_movimiento" value="Salida"
                                        id="t2">
                                    <label class="form-check-label text-danger fw-bold" for="t2"><i
                                            class="fas fa-arrow-up"></i> Salida (Venta)</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Producto</label>
                            <select name="id_producto" class="form-select" required>
                                <option value="">Seleccione producto...</option>
                                <?php foreach ($productos as $p): ?>
                                    <option value="<?= $p['id_producto'] ?>"><?= htmlspecialchars($p['nombre']) ?> (Stock
                                        actual: <?= $p['stock'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" min="1" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Usuario Responsable</label>
                                <select name="id_usuario" class="form-select" required>
                                    <?php foreach ($usuarios as $u): ?>
                                        <option value="<?= $u['id_usuario'] ?>"><?= htmlspecialchars($u['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control"
                                placeholder="Ej. Factura #123, Merma, etc..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-gradient w-100">Registrar y
                            Actualizar Stock</button></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>