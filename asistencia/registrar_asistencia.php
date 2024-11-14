<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
    <link rel="stylesheet" href="../css/estilos_asistencia/registrar_asistencia.css"> 
</head>
<body>

<?php
require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $materia_id = $_POST['materia_id'];
    $fecha = $_POST['fecha'];
    $alumnos = $_POST['alumnos'];

    // Inicialización de contadores
    $asistenciasRegistradas = 0;
    $asistenciasExistentes = 0;

    // Obtener la fecha actual
    $fechaActual = date('Y-m-d');

    // Verificar si la fecha proporcionada es mayor que la fecha actual
    if ($fecha > $fechaActual) {
        echo "<div class='error'>No se puede registrar una asistencia para una fecha futura. Fecha actual: $fechaActual.</div>";
        exit;
    }

    // Obtener el nombre de la materia
    $sqlMateria = "SELECT nombre FROM materia WHERE id = :materia_id";
    $stmtMateria = $conn->prepare($sqlMateria);
    $stmtMateria->execute([':materia_id' => $materia_id]);
    $materia = $stmtMateria->fetch(PDO::FETCH_ASSOC);
    $materiaNombre = $materia['nombre'];

    foreach ($alumnos as $alumno_id => $asistencia) {
        $estado = $asistencia['estado'] === 'presente' ? 1 : 0;

        // Obtener el nombre del alumno
        $sqlAlumno = "SELECT nombre, apellido FROM alumno WHERE id = :alumno_id";
        $stmtAlumno = $conn->prepare($sqlAlumno);
        $stmtAlumno->execute([':alumno_id' => $alumno_id]);
        $alumno = $stmtAlumno->fetch(PDO::FETCH_ASSOC);
        $alumnoNombre = $alumno['nombre'] . " " . $alumno['apellido'];

        // Verificar si ya existe un registro de asistencia para este alumno, materia y fecha
        $sqlCheck = "SELECT COUNT(*) FROM asistencia 
                     WHERE alumno_id = :alumno_id AND materia_id = :materia_id AND fecha = :fecha";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->execute([':alumno_id' => $alumno_id, ':materia_id' => $materia_id, ':fecha' => $fecha]);

        if ($stmtCheck->fetchColumn() == 0) {
            // Si no existe el registro, insertar la nueva asistencia
            $sqlInsert = "INSERT INTO asistencia (alumno_id, materia_id, fecha, estado)
                          VALUES (:alumno_id, :materia_id, :fecha, :estado)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->execute([
                ':alumno_id' => $alumno_id,
                ':materia_id' => $materia_id,
                ':fecha' => $fecha,
                ':estado' => $estado
            ]);
            $asistenciasRegistradas++; // Aumentar contador de asistencias registradas
            echo "<div class='success'>Asistencia registrada para el alumno: $alumnoNombre en la materia: $materiaNombre.</div>";
        } else {
            $asistenciasExistentes++; // Aumentar contador de asistencias existentes
            echo "<div class='info'>Ya existe una asistencia registrada para el alumno $alumnoNombre en la materia $materiaNombre para la fecha $fecha.</div>";
        }
    }

    // Mostrar los resultados de los contadores
    echo "<div class='info'>Total de asistencias registradas: $asistenciasRegistradas</div>";
    echo "<div class='info'>Total de alumnos con asistencia ya registrada: $asistenciasExistentes</div>";

    echo "<div class='success'>Asistencias registradas correctamente.</div>";
}
?>

<a href="../opciones.php">Volver a opciones</a>

</body>
</html>
