<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Materia</title>
    <link rel="stylesheet" href="generales_materia.css">
</head>
<body>

<div class="container">
    <h1>Gestión de Materias</h1>
    
    <?php
    // Tu código PHP aquí
    require_once '../conexion.php'; // Archivo con la conexión a la base de datos
    require_once 'Materia.php'; // Archivo con la clase Materia

    // Crear instancia de la clase Materia
    $materia = new Materia($conn);

    // Verificar la acción solicitada
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? '';

    if ($action === 'create') {
        // Verificar si la materia ya existe
        if ($materia->exists($nombre)) {
            echo "<div class='error'>La materia '$nombre' ya existe en la base de datos.</div>";
        } else {
            // Crear la nueva materia
            $materia->nombre = $nombre;
            if ($materia->create()) {
                echo "<div class='success'>Materia creada con éxito.</div>";
            } else {
                echo "<div class='error'>Error al crear la materia.</div>";
            }
        }
    }
        
    if ($action === 'update' && $id) {
        // Acción de actualización
        $materia->nombre = $nombre;
        if ($materia->update($id)) {
            echo "<div class='success'>Materia actualizada con éxito.</div>";
        } else {
            echo "<div class='error'>Error al actualizar la materia.</div>";
        } 
    } 
    
    if ($action === 'delete' && $id) {
        if (isset($_GET['action']) && $_GET['action'] == 'delete_confirmed') {
            // Confirmación de eliminación
            if ($materia->delete($id)) {
                echo "<div class='success'>Materia eliminada correctamente.</div>";
            } else {
                echo "<div class='error'>Ocurrió un error al intentar eliminar la materia.</div>";
            }
        } else {
            // Verificar si tiene registros de asistencia asociados
            if ($materia->hasAssociatedAsistencias($id)) {
                echo "<div class='error'>Esta materia tiene registros de asistencia asociados. ¿Deseas eliminarla de todas formas?</div>";
                echo "<a href='ABM_materia.php?action=delete_confirmed&id=$id'>Sí, eliminar</a> | ";
                echo "<a href='../opciones.php'>No, regresar</a>";
            } else {
                // Si no tiene asistencias asociadas, eliminar directamente
                if ($materia->delete($id)) {
                    echo "<div class='success'>Materia eliminada correctamente.</div>";
                } else {
                    echo "<div class='error'>Ocurrió un error al eliminar la materia.</div>";
                }
            }
        }
    }
    ?>

</div>

</body>
</html>

<a href="../opciones.php">Opciones</a>
