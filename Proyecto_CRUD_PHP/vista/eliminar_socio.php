<?php
require_once '../controlador/SociosController.php';

$sociosController = new SociosController();

if (isset($_GET['id'])) {
    $id_socio = $_GET['id'];
    $socio = $sociosController->obtenerSocioPorId($id_socio);


    if (!$socio) {
        echo "Socio no encontrado.";
        exit();
    }
} else {
    header("Location: lista_socios.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_socio = $_POST['id'];
    $sociosController->eliminarSocio($id_socio);
    header("Location: lista_socios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Socio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Eliminar Socio</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text" name="id" class="form-control" value="<?php echo htmlspecialchars($socio['id_socio']); ?>" required>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar Socio</button>
        </form>
        <a href="lista_socios.php" class="btn btn-secondary mt-3">Volver a la lista de socios</a>
    </div>
</body>

</html>