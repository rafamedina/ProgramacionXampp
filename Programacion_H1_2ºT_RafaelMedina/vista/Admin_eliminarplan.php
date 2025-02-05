<?php

require_once '../controlador/AdminController.php'; // Importo el controlador de usuarios

$controller = new AdminController(); // Creo el objeto controlador

session_start(); // Inicio sesión para gestionar autenticación

// Verifico si el usuario está logueado como administrador
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ../index.php");  // Redirijo si no es admin
    exit();
}

// Obtengo el ID del usuario desde GET o POST
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    $usuario = $controller->obtenerUsuarioporid($id_usuario);
} else {
    echo "No se proporcionó un ID de usuario.";
}

if (!$id_usuario) { // Verifico que el ID sea válido
    echo "ID de usuario no válido o no proporcionado.";
    exit();
}

// Obtengo los datos completos del usuario
$usuario = $controller->obtenerUsuariosCompletosIndividual2($usuario["id_usuario"]);

// Si el formulario fue enviado, elimino el plan del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->eliminarplan($usuario["id_usuario"]); // Elimino el plan del usuario
    header("Location: Admin_alta_plan.php?id_usuario=" . $usuario["id_usuario"]); // Redirijo a la gestión de planes
    exit();
}

// Obtengo la información del plan del usuario para mostrarla
$planUsuario = $controller->obtenerUsuariosCompletosIndividual($usuario["id_usuario"]);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Cambiar Plan</h1>
        <h2>Atencion: Si cambias el plan tendras que volver a elegir Paquete</h2>
        <form method="POST">

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
        <a href="Admin_alta_usuarios.php" class="btn btn-secondary mt-3">Volver a la lista de Usuarios</a>
    </div>
</body>

</html>