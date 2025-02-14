<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php");
    exit();
}
require_once '../controlador/UsuariosController.php';
$controller = new UsuarioController();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idadmin = $_POST['id_admin'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $usuario = $controller->agregarAdmin($idadmin, $nombre, $apellidos, $correo, $contraseña);

    if (!$usuario) {
        $error_message = "Error al agregar Usuario. Por favor, verifica los datos.";
    } else {
        $success_message = "Administrador agregado con éxito.";
        header("Location: ../index2.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Cream background */
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Agregar Usuario</h1>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
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
            <button><a href="../index2.php" class="list-group-item list-group-item-action">Volver al menú</a></button>
        </form>
    </div>
</body>

</html>
