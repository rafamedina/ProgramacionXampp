<?php

/**Configura un manejador de errores personalizado que guarde los errores en un archivo errores.log. 
ini_set('log_errors', 1);
ini_set('error_log', 'errores.log');
error_log("Esto es un mensaje de error personalizado.");

Escribe un programa que capture la excepción al intentar dividir un número entre cero 

function manejadorErrores($nivel, $mensaje, $archivo, $linea) {
    echo "Ocurrió un error [Nivel: $nivel] en $archivo en la línea $linea: $mensaje<br>";
    // Registrar el error en un archivo
    error_log("Error: $mensaje en $archivo:$linea", 3, "errores.log");
}

set_error_handler("manejadorErrores");

// Forzar un error para probar
echo $variableInexistente;*/
/** 
Crea un script que registre un mensaje de error en un archivo de log cuando falle una operación de lectura de un archivo. */


// Configura un manejador de errores personalizado
ini_set('log_errors', 1);
ini_set('error_log', 'errores.log');

$nombreArchivo = 'archivo_inexistente.txt';

try {
    if (!file_exists($nombreArchivo)) {
        throw new Exception("El archivo '$nombreArchivo' no existe.");
    }
    $contenido = file_get_contents($nombreArchivo);
    echo $contenido;
} catch (Exception $e) {
    echo "Ocurrió un error: " . $e->getMessage() . "<br>";
    error_log("Error: " . $e->getMessage(), 3, "errores.log");
}


