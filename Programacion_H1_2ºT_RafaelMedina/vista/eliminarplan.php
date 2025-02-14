<?php

require_once '../controlador/UsuariosController.php'; // Importo el controlador de usuarios

$controller = new UsuarioController(); // Creo el objeto controlador

session_start(); // Inicio la sesión para gestionar la autenticación

// Verifico si el usuario está logueado como administrador
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php"); // Si no es admin, lo redirijo al login
    exit();
}

// Obtengo el ID del usuario desde GET o POST
$id_usuario = $_GET['id'] ?? $_POST['id_usuario'] ?? null;

if (!$id_usuario) { // Si el ID no es válido o no existe, muestro un error y detengo el script
    echo "ID de usuario no válido o no proporcionado.";
    exit();
}

// Obtengo los datos completos del usuario usando su ID
$usuario = $controller->obtenerUsuariosCompletosIndividual2($id_usuario);

// Si el formulario fue enviado, elimino el plan del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->eliminarplan($usuario["id_usuario"]); // Llamo al método para eliminar el plan del usuario
    header("Location: alta_usuarios.php"); // Redirijo a la página de gestión de usuarios
    exit();
}

// Obtengo la información del plan del usuario para mostrarlo en la interfaz
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