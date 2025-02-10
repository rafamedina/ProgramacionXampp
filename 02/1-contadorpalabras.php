<?php
/** 
Ejercicio 1: Contador de Palabras
Enunciado: Crea un programa que cuente el número de palabras en una cadena de texto ingresada por el usuario.
Objetivo: Practicar el manejo de cadenas y el uso de bucles para iterar sobre los caracteres.
Pasos:
Pedir al usuario que ingrese una frase.
Inicializar un contador de palabras en 0.
Recorrer cada carácter de la frase.
Si el carácter es un espacio, incrementar el contador de palabras.
Al finalizar, sumar 1 al contador de palabras (para contar la última palabra).
Imprimir el número total de palabras.
*/

$frase = readline("Ingrese una frase: ");
$palabras = 0;
for ($i = 0; $i < strlen($frase); $i++) {
    if ($frase[$i] == ' ') {
        $palabras++;
        }
        }
        $palabras++;
        echo "El número de palabras en la frase es: $palabras\n";
        