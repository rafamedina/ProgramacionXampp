<?php
/**
Ejercicio 4: Adivina el Número
Objetivo: Crear un juego en el que la computadora genera un número aleatorio y el usuario debe adivinarlo.
Pasos:
Generar un número aleatorio utilizando la función rand().
Pedir al usuario que ingrese un número.
Utilizar un bucle while para repetir el proceso hasta que el usuario adivine el número.
Indicar si el número ingresado es mayor, menor o igual al número secreto.
*/

$numeroAleatorio = rand(1, 50);
$guess = readline("¿Qué número crees que es? ");

while ($numeroAleatorio != $guess) {
    if ($guess > $numeroAleatorio) {
        echo "El número que ingresaste es mayor que el número secreto\n";
    } else if ($guess < $numeroAleatorio) {
        echo "El número que ingresaste es menor que el número secreto\n";
    }
    $guess = readline("Intenta de nuevo: ");
}

echo "¡Felicidades! El número es correcto, era $numeroAleatorio. Bien hecho nene!\n";