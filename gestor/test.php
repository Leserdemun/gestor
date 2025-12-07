<?php
$servername = "localhost";   // Cambia si tu MySQL está en otra IP
$username   = "glam";        // Usuario de MySQL
$password   = "123456789";            // Contraseña de MySQL
$database   = "gestor";        // Opcional: base de datos a comprobar

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("❌
 Error de conexión: " . $conn->connect_error);
}

echo "✅
 Conexión exitosa a MySQL!";
?>