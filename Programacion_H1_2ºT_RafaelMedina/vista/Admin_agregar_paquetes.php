<?php
require_once '../controlador/AdminController.php';
session_start();

// Verifico si el administrador está logueado
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

$controller = new AdminController();
$paquete = $controller->obtenerPaquetes();

$error_message = '';
$succes_message = '';
$admin = $_SESSION['admin'];

// Obtengo el ID del usuario
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
} else {
    echo "No se proporcionó un ID de usuario.";
}

$usuario = $controller->obtenerUsuariosCompletosIndividual2($id_usuario);
if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}

// Si se envió el formulario, obtengo los paquetes seleccionados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paquete1 = !empty($_POST['id_paquete1']) ? $_POST['id_paquete1'] : null;
    $id_paquete2 = !empty($_POST['id_paquete2']) ? $_POST['id_paquete2'] : null;
    $id_paquete3 = !empty($_POST['id_paquete3']) ? $_POST['id_paquete3'] : null;

    // Inserto los paquetes en la base de datos
    $resultado = $controller->insertarPaquete($usuario["id_usuario"], $usuario["id_plan"], $id_paquete1, $id_paquete2, $id_paquete3);

    // Si hay error, lo almaceno, si no, redirijo
    if (strpos($resultado, "Error") === 0) {
        $error_message = $resultado;
    } else {
        header("Location: Admin_listar_usuarios.php");
        exit();
    }
}
?>



$planUsuario = $controller->obtenerUsuariosCompletosIndividual($usuario["id_usuario"]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-alert-palevioletred {
            color: #fff;
            background-color: sandybrown;
            border-color: sandybrown;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
    </style>
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
            <div class="alert custom-alert-palevioletred">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
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
    </div>
</body>

</html>