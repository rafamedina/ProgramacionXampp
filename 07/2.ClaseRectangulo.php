<?php
/*
2. Clase "Rectángulo":
Crea una clase Rectángulo con las propiedades base y altura.
Agrega un método calcularArea() que devuelva el área del rectángulo.
Crea un objeto de la clase y calcula el área de un rectángulo con base = 10 y altura = 5.
*/

class Rectangulo
{

    public $base = 10;
    public $altura = 5;

    public function calcularArea()
    {
        $area = $this->base * $this->altura;
        echo "La base del rectangulo es $area";
    }
}

$rectangulo = new Rectangulo();
$rectangulo->calcularArea();
