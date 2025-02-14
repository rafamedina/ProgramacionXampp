<?php
require_once '../controlador/UsuariosController.php';
session_start();

// Verificar si el usuario está logueado, de lo contrario redirigir al login
if (!isset($_SESSION['admin'])) {
    header("Location: iniciosesion_usuarios.php"); // Redirige al login si no está logueado
    exit();
}

$controller = new UsuarioController();
$paquete = $controller->obtenerPaquetes();

$error_message = '';
$succes_message = '';
$admin = $_SESSION['admin'];

// Obtener ID del usuario desde GET o POST
$id_usuario = $_GET['id'] ?? $_POST['id_usuario'] ?? null;

if (!$id_usuario) {
    echo "ID de usuario no válido o no proporcionado.";
    exit();
}

$usuario = $controller->obtenerUsuariosCompletosIndividual2($id_usuario);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paquete1 = !empty($_POST['id_paquete1']) ? $_POST['id_paquete1'] : null;
    $id_paquete2 = !empty($_POST['id_paquete2']) ? $_POST['id_paquete2'] : null;
    $id_paquete3 = !empty($_POST['id_paquete3']) ? $_POST['id_paquete3'] : null;

    // Insertar paquetes en la base de datos


    $resultado = $controller->insertarPaquete($id_usuario, $usuario["id_plan"], $id_paquete1, $id_paquete2, $id_paquete3);

    if ($resultado !== true) {
        $error_message = $resultado; // Captura el mensaje de error
    } else {
        // Redirigir manteniendo el ID
        $succes_message = $resultado;
        header("Location: agregar_paquetes.php?id=" . $id_usuario);
        exit();
    }
}

$planUsuario = $controller->obtenerUsuariosCompletosIndividual($usuario["id_usuario"]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Paquetes Disponibles</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Condiciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paquete as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id_paquete']) ?></td>
                        <td><?= htmlspecialchars($p['nombre']) ?></td>
                        <td><?= htmlspecialchars($p['precio']) ?></td>
                        <td><?= htmlspecialchars($p['descripcion']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../index2.php" class="btn btn-secondary">Volver al menú</a>
    </div>

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

    <div class="container mt-5">
        <h2>Añadir Paquete</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"> <?= htmlspecialchars($error_message) ?> </div>
        <?php endif; ?>
        <?php if (!empty($succes_message)): ?>
            <div class="alert alert-succes"> <?= htmlspecialchars($succes_message) ?> </div>
        <?php endif; ?>
        <form method="POST" action="agregar_paquetes.php">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id_usuario) ?>">
            <div class="mb-3">
                <label for="id_paquete1" class="form-label">Paquete 1</label>
                <input type="number" class="form-control" id="id_paquete1" name="id_paquete1" required>
            </div>
            <div class="mb-3">
                <label for="id_paquete2" class="form-label">Paquete 2</label>
                <input type="number" class="form-control" id="id_paquete2" name="id_paquete2">
            </div>
            <div class="mb-3">
                <label for="id_paquete3" class="form-label">Paquete 3</label>
                <input type="number" class="form-control" id="id_paquete3" name="id_paquete3">
            </div>
            <button type="submit" class="btn btn-primary">Contratar</button>
        </form>
        <button><a href="alta_plan.php" class="list-group-item list-group-item-action">Volver</a></button>
    </div>
</body>

</html>