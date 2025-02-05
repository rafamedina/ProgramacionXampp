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

// Obtengo la información del plan del usuario para mostrarlo en la interfaz
$lista = $controller->ResumenUsuario($usuario["id_usuario"]);

// Si el formulario fue enviado, elimino el plan del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->eliminarplan($usuario["id_usuario"]); // Llamo al método para eliminar el plan del usuario
    header("Location: UsuarioAltaPlan.php"); // Redirijo a la página de gestión de usuarios
    exit();
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cambiar Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                        <th>ID Resumen</th>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>edad</th>
                        <th>Telefono</th>
                        <th>Plan Obtenido</th>
                        <th>Precio Plan</th>
                        <th>Paquetes Obtenidos</th>
                        <th>Precio Paquetes</th>
                        <th>Dispositivos</th>
                        <th>Cuota</th>
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
                            <td><?= $lista['precio_plan'] ?></td>
                            <td><?= $lista['Paquetes_Obtenidos'] ?></td>
                            <td><?= $lista['precio_paquete'] ?></td>
                            <td><?= $lista['dispositivos'] ?></td>
                            <td><?= $lista['Cuota'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <h3>Atencion! no hay vuelta atras.</h3>
            <button type="submit" class="btn btn-danger">Cambiar Plan</button>
        </form>
        <a href="../UsuarioMenu.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>

</html>