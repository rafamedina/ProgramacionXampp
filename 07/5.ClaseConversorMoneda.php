<?php
/*
5. Clase "ConversorMoneda":
Crea una clase ConversorMoneda con métodos convertirDolaresAEuros() y convertirEurosADolares().
Utiliza un factor de conversión fijo para ambas operaciones.
Crea una instancia de la clase y realiza varias conversiones.
*/

class ConversorMoneda
{

    private $euros;
    private $dolares;

    public function seteuros($neweuros)
    {
        $this->euros = $neweuros;
    }
    public function geteuros()
    {
        return $this->euros;
    }
    public function setdolares($newdolares)
    {
        $this->dolares = $newdolares;
    }
    public function getdolares()
    {
        return $this->dolares;
    }

    public function ConvertirDolaresAEuros()
    {
        echo "la conversion de " . $this->dolares . " dolares a euros es de: " . $this->dolares * 0.97 . "€\n";
    }
    public function ConvertirEurosADolares()
    {
        echo "la conversion de " . $this->euros . " euros a dolares es de: " . $this->euros / 0.97 . "$\n";
    }
}

$conversor = new ConversorMoneda();
$conversor->seteuros(readline("Que cantidad de euros quieres cambiar a dolares: "));
$conversor->ConvertirEurosADolares();
$conversor->setdolares(readline("Que cantidad de dolares quieres cambiar a euros: "));
$conversor->ConvertirDolaresAEuros();
