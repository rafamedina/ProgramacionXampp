<?php
require_once '../controlador/UsuariosController.php';
session_start();

// Verificar si el usuario está logueado, de lo contrario redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciosesion_usuarios.php"); // Redirige al login si no está logueado
    exit();
}

$controller = new UsuarioController();
$error_message = null;

// Use session data to populate user information
if (!isset($_SESSION['usuario'])) {
    echo "ID de usuario no está definido en la sesión.";
    exit();
}

$id_usuario = $_SESSION['usuario'];
$usuarios = $controller->obtenerUsuarioporid($id_usuario);

if (!$usuarios) {
    echo "No se encontró información del usuario.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Perfil Usuario</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Edad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($usuarios['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuarios['apellidos']) ?></td>
                    <td><?= htmlspecialchars($usuarios['correo']) ?></td>
                    <td><?= htmlspecialchars($usuarios['edad']) ?></td>
                </tr>
            </tbody>
        </table>
        <a href="../index2.php" class="list-group-item list-group-item-action">Menu</a>
        <a href="editar_usuarios.php" class="list-group-item list-group-item-action">Cambiar Mis Datos</a>
    </div>
</body>

</html>