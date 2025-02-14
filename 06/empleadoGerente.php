<?php
/*
Herencia - Clase "Empleado" y "Gerente":
Crea una clase "Empleado" con propiedades nombre y sueldo.
Crea un método mostrarDetalles() que imprima los datos del empleado.
Crea una clase hija "Gerente" que añada la propiedad departamento y sobrescriba el método mostrarDetalles() para incluir el departamento.
Instancia un "Gerente" y un "Empleado" y muestra sus detalles.
*/

class Empleado
{
    private $nombre;
    private $sueldo;

    public function setnombre($nombre_ext)
    {
        $this->nombre = $nombre_ext;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function setsueldo($sueldo_ext)
    {
        $this->sueldo = $sueldo_ext;
    }
    public function getsueldo()
    {
        return $this->sueldo;
    }

    public function Mostrardetalles()
    {
        echo "El empleado " . $this->nombre . " cobra " . $this->sueldo . "\n";
    }
}


class Gerente extends Empleado
{
    private $departamento;
    public function setdepartamento($departamento_ext)
    {
        $this->departamento = $departamento_ext;
    }
    public function getdepartamento()
    {
        return $this->departamento;
    }

    public function Mostrardetalles()
    {
        echo "El empleado " . $this->getnombre() . " cobra " . $this->getsueldo() . " y pertenece a " . $this->departamento . "\n";
    }
}

$empleado = new Empleado();
$empleado->setnombre("Jose");
$empleado->setsueldo("1666€");
$empleado->Mostrardetalles();

$gerente = new Gerente();
$gerente->setnombre("Jose");
$gerente->setsueldo("1666€");
$gerente->setdepartamento("Marketing");
$gerente->Mostrardetalles();
