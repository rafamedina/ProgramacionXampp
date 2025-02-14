<?php
/*
Crea una clase Empleado con las propiedades nombre, sueldo y aniosExperiencia.
Agrega los métodos:
calcularBonus(): Devuelve un bonus del 5% del sueldo por cada 2 años de experiencia.
mostrarDetalles(): Imprime los detalles del empleado.
Crea una clase hija Consultor que agregue la propiedad horasPorProyecto y sobrescriba el método calcularBonus() para sumar un bonus adicional si trabaja más de 100 horas por proyecto.
Instancia un Empleado y un Consultor y compara sus bonificaciones.
*/
class Empleado
{
    private $nombre;
    private $sueldo;
    private $aniosExperiencia;

    public function setnombre($newnombre)
    {
        $this->nombre = $newnombre;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function setsueldo($newsueldo)
    {
        $this->sueldo = $newsueldo;
    }
    public function getsueldo()
    {
        return $this->sueldo;
    }
    public function setaniosExperiencia($newaniosExperiencia)
    {
        $this->aniosExperiencia = $newaniosExperiencia;
    }
    public function getaniosExperiencia()
    {
        return $this->aniosExperiencia;
    }
    public function calcularBonus()
    {
        echo "El bonus que tienes es de: " . $this->sueldo * 0, 05 * ($this->aniosExperiencia / 2) . "€\n";
    }
    public function mostrarDetalles()
    {
        echo "El nombre del empleado es: " . $this->nombre . "\n";
        echo "el sueldo del empleado es de: " . $this->sueldo . "€\n";
        echo "El empleado " . $this->nombre . " tiene una antigüedad de: " . $this->aniosExperiencia . " años\n";
    }
}

class Consultor extends Empleado
{

    private $HoraPorProyecto;
    public function setHoraPorProyecto($NewHoraPorProyecto)
    {
        $this->HoraPorProyecto = $NewHoraPorProyecto;
    }
    public function getHoraPorProyecto()
    {
        return $this->HoraPorProyecto;
    }

    public function calcularBonus()
    {
        if ($this->HoraPorProyecto > 100) {
            echo "El bonus que tienes es de: " . $this->getsueldo() * 0, 10 * ($this->getaniosExperiencia() / 2) . "€\n";
        } else echo "El bonus que tienes es de: " . $this->getsueldo() * 0, 05 * ($this->getaniosExperiencia() / 2) . "€\n";
    }
}

$empleado = new empleado();
$empleado->setnombre("iker");
$empleado->setsueldo(1200);
$empleado->setaniosExperiencia(2);
$empleado->mostrarDetalles();
$empleado->calcularBonus();


$consultor = new Consultor();
$consultor->setnombre("Rafa");
$consultor->setsueldo(3500);
$consultor->setaniosExperiencia(15);
$consultor->setHoraPorProyecto(120);
$consultor->mostrarDetalles();
$consultor->calcularBonus();
