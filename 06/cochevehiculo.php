<?php
/*
Herencia - Clase "Vehículo" y "Coche":
Crea una clase "Vehículo" con la propiedad marca y un método encender().
Crea una clase hija "Coche" que herede de "Vehículo" y agregue la propiedad modelo.
Instancia un objeto "Coche" y prueba ambos métodos y propiedades.
*/

class Vehiculo
{
    private $marca;

    public function setmarca($marcanueva)
    {
        $this->marca = $marcanueva;
    }
    public function getmarca()
    {
        return $this->marca;
    }

    public function encender()
    {
        echo "El coche" . $this->marca .  "empieza a hacer brum brum";
    }
}
class Coche extends Vehiculo
{
    private $modelo;
    public function setmodelo($modelonuevo)
    {
        $this->modelo = $modelonuevo;
    }
    public function getmodelo()
    {
        return $this->modelo;
    }
    public function encender()
    {

        echo "El coche " . $this->getmarca() . " " . $this->modelo . " empieza a hacer brum brum";
    }
}
$cocheamazing = new Coche();
$cocheamazing->setmarca("BMW");
$cocheamazing->setmodelo("M3");
$cocheamazing->encender();
