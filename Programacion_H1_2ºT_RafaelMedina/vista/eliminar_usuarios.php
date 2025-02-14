<?php
require_once '../controlador/UsuariosController.php'; // Incluyo el controlador de usuarios

$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php"); // Si no está logueado, lo envío al login
    exit();
}

// Compruebo si se recibió un ID de usuario a través de la URL
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    error_log("ID de usuario recibido: " . $id_usuario); // Registro el ID en el log para depuración

    // Busco la información del usuario con el ID proporcionado
    $usuario = $controller->obtenerUsuarioporid($id_usuario);

    if (!$usuario) { // Si no encuentro el usuario, muestro un mensaje y corto la ejecución
        echo "Usuario no encontrado.";
        exit();
    } else {
        error_log("Usuario encontrado: " . print_r($usuario, true)); // Registro los datos del usuario en el log
    }
} else {
    echo "ID de usuario no proporcionado."; // Si no hay ID en la URL, muestro un mensaje y corto la ejecución
    exit();
}

// Compruebo si se envió el formulario para eliminar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id']; // Obtengo el ID del usuario desde el formulario
    $controller->eliminarUsuario($id_usuario); // Llamo al método para eliminar el usuario
    header("Location: alta_usuarios.php"); // Redirijo a la lista de usuarios después de eliminarlo
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Eliminar Usuario</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text" name="id" class="form-control" value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>" required>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
        </form>
        <a href="alta_usuarios.php" class="btn btn-secondary mt-3">Volver a la lista de Usuarios</a>
    </div>
</body>

</html>