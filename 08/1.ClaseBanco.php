<?php
/*
1. Clase "Banco":
Crea una clase CuentaBancaria con las propiedades titular, saldo y tipoDeCuenta.
Agrega los métodos:
depositar($cantidad): Incrementa el saldo en la cantidad especificada.
retirar($cantidad): Reduce el saldo si la cantidad es menor o igual al saldo disponible.
mostrarInfo(): Muestra los datos del titular, el tipo de cuenta y el saldo actual.
Crea una instancia de CuentaBancaria, realiza varias operaciones y muestra la información final.
*/

class Banco
{
    private $titular;
    private $saldo;
    private $tipoDeCuenta;

    public function settitular($newtitular)
    {
        $this->titular = $newtitular;
    }
    public function gettitular()
    {
        return $this->titular;
    }
    public function setsaldo($newsaldo)
    {
        $this->saldo = $newsaldo;
    }
    public function getsaldo()
    {
        return $this->saldo;
    }
    public function settipoDeCuenta($newtipoDeCuenta)
    {
        $this->tipoDeCuenta = $newtipoDeCuenta;
    }
    public function gettipoDeCuenta()
    {
        return $this->tipoDeCuenta;
    }
    public function DepositarCanitdad($cantidad)
    {
        echo "Tu saldo es de " . $this->saldo . "€\n";
        $this->saldo += $cantidad;
        echo "tu saldo nuevo es de " . $this->saldo . "\n";
    }
    public function retirar($cantidad)
    {
        echo "Tu saldo es de " . $this->saldo . "€\n";
        if ($cantidad <= $this->saldo) {
            $this->saldo -= $cantidad;
            echo "tu saldo nuevo es de " . $this->saldo . "\n";
        } else echo "No tienes tanto dinero\n";
    }
    public function mostrarInfo()
    {
        echo "El nombre del titular es: " . $this->titular . "\n";
        echo "El saldo de la cuenta es: " . $this->saldo . "\n";
        echo "El tipo de cuenta es: " . $this->tipoDeCuenta . "\n";
    }
}
$CuentaBancaria = new Banco();
$CuentaBancaria->settitular("Rafa");
$CuentaBancaria->setsaldo(15000);
$CuentaBancaria->settipoDeCuenta("Credito al 5% Anual");
$CuentaBancaria->mostrarInfo();
$CuentaBancaria->DepositarCanitdad(1000);
$CuentaBancaria->retirar(18000);
$CuentaBancaria->retirar(2000);
$CuentaBancaria->mostrarInfo();
