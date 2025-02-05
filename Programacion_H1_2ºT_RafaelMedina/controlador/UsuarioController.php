<?php
require_once '../modelo/class_usuario.php';

class UsuarioController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Usuario();
    }

    public function iniciarSesionUsuarios($correo, $password)
    {
        return $this->modelo->iniciarSesionUsuarios($correo, $password);
    }
    public function agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono, $contraseña)
    {
        return $this->modelo->agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono, $contraseña);
    }
    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad, $telefono, $contraseña)
    {
        $this->modelo->actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad, $telefono, $contraseña);
    }
    public function obtenerUsuarioporid($id_usuario)
    {
        return $this->modelo->obtenerUsuarioporid($id_usuario);
    }
    public function eliminarUsuario($id_usuario)
    {
        return $this->modelo->eliminarUsuario($id_usuario);
    }
    public function ResumenUsuario($usuario)
    {
        return $this->modelo->ResumenUsuario($usuario);
    }
    public function filtrado_usuario($usuario)
    {
        return $this->modelo->filtrado_usuario($usuario);
    }
    public function altaPlan($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {
        return $this->modelo->altaPlan($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3);
    }
    public function obtenerPlanes()
    {
        return $this->modelo->obtenerPlanes();
    }
    public function obtenerPaquetes()
    {
        return $this->modelo->obtenerPaquetes();
    }

    public function insertarPaquete($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {
        return $this->modelo->insertarPaquete($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3);
    }
    public function obtenerPlandelusuario($id_usuario)
    {
        return $this->modelo->obtenerPlandelusuario($id_usuario);
    }
    public function EliminarPlan($id_usuario){
        return $this->modelo->EliminarPlan($id_usuario);
    }
}
