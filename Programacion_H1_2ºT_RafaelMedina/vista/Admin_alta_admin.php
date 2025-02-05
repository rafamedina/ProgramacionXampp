<?php
session_start(); // Inicia la sesión

// Verifica si el usuario es admin, si no, lo redirige
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

require_once '../controlador/AdminController.php';
$controller = new AdminController();
$error_message = '';

// Si se envió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $idadmin = $_POST['id_admin'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Agrega un nuevo administrador
    $usuario = $controller->agregarAdmin($idadmin, $nombre, $apellidos, $correo, $contraseña);

    // Verifica si hubo un error
    if (!$usuario) {
        $error_message = "Error al agregar Usuario.";
    } else {
        header("Location: ../indexAdmin2.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Agregar Usuario</h1>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>

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


            <button type="submit" class="btn btn-primary">Registrarme</button>

            <button>
                <a href="../indexAdmin2.php" class="list-group-item list-group-item-action">Volver al menú</a>
            </button>
        </form>
    </div>
</body>

</html>