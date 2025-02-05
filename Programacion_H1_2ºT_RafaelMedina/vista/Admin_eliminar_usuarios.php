<?php
require_once '../controlador/AdminController.php'; // Incluyo el controlador de usuarios

$controller = new AdminController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ../index.php");  // Si no está logueado, lo envío al login
    exit();
}
// Recojo el Id y lo convierto a INT
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    $usuario = $controller->obtenerUsuarioporid($id_usuario);
} else {
    echo "No se proporcionó un ID de usuario.";
}

// Compruebo si se envió el formulario para eliminar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id']; // Obtengo el ID del usuario desde el formulario
    $controller->eliminarUsuario($usuario["id_usuario"]); // Llamo al método para eliminar el usuario
    header("Location: Admin_alta_usuarios.php"); // Redirijo a la lista de usuarios después de eliminarlo
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
        <a href="Admin_alta_usuarios.php" class="btn btn-secondary mt-3">Volver a la lista de Usuarios</a>
    </div>
</body>

</html>