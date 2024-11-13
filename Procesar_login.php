Archivo "procesar_login.php" <?php
require 'conexion.php';


// Función para limpiar los datos de entrada
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verificar si se recibieron los valores por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores enviados por POST
    $usuario = clean_input($_POST["nombre"]);
    $password = clean_input($_POST["password"]);

    // Crear una instancia de la clase Database
    //$database = new Database($db);
    // Obtener la conexión
    //$conn = $database->connect();

    try {
    
        // Preparar la consulta SQL
        $stmt = $conn->prepare('SELECT * FROM profesor WHERE nombre = :nombre');
        // Vincular los parámetros
        $stmt->bindParam(':nombre', $usuario, PDO::PARAM_STR);
        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);
        //die(var_dump($usuario_db));
        // Verificar si se encontró el usuario y si la contraseña coincide
        //if ($usuario_db && password_verify($contrasena, $usuario_db['contrasena'])) {
        if ($usuario_db['password'] == $password && $usuario_db['nombre'] == 'Yamil') {
            // Establecer variables de sesión
            //$_SESSION["usuario"] = $usuario;
            echo "Login exitoso. Administrador: ".$usuario_db['nombre'];
            // Redirigir al usuario a otra página después del login exitoso
            header("Location: opciones.php");
            exit();

        } else if ($usuario_db['password'] == $password) {
                // Establecer variables de sesión
                //$_SESSION["usuario"] = $usuario;
                echo "Login exitoso. Profesor: ".$usuario_db['nombre'];
                // Redirigir al usuario a otra página después del login exitoso
                header("Location: opciones.php");

            }else{

            echo "Error: Usuario o contraseña inválidos.";
            }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }

} else {
    // Si no se recibieron los valores por POST, mostrar un mensaje de error
    echo "Error: No se recibieron los valores por POST.";
}
?>