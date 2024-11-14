<?php
require_once 'Criterios.php';

$criteriosObj = new Criterios($conn);
$criterios = $criteriosObj->getCriterios();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $porcentajePromocion = $_POST['porcentaje_promocion'];
    $porcentajeRegularizar = $_POST['porcentaje_regularizar'];
    $notaPromocion = $_POST['nota_promocion'];
    $notaRegularizar = $_POST['nota_regularizar'];

    $criteriosObj->actualizarCriterios($porcentajePromocion, $porcentajeRegularizar, $notaPromocion, $notaRegularizar);
    header("Location: ver_criterios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Criterios</title>
    <link rel="stylesheet" href="criterios_generales.css">
</head>
<body>
    <div class="container">
        <h2>Modificar Criterios</h2>
        <form method="POST" action="">
            <label for="porcentaje_promocion">Porcentaje Asistencia Promoción (%):</label>
            <input type="number" name="porcentaje_promocion" id="porcentaje_promocion" value="<?php echo $criterios['porcentaje_asistencia_promocion']; ?>" required>

            <label for="porcentaje_regularizar">Porcentaje Asistencia Regularización (%):</label>
            <input type="number" name="porcentaje_regularizar" id="porcentaje_regularizar" value="<?php echo $criterios['porcentaje_asistencia_regularizar']; ?>" required>

            <label for="nota_promocion">Nota para Promoción:</label>
            <input type="number" name="nota_promocion" id="nota_promocion" value="<?php echo $criterios['nota_promocion']; ?>" required step="0.01">

            <label for="nota_regularizar">Nota para Regularización:</label>
            <input type="number" name="nota_regularizar" id="nota_regularizar" value="<?php echo $criterios['nota_regularizar']; ?>" required step="0.01">

            <button type="submit">Guardar Cambios</button>
        </form>
        <a href="ver_criterios.php">Volver a Ver Criterios</a><br><br>
        <a href="../opciones.php">opciones</a>
    </div>
</body>
</html>
