<?php
/*
Clase "Calculadora":
Crea una clase "Calculadora" con métodos sumar(), restar(), multiplicar() y dividir().
Agrega validaciones para evitar la división por cero.
Crea una instancia de la clase y realiza varias operaciones matemáticas.
*/

class Calculadora
{
    private $numero1;
    private $numero2;

    public function setnumero1($numero1_ext)
    {
        $this->numero1 = $numero1_ext;
    }
    public function setnumero2($numero2_ext)
    {
        $this->numero2 = $numero2_ext;
    }

    public function sumar()
    {
        echo $this->numero1 + $this->numero2 . "\n";
    }
    public function restar()
    {
        echo $this->numero1 - $this->numero2 . "\n";
    }
    public function multiplicar()
    {
        echo $this->numero1 * $this->numero2 . "\n";
    }
    public function dividir()
    {
        if ($this->numero2 !== 0) {
            if ($this->numero1 !== 0) {
                echo $this->numero1 / $this->numero2 . "\n";
            } else echo "El 0 no es un numero valido";
        } else echo "No se puede por 0";
    }
}
$numero = new Calculadora();
$numero->setnumero1(readline("Dime el primer numero: "));
$numero->setnumero2(readline("Dime el segundo numero: "));
$numero->sumar();
$numero->restar();
$numero->multiplicar();
$numero->dividir();
