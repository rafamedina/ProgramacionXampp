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

$lista = $controller->obtenerUsuariosCompletos();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <div class="container">
            <h1 class="mt-4">Usuarios Registrados</h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID Resumen</th>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>edad</th>
                        <th>Telefono</th>
                        <th>Plan Obtenido</th>
                        <th>Paquetes Obtenidos</th>
                        <th>Dispositivos</th>
                        <th>Cuota</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $lista): ?>
                        <tr>
                            <td><?= $lista['id_resumen'] ?></td>
                            <td><?= $lista['id_usuario'] ?></td>
                            <td><?= $lista['nombre'] ?></td>
                            <td><?= $lista['apellidos'] ?></td>
                            <td><?= $lista['correo'] ?></td>
                            <td><?= $lista['edad'] ?></td>
                            <td><?= $lista['telefono'] ?></td>
                            <td><?= $lista['Plan_Obtenido'] ?></td>
                            <td><?= $lista['Paquetes_Obtenidos'] ?></td>
                            <td><?= $lista['dispositivos'] ?></td>
                            <td><?= $lista['Cuota'] ?></td>
                            <td>
                                <a href="eliminarplan.php?id=<?= $lista['id_usuario'] ?>" class="btn btn-warning">Cambiar Plan</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <button><a href="../index2.php" class="list-group-item list-group-item-action">Volver al menú</a></button>
        </div>
</body>

</html>