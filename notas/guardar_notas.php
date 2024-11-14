<?php
// Conectar a la base de datos
require_once '../conexion.php';

$message = ""; // Variable para almacenar el mensaje de éxito o error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumno_id = $_POST['alumno_id'];
    $materia_id = $_POST['materia_id'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];

    // Verificar si ya existen notas para ese alumno en la materia seleccionada
    $queryCheck = "SELECT * FROM notas WHERE alumno_id = ? AND materia_id = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->execute([$alumno_id, $materia_id]);
    $existingNotes = $stmtCheck->fetch();

    if ($existingNotes) {
        // Si ya existen notas, actualizamos
        $queryUpdate = "UPDATE notas SET nota1 = ?, nota2 = ?, nota3 = ? WHERE alumno_id = ? AND materia_id = ?";
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->execute([$nota1, $nota2, $nota3, $alumno_id, $materia_id]);
        $message = "Notas modificadas exitosamente.";
    } else {
        // Si no existen, insertamos las nuevas notas
        $queryInsert = "INSERT INTO notas (alumno_id, materia_id, nota1, nota2, nota3) VALUES (?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($queryInsert);
        $stmtInsert->execute([$alumno_id, $materia_id, $nota1, $nota2, $nota3]);
        $message = "Notas guardadas exitosamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar Notas</title>
    <link rel="stylesheet" href="../css/estilos_generales.css">
</head>
<body>
    <div class="container">
        <?php if (!empty($message)): ?>
            <div style="color: #28a745; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 10px; margin-top: 20px; border-radius: 5px; text-align: center; font-weight: bold;">
                <?= htmlspecialchars($message); ?>
            </div>
            <a href="../opciones.php" style="display: inline-block; color: #fff; background-color: #007bff; padding: 10px 20px; margin-top: 15px; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background-color 0.3s;">Opciones</a>
        <?php endif; ?>
    </div>
</body>
</html>
