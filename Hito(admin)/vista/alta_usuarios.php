<?php
require_once '../controlador/UsuariosController.php';
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php");
    exit();
}
$controller = new UsuarioController();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];

    $usuario = $controller->agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono);
    if (!$usuario) {
        $error_message = "Error al agregar Usuario. Por favor, verifica los datos.";
    } else {
        $success_message = "Usuario agregado con éxito.";
        header("location: alta_usuarios.php");
        exit();
    }
}
$lista = $controller->obtenerUsuario();
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
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellidos:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" class="form-control" id="edad" name="edad" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" class="form-control" id="telefono" name="telefono" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <br>
        <br>
        <button><a href="../index2.php" class="list-group-item list-group-item-action">Volver al menú</a></button>
    </div>

    <div class="container">
        <h1 class="mt-4">Usuarios Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>edad</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $lista): ?>
                    <tr>
                        <td><?= htmlspecialchars($lista['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($lista['nombre']) ?></td>
                        <td><?= htmlspecialchars($lista['apellidos']) ?></td>
                        <td><?= htmlspecialchars($lista['correo']) ?></td>
                        <td><?= htmlspecialchars($lista['edad']) ?></td>
                        <td><?= htmlspecialchars($lista['telefono']) ?></td>
                        <td>
                            <a href="editar_usuarios.php?id=<?= $lista['id_usuario'] ?>" class="btn btn-warning">Editar</a>
                            <a href="alta_plan.php?id=<?= $lista['id_usuario'] ?>" class="btn btn-danger">Añadir Plan</a>
                            <a href="agregar_paquetes.php?id=<?= $lista['id_usuario'] ?>" class="btn btn-warning">Añadir Paquetes</a>
                            <a href="eliminar_usuarios.php?id=<?= $lista['id_usuario'] ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>
</body>

</html>
