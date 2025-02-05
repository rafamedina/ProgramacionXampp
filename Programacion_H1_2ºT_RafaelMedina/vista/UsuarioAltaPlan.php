<?php
require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Creo una instancia del controlador

session_start(); // Inicio la sesión

// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: ../index.php");  // Si no está logueado, lo envío al login
    exit();
}
$idusuario = $_SESSION["usuario"]["id_usuario"];
$usuario = $controller->obtenerUsuarioporid($idusuario);


if (!$idusuario) { // Si no encuentro el usuario, muestro un mensaje y corto la ejecución
    echo "Usuario no encontrado.";
    exit();
}
$plan = $controller->obtenerPlanes();
// Compruebo si enviaron el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_plan = $_POST['id_plan']; // Guardo el ID del plan enviado en el formulario

    $controller->altaPlan($usuario["id_usuario"], $id_plan, NULL, NULL, NULL);
    $success_message = "Plan agregado con éxito.";

    // Redirijo a la página de alta de usuarios
    header("Location: UsuarioAltaPaquetes.php");
    exit();
} else {
    $error_message = "Error al agregar Plan."; // Si hay un problema, muestro un mensaje de error
}
$error_message = null;
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
        <h1 class="mt-4">Aquirir Plan</h1>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
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