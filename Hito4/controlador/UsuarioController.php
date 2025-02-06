<?php
require_once '../modelo/class_usuario.php';

class UsuarioController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Usuario();
    }
    public function agregarUsuario($nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        return $this->modelo->agregarUsuario($nombre, $apellidos, $correo, $telefono, $contraseña);
    }
    public function iniciarSesionUsuarios($correo, $password)
    {
        return $this->modelo->iniciarSesionUsuarios($correo, $password);
    }
    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $telefono, $contraseña)
    {
        $this->modelo->actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $telefono, $contraseña);
}
}