<?php
// Conectar a la base de datos
require_once '../conexion.php';
require_once '../criterios/Criterios.php'; // Asegúrate de tener la clase Criterios correctamente implementada

// Crear instancia de Criterios
$criterio = new Criterios($conn);
$criterios = $criterio->getCriterios(); // Obtener criterios desde la base de datos

// Recibir los datos del formulario
$alumno_id = $_POST['alumno_id'];
$materia_id = $_POST['materia_id'];

// Obtener el nombre del alumno
$query_alumno = $conn->prepare("SELECT nombre, apellido, dni FROM alumno WHERE id = ?");
$query_alumno->execute([$alumno_id]);
$alumno = $query_alumno->fetch();

$nombre_alumno = $alumno ? $alumno['nombre']." ".$alumno['apellido']."<br><br>DNI: ".$alumno['dni'] : 'Alumno no encontrado';

// Obtener el nombre de la materia
$query_materia = $conn->prepare("SELECT nombre FROM materia WHERE id = ?");
$query_materia->execute([$materia_id]);
$materia = $query_materia->fetch();

$nombre_materia = $materia ? $materia['nombre'] : 'Materia no encontrada';

// Calcular porcentaje de asistencias
$query_asistencias = $conn->prepare("SELECT COUNT(*) AS total_asistencias, 
                                     SUM(estado = 'presente') AS asistencias 
                                     FROM asistencia 
                                     WHERE alumno_id = ? AND materia_id = ?");
$query_asistencias->execute([$alumno_id, $materia_id]);
$asistencias = $query_asistencias->fetch();

$porcentaje_asistencias = ($asistencias && $asistencias['total_asistencias'] > 0)
    ? ($asistencias['asistencias'] / $asistencias['total_asistencias']) * 100
    : 0;

// Obtener las notas del alumno
$query_notas = $conn->prepare("SELECT nota1, nota2, nota3 FROM notas WHERE alumno_id = ? AND materia_id = ?");
$query_notas->execute([$alumno_id, $materia_id]);
$notas = $query_notas->fetch();

$promedio_notas = $notas ? ($notas['nota1'] + $notas['nota2'] + $notas['nota3']) / 3 : 0;

// Determinar el estado del alumno usando criterios
$estado = "";
$detalles = "";
$estado_class = "";

if ($porcentaje_asistencias == 0 || $promedio_notas == 0) {
    $estado = "Error";
    $detalles = "No se han cargado asistencias o notas para este alumno en la materia seleccionada.";
    $estado_class = "estado-error";
} else {
    // Criterios configurables
    $asistencia_promocionado = $criterios['porcentaje_asistencia_promocion'];
    $asistencia_regulariza = $criterios['porcentaje_asistencia_regularizar'];
    $nota_promocionado = $criterios['nota_promocion'];
    $nota_regulariza = $criterios['nota_regularizar'];

    if ($porcentaje_asistencias >= $asistencia_promocionado) {
        if ($promedio_notas >= $nota_promocionado) {
            $estado = "Promocionado";
            $estado_class = "estado-promocionado";
        } elseif ($promedio_notas >= $nota_regulariza) {
            $estado = "Regulariza";
            $estado_class = "estado-regulariza";
        } else {
            $estado = "Libre";
            $estado_class = "estado-libre";
        }
    } elseif ($porcentaje_asistencias >= $asistencia_regulariza) {
        if ($promedio_notas >= $nota_regulariza) {
            $estado = "Regulariza";
            $estado_class = "estado-regulariza";
        } else {
            $estado = "Libre";
            $estado_class = "estado-libre";
        }
    } else {
        $estado = "Libre";
        $estado_class = "estado-libre";
    }
    $detalles = "El alumno $nombre_alumno tiene un porcentaje de asistencia del " . number_format($porcentaje_asistencias, 2) . "% y un promedio de notas de " . number_format($promedio_notas, 2) . ".";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de <?php echo $nombre_materia; ?> - Alumno <?php echo $nombre_alumno; ?></title>
    <link rel="stylesheet" href="notas_generales.css">
</head>
<body>
    <div class="container">
        <h2>Estado del alumno: <?php echo $nombre_alumno; ?> <br><br> En la materia: <?php echo $nombre_materia; ?></h2>
        <p class="<?php echo $estado_class; ?>"><strong>Estado:</strong> <?php echo $estado; ?></p>
        <div class="detalles"><strong>Detalles:</strong> <?php echo $detalles; ?></div><br><br>
        <a href="../opciones.php">Volver a Opciones</a>
    </div>
</body>
</html>
