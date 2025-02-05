<?php

require_once '../controlador/UsuariosController.php';
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciosesion_usuarios.php");
    exit();
}
$usuario = $_SESSION['usuario'];
$controller = new UsuarioController();

$error_message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];

    // Actualizar usuario en la base de datos
    $controller->actualizarUsuario($usuario['id_usuario'], $nombre, $apellidos, $correo, $edad);

    // Obtener los datos actualizados
    $usuarioActualizado = $controller->obtenerUsuarioPorId($usuario['id_usuario']);

    // Actualizar los datos en la sesión
    $_SESSION['usuario'] = $usuarioActualizado;

    // Recargar la página automáticamente después de la actualización
    header("Location: editar_usuarios.php?actualizado=1");
    exit();
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
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario']['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($_SESSION['usuario']['apellidos'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($_SESSION['usuario']['correo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" class="form-control" id="edad" name="edad" value="<?php echo htmlspecialchars($_SESSION['usuario']['edad'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
            <a href="../index2.php" class="btn btn-danger mt-3">Volver</a>


        </form>
    </div>
</body>

</html>