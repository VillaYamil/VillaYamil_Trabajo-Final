<?php
$host = 'localhost'; // O la dirección de tu servidor
$dbname = 'tp_asistencias_v4';
$username = 'root';
$password = '';

try {
    // Crear una conexión PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si hay un error, muestra un mensaje y detén la ejecución
    echo "No se pudo establecer la conexión a la base de datos: " . $e->getMessage();
    exit;
}
?>