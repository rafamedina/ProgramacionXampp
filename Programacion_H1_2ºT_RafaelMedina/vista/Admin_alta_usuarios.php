<?php
require_once '../controlador/AdminController.php'; // Incluyo el controlador de usuarios
session_start(); // Inicio la sesión

// Verifico si el usuario está logueado como admin
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: ../index.php");  // Si no está logueado, lo envío al login
    exit();
}

$controller = new AdminController(); // Creo una instancia del controlador
$error_message = ''; // Defino una variable para manejar posibles errores

// Compruebo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero los datos enviados desde el formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['password'];

    // Intento agregar un nuevo usuario con los datos proporcionados
    $usuario = $controller->agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono, $contraseña);

    if (!$usuario) { // Si falla, guardo un mensaje de error
        $error_message = "Error al agregar Usuario. Por favor, verifica los datos.";
    } else { // Si se agrega correctamente, guardo el mensaje de éxito y redirijo a otra página
        $success_message = "Usuario agregado con éxito.";
        header("location: Admin_alta_usuarios.php"); // Redirijo a la página de alta de usuarios
        exit();
    }
}

// Obtengo la lista de usuarios existentes
$lista = $controller->obtenerUsuario();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Agregar Usuario</h1>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellidos:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" class="form-control" id="edad" name="edad" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <br>
        <br>
        <button><a href="../indexAdmin2.php" class="list-group-item list-group-item-action">Volver al menú</a></button>
    </div>

    <div class="container">
        <h1 class="mt-4">Usuarios Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>edad</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $lista): ?>
                    <tr>
                        <td><?= $lista['id_usuario'] ?></td>
                        <td><?= $lista['nombre'] ?></td>
                        <td><?= $lista['apellidos'] ?></td>
                        <td><?= $lista['correo'] ?></td>
                        <td><?= $lista['edad'] ?></td>
                        <td><?= $lista['telefono'] ?></td>
                        <td>
                            <a href="Admin_editar_usuarios.php?id_usuario=<?= $lista['id_usuario'] ?>" class="btn btn-warning">Editar</a>
                            <a href="Admin_alta_plan.php?id_usuario=<?= $lista['id_usuario'] ?>" class="btn btn-info">Añadir Plan</a>
                            <a href="Admin_eliminar_usuarios.php?id_usuario=<?= $lista['id_usuario'] ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>
</body>

</html>