<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Alumno</title>
    <link rel="stylesheet" href="generales_alumnos.css">
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
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $dni_nuevo = $_POST['dni'] ?? '';
    $dni_existente = $_POST['dni_existente'] ?? '';

    if ($action === 'create' && $dni_nuevo) {
        // Crear el nuevo alumno
        $alumno->nombre = $nombre;
        $alumno->apellido = $apellido;
        $alumno->dni = $dni_nuevo;
        $alumno->fecha_nacimiento = $fecha_nacimiento;

        if ($alumno->createAlumno()) {
            echo "<div class='success_alumno'>Alumno creado con éxito.</div>";
        } else {
            echo "<div class='error_alumno'>Error al crear el alumno.</div>";
        }
    }

    if ($action === 'update' && $dni_existente) {
        // Actualizar el alumno con el DNI seleccionado
        $alumno->nombre = $nombre;
        $alumno->apellido = $apellido;
        $alumno->fecha_nacimiento = $fecha_nacimiento;

        if ($alumno->updateAlumno($dni_existente)) {
            echo "<div class='success_alumno'>Alumno actualizado con éxito.</div>";
        } else {
            echo "<div class='error_alumno'>Error al actualizar el alumno.</div>";
        }
    }

    if ($action === 'delete' && $dni_existente) {
        if ($alumno->deleteAlumno($dni_existente)) {
            echo "<div class='success_alumno'>Alumno eliminado correctamente.</div>";
        } else {
            echo "<div class='error_alumno'>Ocurrió un error al eliminar el alumno.</div>";
        }
    }
    ?>
    <a href="../opciones.php">Opciones</a>
</div>

</body>
</html>


