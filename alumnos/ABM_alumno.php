<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Materia</title>
    <link rel="stylesheet" href="generales_alumno.css">
</head>
<body>

<div class="container">
    <h1>Gestión de Alumnos</h1>
    
    <?php
 
    require_once '../conexion.php';
    require_once 'Alumno.php';

    $alumno = new Alumno($conn);

    // Verificar la acción solicitada
    $action = $_POST['action'] ?? '';
    $dni = $_POST['dni'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

    if ($action === 'create') {
        // Verificar si el alumno ya existe
        if ($alumno->existeDni($dni)) {
            echo "<div class='error'>El alumno con dni: '$dni' ya existe en la base de datos.</div>";
        } else {
            // Crear la nuevo alumno
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;
            $alumno->dni = $dni;
            $alumno->fecha_nacimiento = $fecha_nacimiento;

            if ($alumno->create()) {
                echo "<div class='success'>Alumno creada con éxito.</div>";
            } else {
                echo "<div class='error'>Error al crear la materia.</div>";
            }
        }
    }
        
    if ($action === 'update' && $dni) {
        // Acción de actualización
        $alumno->dni = $dni;
        if ($alumno->update($dni)) {
            echo "<div class='success'>Alumno actualizada con éxito.</div>";
        } else {
            echo "<div class='error'>Error al actualizar la materia.</div>";
        } 
    } 
    
    if ($action === 'delete' && $dni) {
        if (isset($_GET['action']) && $_GET['action'] == 'delete_confirmed') {
            // Confirmación de eliminación
            if ($alumno->delete($dni)) {
                echo "<div class='success'>Alumno eliminado correctamente.</div>";
            } else {
                echo "<div class='error'>Ocurrió un error al intentar eliminar el alumno.</div>";
            }
        } else {
            // Verificar si tiene registros de asistencia asociados
            if ($alumno->hasAssociatedAsistencias($dni)) {
                echo "<div class='error'>Esta materia tiene registros de asistencia asociados. ¿Deseas eliminarla de todas formas?</div>";
                echo "<a href='ABM_alumno.php?action=delete_confirmed&id=$dni'>Sí, eliminar</a> | ";
                echo "<a href='../opciones.php'>No, regresar</a>";
            } else {
                // Si no tiene asistencias asociadas, eliminar directamente
                if ($alumno->delete($dni)) {
                    echo "<div class='success'>Alumno eliminado correctamente.</div>";
                } else {
                    echo "<div class='error'>Ocurrió un error al eliminar el alumno.</div>";
                }
            }
        }
    }
    ?>

</div>

</body>
</html>

<a href="../opciones.php">Opciones</a>
