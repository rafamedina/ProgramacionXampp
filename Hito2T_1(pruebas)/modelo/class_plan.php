<?php
require_once '../config/class_conexion.php';

class Plan
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function altaPlan($id_usuario, $id_plan, $id_paquete)
    {
        $query = "INSERT INTO Resumen (id_usuario, id_plan, id_paquete) VALUES (?,?,?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("iii", $id_usuario, $id_plan, $id_paquete);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al Seleccionar Paquete: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function altaPaquete($id_resumen, $id_paquete)
    {
        $query = "UPDATE Resumen SET  id_paquete = ? WHERE id_resumen = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ii", $id_paquete, $id_resumen);

        if ($stmt->execute()) {
            echo "paquete actualizado con éxito.";
        } else {
            echo "Error al añadir paquete: " . $stmt->error;
        }

        $stmt->close();
    }

    public function actualizarPlan($id_usuario, $id_plan, $id_paquete)
    {
        $query = "UPDATE Resumen SET  id_plan = ?, id_paquete = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("iii", $id_plan, $id_paquete, $id_usuario);

        if ($stmt->execute()) {
            echo "plan / paquete actualizado con éxito.";
        } else {
            echo "Error al actualizar plan / paquete: " . $stmt->error;
        }

        $stmt->close();
    }

    public function obtenerPlanes()
    {
        $query = "SELECT * FROM Plan";
        $resultado = $this->conexion->conexion->query($query);
        $Plan = [];
        while ($fila = $resultado->fetch_assoc()) {
            $Plan[] = $fila;
        }
        return $Plan;
    }

    public function cantidadPlanes($usuario)
    {
        $query = "SELECT COUNT(id_plan) as cantidad FROM resumen WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();



        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Allow adding a plan if the count is less than 1
        if ($row['cantidad'] < 1) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    public function listarPlanesUsuario($id_usuario)
    {
        $query = "SELECT 
                    u.nombre AS nombre_usuario,
                    pl.nombre AS planes_en_propiedad,
                    pl.dispositivos,
                    pl.precio,
                    duracion_suscripcion
                    FROM usuarios u
                    JOIN resumen r ON u.id_usuario = r.id_usuario
                    JOIN plan pl ON pl.id_plan = r.id_plan
                    WHERE u.id_usuario = ?";

        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Obtener todos los resultados en un array
        $planes = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $planes; // Devuelve un array con los datos
    }
    public function cambiarPlanUsuario($id_plan, $id_usuario)
    {
        $query = "UPDATE resumen SET id_plan = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ii", $id_plan, $id_usuario);
        $stmt->execute();
        $stmt->close();
        return true;
    }
}
