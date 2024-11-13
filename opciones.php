<?php

 require_once 'conexion.php';

 $fechaHoy = date('n-j');
//var_dump($fechaHoy);
 // Obtener el nombre de la materia seleccionada
$sqlCumple = "SELECT nombre,apellido FROM alumno WHERE fecha_nacimiento = :fechaHoy";

//var_dump($sqlCumple);

$stmtCumple = $conn->prepare($sqlCumple);

$stmtCumple->execute([':fechaHoy' => $fechaHoy]);
//var_dump($stmtCumple);
$alumnoCumple = $stmtCumple -> fetchAll(PDO::FETCH_ASSOC);

//var_dump($alumnoCumple);
if ($alumnoCumple){

    foreach ($alumnoCumple as $alumno){
        echo "<h2>Hoy es el cumpleaños de: ".($alumno['nombre']." ".$alumno['apellido'])."</h2>";
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
        
    </div>
</body>
</html>
