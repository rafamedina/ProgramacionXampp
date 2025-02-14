<?php

require_once '../controlador/UsuariosController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php"); // Si no está logueado, lo envío al login
    exit();
}

// Compruebo si recibí un ID de usuario por la URL
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

$admin = $_SESSION['admin']; // Guardo los datos del admin que inició sesión

$error_message = null; // Inicializo la variable de error

// Compruebo si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];

    // Llamo al método para actualizar los datos del usuario
    $controller->actualizarUsuario($usuario['id_usuario'], $nombre, $apellidos, $correo, $edad, $telefono);

    // Redirijo a la página de alta de usuarios después de actualizar
    header("Location: alta_usuarios.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Editar Perfil</h1>

        <?php if (isset($_GET['actualizado'])): ?>
            <div class="alert alert-success">¡Perfil actualizado correctamente!</div>
        <?php endif; ?>

        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['apellidos'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" class="form-control" id="edad" name="edad" value="<?php echo htmlspecialchars($usuario['edad'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <br>
            <br>
            <button><a href="../vista/alta_usuarios.php" class="list-group-item list-group-item-action">Volver</a></button>
            <br>
            <br>
            <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
            <a href="../index2.php" class="btn btn-danger mt-3">Volver</a>
        </form>
    </div>
</body>

</html>