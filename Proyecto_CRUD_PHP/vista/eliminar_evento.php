<?php
require_once '../controlador/EventosController.php';
$controller = new EventosController();

if (isset($_GET['id'])) {
    $id_evento = $_GET['id'];
    $evento = $controller->obtenerEventoPorId($id_evento);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->eliminarEvento($id_evento);
    header("Location: lista_eventos.php"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Eliminar Evento</h1>
        <p>¿Estás seguro de que deseas eliminar el evento: <strong><?= $evento['nombre_evento'] ?></strong>?</p>
        <form method="POST" action="">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="lista_eventos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>