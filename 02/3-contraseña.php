<?php
/** 
Ejercicio 3: Validación de Contraseña
Enunciado: Crea un programa que valide si una contraseña cumple con ciertos criterios.
Objetivo: Practicar el uso de expresiones regulares y condicionales para validar datos de entrada.
Pasos:
Pedir al usuario que ingrese una contraseña.
Verificar si la contraseña tiene al menos 8 caracteres.
Verificar si la contraseña contiene al menos una letra mayúscula, una minúscula y un número.
Utilizar expresiones regulares para realizar estas verificaciones.
Si la contraseña cumple con todos los criterios, mostrar un mensaje de éxito.
*/



function verificarContrasena($contraseña) {
    if (strlen($contraseña) >= 8) {
        // Verificar si contiene al menos una letra mayúscula
        $tieneMayuscula = preg_match('/[A-Z]/', $contraseña);
        
        // Verificar si contiene al menos una letra minúscula
        $tieneMinuscula = preg_match('/[a-z]/', $contraseña);
        
        // Verificar si contiene al menos un número
        $tieneNumero = preg_match('/[0-9]/', $contraseña);
        
        // Comprobar si cumple todas las condiciones
        if ($tieneMayuscula && $tieneMinuscula && $tieneNumero) {
            return true; // Contraseña válida
        }
    }
    return false; // Contraseña no válida
}

// Leer la contraseña del usuario
$contraseña = readline("Ingrese su contraseña: ");

// Llamar a la función y validar
if (verificarContrasena($contraseña)) {
    echo "Contraseña válida";
} else {
    echo "Contraseña no válida";
}

