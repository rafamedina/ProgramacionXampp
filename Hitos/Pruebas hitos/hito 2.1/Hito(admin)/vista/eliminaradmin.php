<?php
require_once '../controlador/UsuariosController.php';

$controller = new UsuarioController();
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php");
    exit();
}

$admin = $_SESSION['admin'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $controller->eliminarAdmin($correo);
    header("Location: eliminaradmin.php");
    exit();
}
$tabla = $controller->obtenerAdmin();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Admin</title>
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
                            <td><?= htmlspecialchars($tabla['id_admin']) ?></td>
                            <td><?= htmlspecialchars($tabla['nombre']) ?></td>
                            <td><?= htmlspecialchars($tabla['apellidos']) ?></td>
                            <td><?= htmlspecialchars($tabla['correo']) ?></td>
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
