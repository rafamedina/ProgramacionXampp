<?php
require_once '../modelo/class_plan.php';

class PlanController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Plan();
    }

    public function altaPlan($id_usuario, $id_plan, $id_paquete)
    {
        return $this->modelo->altaPlan($id_usuario, $id_plan, $id_paquete);
    }

    public function altaPaquete($id_resumen, $id_paquete)
    {
        return $this->modelo->altaPaquete($id_resumen, $id_paquete);
    }

    public function actualizarPlan($id_usuario, $id_plan, $id_paquete)
    {
        return $this->modelo->actualizarPlan($id_usuario, $id_plan, $id_paquete);
    }

    public function ObtenerPlanes()
    {
        return $this->modelo->obtenerPlanes();
    }
    public function cantidadPlanes($usuario)
    {
        return $this->modelo->cantidadPlanes($usuario);
    }
    public function listarPlanesUsuario($id_usuario)
    {
        return $this->modelo->listarPlanesUsuario($id_usuario);
    }
    public function cambiarPlanUsuario($id_plan, $id_usuario)
    {
        return $this->modelo->cambiarPlanUsuario($id_plan, $id_usuario);
    }
}
