<?php
require_once '../controlador/UsuariosController.php';
session_start();

// Verificar si el usuario está logueado, de lo contrario redirigir al login
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php"); // Redirige al login si no está logueado
    exit();
}

$controller = new UsuarioController();
$plan = $controller->ObtenerPlanes();

$error_message = '';

$admin = $_SESSION['admin'];

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    error_log("ID de usuario recibido: " . $id_usuario);
    $usuario = $controller->obtenerUsuarioporid($id_usuario);

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit();
    } else {
        error_log("Usuario encontrado: " . print_r($usuario, true));
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}

$planUsuario = $controller->obtenerUsuariosCompletosIndividual($usuario["id_usuario"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_plan = $_POST['id_plan'];

    if ($controller->cantidadPlanes($usuario["id_usuario"])) {
        $controller->altaPlan($usuario["id_usuario"], $id_plan, NULL, NULL, NULL);
        $success_message = "Plan agregado con éxito.";
        header("Location: alta_usuarios.php");
        exit();
    } else {
        $error_message = "Error al agregar Plan.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Seleccionar Plan</title>
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
        <h1 class="mt-4">Planes</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Numero del Plan</th>
                    <th>Nombre</th>
                    <th>Dispositivos</th>
                    <th>Precio</th>
                    <th>Duración Suscripción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plan as $plan): ?>
                    <tr>
                        <td><?= htmlspecialchars($plan['id_plan']) ?></td>
                        <td><?= htmlspecialchars($plan['nombre']) ?></td>
                        <td><?= htmlspecialchars($plan['dispositivos']) ?></td>
                        <td><?= htmlspecialchars($plan['precio']) ?></td>
                        <td><?= htmlspecialchars($plan['duracion_suscripcion']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button><a href="../index2.php" class="list-group-item list-group-item-action">Volver al menú</a></button>
    </div>
    <div class="container">
        <h1 class="mt-4">Plan Actual</h1>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($planUsuario as $planUsuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($planUsuario['id_resumen']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['apellidos']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['correo']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['edad']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['telefono']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['Plan_Obtenido']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['Paquetes_Obtenidos']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['dispositivos']) ?></td>
                        <td><?= htmlspecialchars($planUsuario['Cuota']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="container">
        <h1 class="mt-4">Aquirir Plan</h1>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="id_plan">Numero del Plan</label>
                <input type="number" class="form-control" id="id_plan" name="id_plan" required>
            </div>

            <button type="submit" class="btn btn-primary">Darme de alta</button>
        </form>
    </div>
</body>

</html>
