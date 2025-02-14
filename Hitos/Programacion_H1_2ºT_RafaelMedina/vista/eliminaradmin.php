<?php
require_once '../controlador/UsuariosController.php'; // Incluyo el controlador de usuarios

$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php"); // Si no está logueado, lo envío al login
    exit();
}

$admin = $_SESSION['admin']; // Guardo la información del administrador logueado

// Compruebo si se envió el formulario por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo']; // Recupero el correo del administrador que quiero eliminar
    $controller->eliminarAdmin($correo); // Llamo al método para eliminar al admin
    header("Location: eliminaradmin.php"); // Redirijo a la misma página después de eliminar
    exit();
}

$tabla = $controller->obtenerAdmin(); // Obtengo la lista de administradores para mostrarla en la vista

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Eliminar Admin</h1>
        <div class="container">
            <h1 class="mt-4">Usuarios Registrados</h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID_admin</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tabla as $tabla): ?>
                        <tr>
                            <td><?= $tabla['id_admin'] ?></td>
                            <td><?= $tabla['nombre'] ?></td>
                            <td><?= $tabla['apellidos'] ?></td>
                            <td><?= $tabla['correo'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
        </div>
        <form method="POST">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" name="correo" class="form-control" value="" required>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar Administrador</button>
        </form>
        <a href="../index2.php" class="btn btn-secondary mt-3">Volver al Menu</a>
    </div>
</body>

</html>