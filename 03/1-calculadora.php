<?php
/**
Ejercicio 1: Calculadora con Manejo de Errores
Crea una función llamada calculadora que reciba tres parámetros: dos números y un operador (+, -, *, /).
La función debe realizar la operación indicada.
Si el operador es / y el divisor es 0, debe generar un mensaje de error personalizado.
Usa try-catch para manejar el error.
Ejemplo de uso:
echo calculadora(10, 0, '/'); // Resultado: Error: No se puede dividir entre cero.
*/

function calculadora($num1,$num2,$operador){
    $num1 = (float)$num1;
    $num2 = (float)$num2;
    switch($operador){
        case "+":
            return $num1 + $num2;
        case "-":
            return $num1 - $num2;
        case "*":
            return $num1 * $num2;
        case "/": 
            if ($num2 == 0){
                return "Error: No se puede dividir entre 0";
            } else  {return $num1 / $num2;}
        default: return "No es posible esta operacion";
    }

}

$num1 = readline("Cual es el primer numero: ");
$num2 = readline("Cual es el segundo numero: ");
$operador = readline(" + para sumar, - para restar, * para multiplicar, / para dividir: ");

$resultado = calculadora($num1,$num2,$operador);

echo "El resultado es " . $resultado;