<?php
require_once '../modelo/class_usuario.php';

class UsuarioController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Usuario();
    }

    public function agregarAdmin($idadmin, $nombre, $apellidos, $correo, $contraseña)
    {
        return $this->modelo->agregarAdmin($idadmin, $nombre, $apellidos, $correo, $contraseña);
    }

    public function agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono)
    {
        return $this->modelo->agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono);
    }

    public function obtenerUsuario()
    {
        return $this->modelo->obtenerUsuario();
    }
    public function obtenerAdmin(){
        return $this->modelo->obtenerAdmin();
    }

    public function obtenerUsuarioporid($id_usuario)
    {
        return $this->modelo->obtenerUsuarioporid($id_usuario);
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad, $telefono)
    {
        $this->modelo->actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad, $telefono);
    }

    public function eliminarUsuario($id_usuario)
    {
        $this->modelo->eliminarUsuario($id_usuario);
    }
    public function eliminarAdmin($correo)
    {
        $this->modelo->eliminarAdmin($correo);
    }
    public function iniciarSesion($correo, $contraseña)
    {
        return $this->modelo->iniciarSesion($correo, $contraseña);
    }

    public function filtrado_usuario($usuario)
    {
        return $this->modelo->filtrado_usuario($usuario);
    }

    public function obtenerUsuariosCompletos()
    {
        return $this->modelo->obtenerUsuariosCompletos();
    }

    public function obtenerUsuariosCompletosIndividual($id_usuario)
    {
        return $this->modelo->obtenerUsuariosCompletosIndividual($id_usuario);
    }

    /////// PLANES

    public function altaPlan($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {
        return $this->modelo->altaPlan($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3);
    }

    public function ObtenerPlanes()
    {
        return $this->modelo->obtenerPlanes();
    }

    public function cantidadPlanes($usuario)
    {
        return $this->modelo->cantidadPlanes($usuario);
    }

    public function obtenerPlan($id_plan)
    {
        return $this->modelo->obtenerPlan($id_plan);
    }

    public function obtenerUsuariosCompletosIndividual2($usuario)
    {
        return $this->modelo->obtenerUsuariosCompletosIndividual2($usuario);
    }

    public function EliminarPlan($id_usuario)
    {
        return $this->modelo->EliminarPlan($id_usuario);
    }

    ////PAQUETES

    public function obtenerPaquetes()
    {
        return $this->modelo->obtenerPaquetes();
    }

    public function insertarPaquete($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {
        return $this->modelo->insertarPaquete($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3);
    }
}
