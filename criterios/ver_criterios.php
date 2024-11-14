<?php
require_once 'Criterios.php';

$criteriosObj = new Criterios($conn);
$criterios = $criteriosObj->getCriterios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Criterios Actuales</title>
    <link rel="stylesheet" href="criterios_generales.css">
</head>
<body>
    <div class="container">
        <h2>Criterios Actuales</h2>
        <table>
            <tr>
                <th>Porcentaje Asistencia Promoción</th>
                <th>Porcentaje Asistencia Regularización</th>
                <th>Nota Promoción</th>
                <th>Nota Regularización</th>
            </tr>
            <tr>
                <td><?php echo $criterios['porcentaje_asistencia_promocion']; ?>%</td>
                <td><?php echo $criterios['porcentaje_asistencia_regularizar']; ?>%</td>
                <td><?php echo $criterios['nota_promocion']; ?></td>
                <td><?php echo $criterios['nota_regularizar']; ?></td>
            </tr>
        </table>
        <a href="modificar_criterios.php">Modificar Criterios</a><br><br>
        <a href="../opciones.php">opciones</a>
    </div>
</body>
</html>
