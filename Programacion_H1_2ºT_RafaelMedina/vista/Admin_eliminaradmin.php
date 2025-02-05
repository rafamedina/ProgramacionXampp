<?php
require_once '../controlador/AdminController.php'; // Importo el controlador

$controller = new AdminController(); // Instancio el controlador

session_start(); // Inicio sesión

// Verifico si el usuario es admin
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ../index.php"); // Redirijo si no es admin
    exit();
}

$admin = $_SESSION['admin']; // Guardo datos del admin logueado

// Si se envía el formulario, elimino al administrador
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $controller->eliminarAdmin($correo);
    header("Location: Admin_eliminaradmin.php"); // Redirijo tras eliminar
    exit();
}

$tabla = $controller->obtenerAdmin(); // Obtengo la lista de administradores

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
        <a href="../indexAdmin2.php" class="btn btn-secondary mt-3">Volver al Menu</a>
    </div>
</body>

</html>