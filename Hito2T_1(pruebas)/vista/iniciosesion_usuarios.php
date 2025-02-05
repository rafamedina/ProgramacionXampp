<?php
session_start(); 
require_once '../controlador/UsuariosController.php';
$controller = new UsuarioController();
$error_message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $usuario = $controller->iniciarSesion($correo, $contraseña);
    if (!$usuario) {
        $error_message = "Datos equivocados, prueba de nuevo.";
    } else {
        $_SESSION['usuario'] = $usuario;
        $success_message = "Usuario reconocido con éxito.";

        if (!empty($controller->filtrado_usuario($usuario['id_usuario']))) {
            header("location: ../index3.php");
        } else {
            header("location: ../index2.php");
        }
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">INICIAR SESION</h1>

        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="" class="mt-4">
            <div class="form-group">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
            
        </form>
    </div>
</body>

</html>
