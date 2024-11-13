<?php
// Conectar a la base de datos
require_once '../conexion.php';

// Recibir los datos del formulario
$alumno_id = $_POST['alumno_id'];
$materia_id = $_POST['materia_id'];

// Obtener el nombre de la materia
$query_materia = $conn->prepare("SELECT nombre FROM materia WHERE id = ?");
$query_materia->execute([$materia_id]);
$materia = $query_materia->fetch();

$nombre_materia = $materia ? $materia['nombre'] : 'Materia no encontrada'; // Si no se encuentra la materia

// Calcular porcentaje de asistencias
$query_asistencias = $conn->prepare("SELECT COUNT(*) AS total_asistencias, 
                                     SUM(estado = 'presente') AS asistencias 
                                     FROM asistencia 
                                     WHERE alumno_id = ? AND materia_id = ?");
$query_asistencias->execute([$alumno_id, $materia_id]);
$asistencias = $query_asistencias->fetch();

if ($asistencias && $asistencias['total_asistencias'] > 0) {
    $porcentaje_asistencias = ($asistencias['asistencias'] / $asistencias['total_asistencias']) * 100;
} else {
    $porcentaje_asistencias = 0; // Si no hay asistencias, porcentaje es 0
}

// Obtener las notas del alumno
$query_notas = $conn->prepare("SELECT nota1, nota2, nota3 FROM notas WHERE alumno_id = ? AND materia_id = ?");
$query_notas->execute([$alumno_id, $materia_id]);
$notas = $query_notas->fetch();

if ($notas) {
    $promedio_notas = ($notas['nota1'] + $notas['nota2'] + $notas['nota3']) / 3;
} else {
    $promedio_notas = 0; // Si no hay notas, promedio es 0
}

// Determinar el estado del alumno
$estado = "";
$detalles = ""; // Para los detalles del estado
$estado_class = ""; // Clase para el color del estado

if ($porcentaje_asistencias == 0 || $promedio_notas == 0) {
    // Si no hay asistencias o notas, mostrar mensaje de error
    $estado = "Error";
    $detalles = "No se han cargado asistencias o notas para este alumno en la materia seleccionada.";
    $estado_class = "estado-error";
} else {
    if ($porcentaje_asistencias >= 70) {
        // Asistencia mayor o igual al 70%
        if ($promedio_notas >= 7) {
            $estado = "Promocionado";
            $detalles = "El alumno tiene un porcentaje de asistencia del " . number_format($porcentaje_asistencias, 2) . "% y un promedio de notas de " . number_format($promedio_notas, 2) . ". Ha sido promocionado.";
            $estado_class = "estado-promocionado";
        } elseif ($promedio_notas >= 6) {
            $estado = "Regulariza";
            $detalles = "El alumno tiene un porcentaje de asistencia del " . number_format($porcentaje_asistencias, 2) . "% y un promedio de notas de " . number_format($promedio_notas, 2) . ". Ha regularizado la materia.";
            $estado_class = "estado-regulariza";
        } else {
            $estado = "Libre";
            $detalles = "El alumno tiene un porcentaje de asistencia del " . number_format($porcentaje_asistencias, 2) . "% y un promedio de notas de " . number_format($promedio_notas, 2) . ". Ha quedado libre.";
            $estado_class = "estado-libre";
        }
    } elseif ($porcentaje_asistencias >= 60) {
        // Asistencia entre 60% y 69%
        if ($promedio_notas >= 6) {
            $estado = "Regulariza";
            $detalles = "El alumno tiene un porcentaje de asistencia del " . number_format($porcentaje_asistencias, 2) . "% y un promedio de notas de " . number_format($promedio_notas, 2) . ". Ha regularizado la materia.";
            $estado_class = "estado-regulariza";
        } else {
            $estado = "Libre";
            $detalles = "El alumno tiene un porcentaje de asistencia del " . number_format($porcentaje_asistencias, 2) . "% y un promedio de notas de " . number_format($promedio_notas, 2) . ". Ha quedado libre.";
            $estado_class = "estado-libre";
        }
    } else {
        // Asistencia menor al 60%
        $estado = "Libre";
        $detalles = "El alumno tiene un porcentaje de asistencia del " . number_format($porcentaje_asistencias, 2) . "% y un promedio de notas de " . number_format($promedio_notas, 2) . ". Ha quedado libre debido a una asistencia insuficiente.";
        $estado_class = "estado-libre";
    }
}

// Mostrar el resultado con estilo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de <?php echo $nombre_materia; ?> - Alumno</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Estado del alumno en la materia: <?php echo $nombre_materia; ?></h2>
        <p class="<?php echo $estado_class; ?>"><strong>Estado:</strong> <?php echo $estado; ?></p>
        <div class="detalles"><strong>Detalles:</strong> <?php echo $detalles; ?></div>
        <a href="../opciones.php">Volver a Opciones</a>
    </div>
</body>
</html>
