<?php
session_start(); // Inicia la sesión para poder acceder a las variables de sesión

// Verifica si el usuario está logueado como admin
if (!isset($_SESSION['admin'])) { 
    header("Location: iniciosesion_usuarios.php"); // Si no es admin, lo redirige al inicio de sesión
    exit();
}

// Importa el controlador que maneja los usuarios
require_once '../controlador/UsuariosController.php';
$controller = new UsuarioController(); // Crea una instancia del controlador de usuarios
$error_message = ''; // Variable para almacenar posibles errores

// Si el formulario se envió con el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $idadmin = $_POST['id_admin'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Llama al método del controlador para agregar un nuevo administrador
    $usuario = $controller->agregarAdmin($idadmin, $nombre, $apellidos, $correo, $contraseña);

    if (!$usuario) { // Si hubo un error al agregar el usuario
        $error_message = "Error al agregar Usuario. Por favor, verifica los datos.";
    } else { // Si se agregó correctamente
        $success_message = "Administrador agregado con éxito.";
        header("Location: ../index2.php"); // Redirige a la página principal
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <!-- Importa Bootstrap para los estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Agregar Usuario</h1>

        <!-- Muestra mensajes de error o éxito -->
        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <!-- Formulario para agregar un administrador -->
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="id_admin">ID Admin:</label>
                <input type="text" class="form-control" id="id_admin" name="id_admin" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
            </div>

            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Registrarme</button>
            <!-- Botón para volver al menú principal -->
            <button>
                <a href="../index2.php" class="list-group-item list-group-item-action">Volver al menú</a>
            </button>
        </form>
    </div>
</body>
</html>
