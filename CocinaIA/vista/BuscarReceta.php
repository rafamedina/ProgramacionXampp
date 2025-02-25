<?php
require_once '../controlador/IAController.php';

$controller = new IAController();

$error_message = '';
$success_message = '';

$nombre = $descripcion = $ingredientes = $preparacion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prompt'])) {
    $prompt = $_POST['prompt'] ?? '';

    if (!empty($prompt)) {
        $nombre = $prompt;
        $existe = $controller->obtenerRecetaPorNombre($nombre);

        if (!empty($existe) && is_array($existe) && isset($existe[0])) {
            // Si la receta ya está en la base de datos, cargamos sus valores
            $descripcion = $existe[0]['descripcion'] ?? 'Descripción no disponible';
            $ingredientes = $existe[0]['ingredientes'] ?? 'Ingredientes no disponibles';
            $preparacion = $existe[0]['preparacion'] ?? 'Preparación no disponible';
            $success_message = 'La receta se ha encontrado en la base de datos.';
        } else {
            // Si no existe, generamos la receta con la API
            $ingredientes = $controller->PedirIngredientes($prompt);
            $preparacion = $controller->PedirDesarrollo($prompt);
            $descripcion = $controller->PedirResumen($prompt);

            if (!$ingredientes) $error_message = 'No se pudieron obtener los ingredientes.';
            if (!$preparacion) $error_message = 'No se pudo obtener la preparación.';
            if (!$descripcion) $error_message = 'No se pudo obtener la descripción.';
        }
    } else {
        $error_message = 'No se encontró un prompt.';
    }
}

// Guardar la receta en la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'guardar') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $ingredientes = $_POST['ingredientes'] ?? '';
    $preparacion = $_POST['preparacion'] ?? '';

    if (!empty($nombre) && !empty($descripcion) && !empty($ingredientes) && !empty($preparacion)) {
        if ($controller->GuardarReceta($nombre, $descripcion, $preparacion, $ingredientes)) {
            $success_message = "¡Receta guardada con éxito!";
            $prompt = $nombre;
        } else {
            $error_message = "Error al guardar la receta";
        }
    } else {
        $error_message = "Faltan datos necesarios para guardar la receta";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Receta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        textarea {
            width: 100%;
            min-height: 50px;
            resize: none;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <h1 class="mt-4 text-center">Buscar Receta</h1>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-warning">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success_message) ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="" class="mt-4 p-4 bg-white rounded shadow-sm">
                    <div class="form-group mb-3">
                        <label for="prompt" class="form-label">¿Qué receta buscas?</label>
                        <input type="text" class="form-control" id="prompt" name="prompt" placeholder="Ej: Receta de paella valenciana" required value="<?= htmlspecialchars($prompt ?? '') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </form>

                <?php if (!empty($nombre)): ?>
                    <form method="POST" action="" class="mt-4 p-4 bg-white rounded shadow-sm">
                        <input type="hidden" name="action" value="guardar">
                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label">Nombre de la receta</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control auto-expand" id="descripcion" name="descripcion" rows="3" required><?= htmlspecialchars($descripcion) ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ingredientes" class="form-label">Ingredientes</label>
                            <textarea class="form-control auto-expand" id="ingredientes" name="ingredientes" rows="4" required><?= htmlspecialchars($ingredientes) ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="preparacion" class="form-label">Preparación</label>
                            <textarea class="form-control auto-expand" id="preparacion" name="preparacion" rows="5" required><?= htmlspecialchars($preparacion) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Guardar Receta</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("textarea").forEach(textarea => {
                autoExpand(textarea);
            });
        });

        document.addEventListener("input", function(event) {
            if (event.target.tagName.toLowerCase() === "textarea") {
                autoExpand(event.target);
            }
        });

        function autoExpand(textarea) {
            textarea.style.height = "auto";
            textarea.style.height = textarea.scrollHeight + "px";
        }
    </script>
</body>

</html>