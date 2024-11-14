<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="insertar_materia.php" method="POST">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div> 
        <button type="submit">Insertar materia</button>
    </form>  
</body>
</html>-->
<?php
require_once '../conexion.php';
require_once 'Materia.php';

// Crear instancia de Materia y obtener todas las materias
$materia = new Materia($conn);
$materias = $materia->getAllMaterias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Materia</title>
    <link rel="stylesheet" href="generales_materia.css">
</head>
<body>
    <h1>Alta, Baja y Modificación de Materia</h1>

    <form action="ABM_materia.php" method="POST">
        <label for="nombre">Nombre de la materia:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="id">Selecciona una materia para actualizar o eliminar:</label>
        <select name="id" id="id">
            <option value="">-- Selecciona --</option>
            <?php foreach ($materias as $mat): ?>
                <option value="<?= $mat['id'] ?>">
                    <?= $mat['id'] . ' - ' . htmlspecialchars($mat['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="action" value="create">Crear</button>
        <button type="submit" name="action" value="update">Actualizar</button>
        <button type="submit" name="action" value="delete">Eliminar</button>
    </form>
</body>
</html>

