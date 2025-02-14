<?php
/**
Ejercicio 2: Validación de Email
Escribe una función llamada validarEmail que reciba una dirección de correo electrónico como parámetro y:
Devuelva "Válido" si la dirección es válida.
Devuelva un mensaje de error si no lo es.
Registra los errores en un archivo errores.log.
Ejemplo de uso:
echo validarEmail("correo@ejemplo.com"); // Resultado: Válido
echo validarEmail("correo_invalido"); // Resultado: Error registrado en errores.log
*/
// OPCION 1
function validarEmail($correo) {
    if (preg_match('/@/', $correo)) {
        if (preg_match('/./', $correo)){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$correo = readline("Por favor introduce un correo: ");

$resultado = validarEmail($correo);

if ($resultado == True){echo "Correo Valido";}
else if ($resultado ==false){echo "Correo No Valido";}

// OPCION 2

function validarEmail2($correo) {
    // Verificar si el correo tiene un formato válido
    if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $correo)) {
        return true;
    } else {
        return false;
    }
}

$correo = readline("Por favor introduce un correo: ");

$resultado = validarEmail($correo);

if ($resultado==true) {
    echo "Correo válido\n";
} else {
    echo "Correo no válido\n";
}