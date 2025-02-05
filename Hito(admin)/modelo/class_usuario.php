<?php
require_once '../config/class_conexion.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function agregarAdmin($idadmin, $nombre, $apellidos, $correo, $contraseña)
    {
        // Hashea la contraseña con password_hash
        $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT);

        $query = "INSERT INTO Administrador (id_admin, nombre, apellidos, correo, contraseña) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssss", $idadmin, $nombre, $apellidos, $correo, $contraseñaHashed);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al agregar Administrador: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono)
    {
        // Hashea la contraseña con password_hash

        $query = "INSERT INTO Usuarios (nombre, apellidos, correo, edad, telefono) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssii", $nombre, $apellidos, $correo, $edad, $telefono);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al agregar Usuarios: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function obtenerUsuario()
    {
        $query = "SELECT * FROM Usuarios";
        $resultado = $this->conexion->conexion->query($query);
        $socios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $socios[] = $fila;
        }
        return $socios;
    }


    public function obtenerAdmin()
    {
        $query = "SELECT * FROM Administrador";
        $resultado = $this->conexion->conexion->query($query);
        $admin = [];
        while ($fila = $resultado->fetch_assoc()) {
            $admin[] = $fila;
        }
        return $admin;
    }

    public function obtenerUsuarioporid($id_usuario)
    {
        $query = "SELECT * FROM Usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado->fetch_assoc();
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad, $telefono)
    {
        $query = "UPDATE Usuarios SET nombre = ?, apellidos = ?, correo = ?, edad = ?, telefono = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssiii", $nombre, $apellidos, $correo, $edad, $telefono, $id_usuario);

        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarUsuario($id_usuario)
    {
        $query = "DELETE FROM Usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al eliminar usuario: " . $stmt->error);
            return false;
        }

        $stmt->close();
    }

    public function eliminarAdmin($correo)
    {
        $query = "DELETE FROM Administrador WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al eliminar Admin: " . $stmt->error);
            return false;
        }

        $stmt->close();
    }

    public function iniciarSesion($correo, $password)
    {
        $query = "SELECT * FROM Administrador WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $admin = $resultado->fetch_assoc();


        if ($admin && password_verify($password, $admin['contraseña'])) {

            session_start(); 

            $_SESSION['id_admin'] = $admin['admin'];
            $stmt->close();

            return $admin; 
        } else {
            return false; 
        }
    }
    public function filtrado_usuario($usuario)
    {
        $query = "SELECT * FROM resumen WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $stmt->close();

        return $row ? true : false;
    }
    public function obtenerUsuariosCompletos()
    {
        $query = "SELECT 
        r.id_resumen,
        u.*, 
        CONCAT_WS(', ', pl.nombre, pl.duracion_suscripcion) AS Plan_Obtenido,
        CONCAT_WS(', ', p1.nombre, p2.nombre, p3.nombre) AS Paquetes_Obtenidos,
        pl.dispositivos,
        (pl.precio + IFNULL(p1.precio, 0) + IFNULL(p2.precio, 0) + IFNULL(p3.precio, 0)) AS Cuota
    FROM Usuarios u
    JOIN Resumen r ON u.id_usuario = r.id_usuario
    JOIN Plan pl ON r.id_plan = pl.id_plan
    LEFT JOIN Paquetes p1 ON r.id_paquete1 = p1.id_paquete
    LEFT JOIN Paquetes p2 ON r.id_paquete2 = p2.id_paquete
    LEFT JOIN Paquetes p3 ON r.id_paquete3 = p3.id_paquete";



        $resultado = $this->conexion->conexion->query($query);
        if (!$resultado) {
            die("Error en la consulta: " . $this->conexion->conexion->error);
        }
        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    }

    public function obtenerUsuariosCompletosIndividual($usuario)
    {
        $query = "SELECT 
            r.id_resumen,
            u.*, 
            CONCAT_WS(', ', pl.nombre, pl.duracion_suscripcion) AS Plan_Obtenido,
            CONCAT_WS(', ', p1.nombre, p2.nombre, p3.nombre) AS Paquetes_Obtenidos,
            pl.dispositivos,
            (pl.precio + IFNULL(p1.precio, 0) + IFNULL(p2.precio, 0) + IFNULL(p3.precio, 0)) AS Cuota
        FROM Usuarios u
        JOIN Resumen r ON u.id_usuario = r.id_usuario
        JOIN Plan pl ON r.id_plan = pl.id_plan
        LEFT JOIN Paquetes p1 ON r.id_paquete1 = p1.id_paquete
        LEFT JOIN Paquetes p2 ON r.id_paquete2 = p2.id_paquete
        LEFT JOIN Paquetes p3 ON r.id_paquete3 = p3.id_paquete 
        WHERE u.id_usuario = ?";


        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Obtener todos los resultados en un array
        $planes = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $planes; // Devuelve un array con los datos
    }

    public function obtenerUsuariosCompletosIndividual2($usuario)
    {
        $query = "SELECT * from Resumen where id_usuario = ?";

        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado->fetch_assoc();
    }

    ////////PLANES



    public function EliminarPlan($id_usuario)
    {
        $query = "DELETE FROM Resumen where id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }




        $stmt->close();
    }


    public function altaPlan($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {
        $query = "INSERT INTO Resumen (id_usuario, id_plan, id_paquete1, id_paquete2, id_paquete3) VALUES (?,?,?,?,?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("iiiii", $id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al Seleccionar Paquete: " . $stmt->error);
            $stmt->close();
            return false;
        }
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

    public function obtenerPlan($id_plan)
    {
        $query = "SELECT * FROM Plan WHERE id_plan = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_plan);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
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



    /////// PAQUETES



    public function obtenerPaquetes()
    {
        $query = "SELECT * FROM Paquetes";
        $resultado = $this->conexion->conexion->query($query);
        $Plan = [];
        while ($fila = $resultado->fetch_assoc()) {
            $Plan[] = $fila;
        }
        return $Plan;
    }


    public function insertarPaquete($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {


        // 1. Obtener información del usuario
        $usuario = $this->obtenerUsuarioporid($id_usuario);

        if (!$usuario) {
            return "Usuario no encontrado";
        }

        $edad = $usuario['edad'];

        // 2. Obtener información del plan
        $plan = $this->obtenerPlan($id_plan);

        if (!$plan) {
            return "Plan no encontrado";
        }

        $nombrePlan = $plan['nombre'];
        $duracionPlan = $plan['duracion_suscripcion'];

        // 3. Obtener información de los paquetes seleccionados
        $paquetesSeleccionados = [$id_paquete1, $id_paquete2, $id_paquete3];
        $paquetesValidos = [];

        foreach ($paquetesSeleccionados as $id_paquete) {
            if ($id_paquete) { // Solo validar si el paquete no es NULL
                $sqlPaquete = "SELECT nombre FROM Paquetes WHERE id_paquete = ?";
                $stmtPaquete = $this->conexion->conexion->prepare($sqlPaquete);
                $stmtPaquete->bind_param("i", $id_paquete);
                $stmtPaquete->execute();
                $resultadoPaquete = $stmtPaquete->get_result();
                $paquete = $resultadoPaquete->fetch_assoc();

                if ($paquete) {
                    $paquetesValidos[] = $paquete['nombre'];
                }
            }
        }

        // 4. Validaciones según las reglas establecidas
        if ($edad < 18) {
            if (count($paquetesValidos) > 1 || !in_array("Infantil", $paquetesValidos)) {
                return "Los menores de 18 años solo pueden contratar el Pack Infantil.";
            }
        }

        if ($nombrePlan === "Básico" && count($paquetesValidos) > 1) {
            return "Los usuarios del Plan Básico solo pueden seleccionar un paquete adicional.";
        }

        if (in_array("Deporte", $paquetesValidos) && $duracionPlan !== "Anual") {
            return "El Pack Deporte solo puede ser contratado si la duración de la suscripción es de 1 año.";
        }

        // 5. Si todas las validaciones pasan, actualizar la tabla Resumen
        $sqlUpdate = "UPDATE Resumen SET id_paquete1 = ?, id_paquete2 = ?, id_paquete3 = ? WHERE id_usuario = ? AND id_plan = ?";
        $stmtUpdate = $this->conexion->conexion->prepare($sqlUpdate);
        $stmtUpdate->bind_param("iiiii", $id_paquete1, $id_paquete2, $id_paquete3, $id_usuario, $id_plan);

        if ($stmtUpdate->execute()) {
            return "Paquete actualizado correctamente.";
        } else {
            return "Error al actualizar el paquete.";
        }
    }
}
