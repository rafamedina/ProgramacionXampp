<?php
/*
Clase "Círculo":
Crea una clase "Círculo" con la propiedad radio.
Agrega un método calcularArea() que devuelva el área del círculo.
Crea un objeto de la clase y calcula el área de un círculo con radio 5.
*/

class Circulo
{

    private $radio;
    public function calcularArea()
    {
        echo $this->radio * $this->radio * 3.14;
    }
    public function setradio($radiocirculo)
    {
        $this->radio = $radiocirculo;
    }
    public function getradio()
    {
        return $this->radio;
    }
}


$circulito = new Circulo();
$circulito->setradio(45);
$circulito->calcularArea();
