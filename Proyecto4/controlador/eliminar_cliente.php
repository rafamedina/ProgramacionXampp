<?php
require_once("../modelo/tablas.php");

// Obtener datos del formulario
$id = $_POST['id'] ?? null;
$archivo = "../datos/clientes.csv";

if ($id !== null) {
    // Leer todos los clientes como arreglo
    $clientes = [];
    if (($handle = fopen($archivo, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $clientes[] = $data;
        }
        fclose($handle);
    }

    // Filtrar el cliente a eliminar por ID
    $clientesFiltrados = [];
    foreach ($clientes as $cliente) {
        if ($cliente[0] != $id) { // Si el ID no coincide, agregar al nuevo arreglo
            $clientesFiltrados[] = $cliente;
        }
    }

    // Sobrescribir el archivo CSV con los clientes restantes
    $handle = fopen($archivo, "w");
    foreach ($clientesFiltrados as $cliente) {
        fputcsv($handle, $cliente);
    }
    fclose($handle);

    // Redirigir después de eliminar
    header("Location: ../index.php?opcion=clientes&subopcion=listar");
    exit;
} else {
    echo "No se ha proporcionado un ID válido para eliminar.";
}
