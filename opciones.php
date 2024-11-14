<?php

 require_once 'conexion.php';
 
$fechaHoy = date('n-j');

// Consulta para verificar si hay algún alumno que cumpla años hoy
$sqlCumple = "SELECT nombre, apellido FROM alumno WHERE DATE_FORMAT(fecha_nacimiento, '%c-%e') = :fechaHoy";

$stmtCumple = $conn->prepare($sqlCumple);
$stmtCumple->execute([':fechaHoy' => $fechaHoy]);

// Obtén los alumnos que cumplen años hoy
$alumnoCumple = $stmtCumple->fetchAll(PDO::FETCH_ASSOC);

if ($alumnoCumple) {
    foreach ($alumnoCumple as $alumno) {
        echo "<h2>Hoy es el cumpleaños de: " . htmlspecialchars($alumno['nombre'] . " " . $alumno['apellido']) . "</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones</title>
    <!-- Enlazar el archivo CSS -->
    <link rel="stylesheet" href="css/estilo_opciones.css">
</head>
<body>
    <div class="container">
        <h2>Opciones</h2>
        <a href="asistencia/alta_asistencia.php">Alta de Asistencia</a>
        <a href="asistencia/seleccionar_materia.php">Muestra Asistencia Materia</a>
        <a href="notas/formulario_notas.php">Formulario de Notas</a>
        <a href="notas/ver_estado.php">Ver Estado Alumno</a>
        <a href="materia/form_ABM_materia.php">ABM Materia</a>
        <a href="alumnos/form_ABM_alumno.php">ABM Alumno</a>
        <a href="criterios/ver_criterios.php">Ver Criterios en la BD</a>
        <a href="criterios/modificar_criterios.php">Modificar criterios de la BD</a>
    </div>
</body>
</html>
