<?php
require_once("modelo/tablas.php");

// Leer encabezado y pie
$encabezado = file_get_contents("vistas/encabezado.html");
$pie = file_get_contents("vistas/pie.html");

// Determinar la opción seleccionada
$opcion = $_GET['opcion'] ?? 'clientes';

// Generar contenido según la opción
if ($opcion === 'clientes') {
    $contenido = generarTabla("datos/clientes.csv", "cliente");
} elseif ($opcion === 'articulos') {
    $contenido = generarTabla("datos/articulos.csv", "articulo");
} elseif ($opcion === 'proveedores') {
    $contenido = generarTabla("datos/proveedores.csv", "proveedores");
} else {
    $contenido = "<p>Opción no válida</p>";
}

// Renderizar la página
echo $encabezado . $contenido . $pie;
