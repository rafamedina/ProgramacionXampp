<?php
session_start(); // Inicio la sesión
require_once '../controlador/UsuarioController.php'; // Incluyo el controlador de usuarios
$controller = new UsuarioController(); // Creo una instancia del controlador



// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['usuario'])) {
    echo "Sesión no iniciada o usuario no logueado.";
    session_destroy();
    header("Location: ../index.php");  // Si no está logueado, lo envío al login
    exit();
}
$idusuario = $_SESSION["usuario"]["id_usuario"];
$usuario = $controller->obtenerUsuarioporid($idusuario);

$idplanUsuario = $controller->obtenerPlandelusuario($idusuario);


if (!$idusuario) { // Si no encuentro el usuario, muestro un mensaje y corto la ejecución
    echo "Usuario no encontrado.";
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paquete1 = !empty($_POST['id_paquete1']) ? $_POST['id_paquete1'] : null;
    $id_paquete2 = !empty($_POST['id_paquete2']) ? $_POST['id_paquete2'] : null;
    $id_paquete3 = !empty($_POST['id_paquete3']) ? $_POST['id_paquete3'] : null;

    // Insertar paquetes en la base de datos
    $resultado = $controller->insertarPaquete($idplanUsuario["id_usuario"], $idplanUsuario["id_plan"], $id_paquete1, $id_paquete2, $id_paquete3);

    if (strpos($resultado, "Error") === 0) {
        $error_message = $resultado; // Captura el mensaje de error
    } else {
        // Redirigir manteniendo el ID
        header("Location: ../UsuarioMenu.php");
        exit(); // Asegúrate de terminar la ejecución inmediatamente
    }
}

$paquete = $controller->obtenerPaquetes(); // Obtener paquetes de la base de datos

$planUsuario = $controller->ResumenUsuario($usuario["id_usuario"]);
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
    </div>

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
                <?php foreach ($planUsuario as $lista): ?>
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