<?php

require_once '../controlador/UsuariosController.php';

$controller = new UsuarioController();
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php");
    exit();
}
// Obtener ID del usuario desde GET o POST
$id_usuario = $_GET['id'] ?? $_POST['id_usuario'] ?? null;

if (!$id_usuario) {
    echo "ID de usuario no válido o no proporcionado.";
    exit();
}

$usuario = $controller->obtenerUsuariosCompletosIndividual2($id_usuario);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->eliminarplan($usuario["id_usuario"]);
    header("Location: alta_usuarios.php");
    exit();
}
$planUsuario = $controller->obtenerUsuariosCompletosIndividual($usuario["id_usuario"]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
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
        <h1 class="mt-4">Cambiar Plan</h1>
        <h2>Atencion: Si cambias el plan tendras que volver a elegir Paquete</h2>
        <form method="POST">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario["id_usuario"]) ?>">

            <div class="container mt-5">
                <h2>Plan y Paquetes Actuales</h2>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Edad</th>
                            <th>Teléfono</th>
                            <th>Plan</th>
                            <th>Paquetes</th>
                            <th>Dispositivos</th>
                            <th>Cuota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($planUsuario as $plan): ?>
                            <tr>
                                <td><?= htmlspecialchars($plan['id_resumen']) ?></td>
                                <td><?= htmlspecialchars($plan['nombre'] . ' ' . $plan['apellidos']) ?></td>
                                <td><?= htmlspecialchars($plan['correo']) ?></td>
                                <td><?= htmlspecialchars($plan['edad']) ?></td>
                                <td><?= htmlspecialchars($plan['telefono']) ?></td>
                                <td><?= htmlspecialchars($plan['Plan_Obtenido']) ?></td>
                                <td><?= htmlspecialchars($plan['Paquetes_Obtenidos']) ?></td>
                                <td><?= htmlspecialchars($plan['dispositivos']) ?></td>
                                <td><?= htmlspecialchars($plan['Cuota']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <h3>Atencion! no hay vuelta atras.</h3>
            <button type="submit" class="btn btn-danger">Eliminar Plan</button>
        </form>
        <a href="alta_usuarios.php" class="btn btn-secondary mt-3">Volver a la lista de Usuarios</a>
    </div>
</body>

</html>
