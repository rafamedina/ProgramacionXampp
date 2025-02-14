<?php
require_once '../controlador/PlanController.php';
session_start();

// Verificar si el usuario está logueado, de lo contrario redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciosesion_usuarios.php"); // Redirige al login si no está logueado
    exit();
}
$usuario = $_SESSION['usuario'];
$controller = new Plan();


$plan = $controller->ObtenerPlanes();

$plan2 = $controller->listarPlanesUsuario($usuario["id_usuario"]);
$error_message = '';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_plan = $_POST['id_plan'];

    $controller->cambiarPlanUsuario($id_plan, $usuario["id_usuario"]);
    header("Location: editarplanes.php");
}







?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Seleccionar Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    </div>
    <div class="container">
        <h1 class="mt-4">Mi plan</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Mi plan</th>
                    <th>Dispositivos</th>
                    <th>Precio</th>
                    <th>Duración</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plan2 as $plan2): ?>
                    <tr>
                        <td><?= htmlspecialchars($plan2['nombre_usuario']) ?></td>
                        <td><?= htmlspecialchars($plan2['planes_en_propiedad']) ?></td>
                        <td><?= htmlspecialchars($plan2['dispositivos']) ?></td>
                        <td><?= htmlspecialchars($plan2['precio']) ?></td>
                        <td><?= htmlspecialchars($plan2['duracion_suscripcion']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>




    <div class="container">
        <h1 class="mt-4">Cambiar Mi Plan</h1>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">


            <div class="form-group">
                <label for="id_plan">Plan Nuevo</label>
                <input type="text" class="form-control" id="id_plan" name="id_plan" required>
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Cambiar Plan</button>

            <br>
            <br>
            <button><a href="../index3.php" class="list-group-item list-group-item-action">Volver al menú</a></button>
        </form>
    </div>




</body>

</html>