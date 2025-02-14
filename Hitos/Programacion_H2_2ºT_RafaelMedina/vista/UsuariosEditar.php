<?php

require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    session_destroy(); // Cierro la sesión por seguridad
    header("Location: ../index.php");  // Redirijo al login si no está logueado
    exit(); // Detengo la ejecución del script
}

// Obtengo el ID del usuario desde la sesión
$idusuario = $_SESSION["usuario"]["id_usuario"];
$usuario = $controller->obtenerUsuarioporid($idusuario); // Obtengo la información del usuario

// Verifico si el usuario existe
if (!$idusuario) {  
    echo "Usuario no encontrado."; // Muestro un mensaje si el usuario no se encuentra
    exit(); // Detengo la ejecución del script
}

$error_message = null; // Inicializo la variable de error

// Verifico si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['password'];

    // Llamo al método para actualizar los datos del usuario
    $actualizar = $controller->actualizarUsuario($idusuario, $nombre, $apellidos, $correo, $telefono, $contraseña);
    
    if (!$actualizar) {
        $error_message = "Error al actualizar los datos del usuario"; // Mensaje de error si la actualización falla
    } else {
        $error_message = "Usuario Actualizado"; // Mensaje de éxito
        header("Location: UsuariosEditar.php"); // Redirijo a la página de edición
    }  
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-alert-sandybrown {
            color: #fff;
            background-color: sandybrown;
            border-color: sandybrown;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Editar Perfil</h1>

        <?php if (!empty($error_message)): ?>
            <div class="alert custom-alert-sandybrown">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
        </form>
        <button><a href="../MenuUsuario.php" class="list-group-item list-group-item-action">Volver</a></button>
        <button><a href="UsuarioEliminar.php" class="list-group-item list-group-item-action">Eliminar mi cuenta</a></button>
    </div>
</body>

</html>