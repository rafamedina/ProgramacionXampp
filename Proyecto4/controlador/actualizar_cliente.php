<?php
require_once("../modelo/tablas.php");  // Asegúrate de que el archivo 'tablas.php' esté correctamente incluido

$archivo = "datos/clientes.csv";  // Asegúrate de que la ruta sea correcta

// Recibir los datos del formulario
$id = $_POST['id'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$correo = $_POST['correo'] ?? null;
$telefono = $_POST['telefono'] ?? null;

// Depuración: Imprimir los datos recibidos
echo "ID: " . htmlspecialchars($id) . "<br>";
echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
echo "Correo: " . htmlspecialchars($correo) . "<br>";
echo "Teléfono: " . htmlspecialchars($telefono) . "<br>";

if ($id && $nombre && $correo && $telefono) {
    // Leer todos los clientes
    $clientes = [];
    if (($handle = fopen($archivo, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $clientes[] = $data;
        }
        fclose($handle);
    }

    // Modificar el cliente correspondiente
    foreach ($clientes as &$cliente) {
        if ($cliente[0] == $id) {
            $cliente[1] = $nombre;  // Modificar el nombre
            $cliente[2] = $correo;  // Modificar el correo
            $cliente[3] = $telefono; // Modificar el teléfono
            break; // Salir del bucle una vez encontrado el cliente
        }
    }

    // Sobrescribir el archivo CSV con los datos actualizados
    $handle = fopen($archivo, "w"); // Abrir el archivo en modo escritura
    foreach ($clientes as $cliente) {
        fputcsv($handle, $cliente); // Escribir cada cliente como una nueva línea
    }
    fclose($handle); // Cerrar el archivo

    // Redirigir de nuevo a la lista de clientes
    header("Location: ../index.php?opcion=clientes&subopcion=listar");
    exit;
} else {
    echo "Faltan datos para actualizar.";
}
