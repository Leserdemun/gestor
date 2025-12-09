<?php
session_start();
header("Content-Type: application/json");

require "./conexion/conexion.php"; // tu archivo que crea $pdo

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

try {

    $stmt = $pdo->prepare("SELECT id_usuario, nombre, password, rol, estado 
                           FROM usuarios 
                           WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo json_encode(["ok" => false, "msg" => "Usuario no encontrado"]);
        exit;
    }

    if ($data['estado'] !== "Activo") {
        echo json_encode(["ok" => false, "msg" => "Usuario inactivo"]);
        exit;
    }

    if (!password_verify($password, $data['password'])) {
        echo json_encode(["ok" => false, "msg" => "Contraseña incorrecta"]);
        exit;
    }

    $_SESSION['id'] = $data['id_usuario'];
    $_SESSION['nombre'] = $data['nombre'];
    $_SESSION['rol'] = $data['rol'];
    $_SESSION['usuario'] = $usuario;

    echo json_encode(["ok" => true, "msg" => "Login correcto"]);

} catch (Exception $e) {
    echo json_encode(["ok" => false, "msg" => "Error interno: " . $e->getMessage()]);
}
