<?php
require_once '../config/class_conexion.php';

class Usuario
{
    private $conexion;

    // Constructor que inicializa la conexión a la base de datos.
    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    // Añade un administrador con los datos proporcionados. La contraseña se cifra antes de almacenarla.
    public function agregarAdmin($idadmin, $nombre, $apellidos, $correo, $contraseña)
    {
        $contraseñaHashed = password_hash($contraseña, PASSWORD_DEFAULT); // Cifrado de la contraseña.
        $query = "INSERT INTO Administrador (id_admin, nombre, apellidos, correo, contraseña) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssss", $idadmin, $nombre, $apellidos, $correo, $contraseñaHashed);

        // Ejecuta la consulta y maneja posibles errores.
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al agregar Administrador: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    // Añade un usuario con los datos proporcionados.
    public function agregarUsuario($nombre, $apellidos, $correo, $edad, $telefono)
    {
        $query = "INSERT INTO Usuarios (nombre, apellidos, correo, edad, telefono) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssii", $nombre, $apellidos, $correo, $edad, $telefono);

        // Ejecuta la consulta y maneja posibles errores.
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al agregar Usuarios: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    // Obtiene todos los usuarios almacenados en la base de datos.
    public function obtenerUsuario()
    {
        $query = "SELECT * FROM Usuarios";
        $resultado = $this->conexion->conexion->query($query);
        $socios = [];

        // Almacena cada fila de resultados en un array.
        while ($fila = $resultado->fetch_assoc()) {
            $socios[] = $fila;
        }
        return $socios;
    }

    // Obtiene todos los administradores almacenados en la base de datos.
    public function obtenerAdmin()
    {
        $query = "SELECT * FROM Administrador";
        $resultado = $this->conexion->conexion->query($query);
        $admin = [];

        // Almacena cada fila de resultados en un array.
        while ($fila = $resultado->fetch_assoc()) {
            $admin[] = $fila;
        }
        return $admin;
    }

    // Obtiene un usuario específico por su ID.
    public function obtenerUsuarioporid($id_usuario)
    {
        $query = "SELECT * FROM Usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        // Devuelve el usuario encontrado o null si no existe.
        return $resultado->fetch_assoc();
    }

    // Actualiza los datos de un usuario existente.
    public function actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $edad, $telefono)
    {
        $query = "UPDATE Usuarios SET nombre = ?, apellidos = ?, correo = ?, edad = ?, telefono = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssiii", $nombre, $apellidos, $correo, $edad, $telefono, $id_usuario);

        // Muestra un mensaje según el resultado de la operación.
        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }
        $stmt->close();
    }

    // Elimina un usuario por su ID.
    public function eliminarUsuario($id_usuario)
    {
        $query = "DELETE FROM Usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);

        // Retorna true si la eliminación fue exitosa, false en caso contrario.
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al eliminar usuario: " . $stmt->error);
            return false;
        }
        $stmt->close();
    }

    // Elimina un administrador por su correo.
    public function eliminarAdmin($correo)
    {
        $query = "DELETE FROM Administrador WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);

        // Retorna true si la eliminación fue exitosa, false en caso contrario.
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al eliminar Admin: " . $stmt->error);
            return false;
        }
        $stmt->close();
    }

    // Inicia sesión verificando las credenciales del administrador.
    public function iniciarSesion($correo, $password)
    {
        $query = "SELECT * FROM Administrador WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $admin = $resultado->fetch_assoc();

        // Verifica la contraseña y gestiona la sesión.
        if ($admin && password_verify($password, $admin['contraseña'])) {
            session_start(); // Inicio de sesión.
            $_SESSION['id_admin'] = $admin['admin'];
            $stmt->close();
            return $admin; // Devuelve los datos del administrador si es correcto.
        } else {
            return false; // Credenciales incorrectas.
        }
    }

    // Comprueba si un usuario tiene un resumen asociado.
    public function filtrado_usuario($usuario)
    {
        $query = "SELECT * FROM resumen WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Retorna true si hay al menos un resultado, false en caso contrario.
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ? true : false;
    }

    // Obtiene información detallada de todos los usuarios con sus planes y paquetes.
    public function obtenerUsuariosCompletos()
    {
        $query = "SELECT 
            r.id_resumen,
            u.*, 
            CONCAT_WS(', ', pl.nombre, pl.duracion_suscripcion) AS Plan_Obtenido,
            pl.precio as precio_plan,
            CONCAT_WS(', ', p1.nombre, p2.nombre, p3.nombre) AS Paquetes_Obtenidos,
            CONCAT_WS(', ', p1.precio, p2.precio, p3.precio) AS precio_paquete,
            pl.dispositivos,
            (pl.precio + IFNULL(p1.precio, 0) + IFNULL(p2.precio, 0) + IFNULL(p3.precio, 0)) AS Cuota
            FROM Usuarios u
            JOIN Resumen r ON u.id_usuario = r.id_usuario
            JOIN Plan pl ON r.id_plan = pl.id_plan
            LEFT JOIN Paquetes p1 ON r.id_paquete1 = p1.id_paquete
            LEFT JOIN Paquetes p2 ON r.id_paquete2 = p2.id_paquete
            LEFT JOIN Paquetes p3 ON r.id_paquete3 = p3.id_paquete ";

        $resultado = $this->conexion->conexion->query($query);

        // Maneja errores en la consulta.
        if (!$resultado) {
            die("Error en la consulta: " . $this->conexion->conexion->error);
        }

        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    }

    // Obtiene información detallada de un usuario específico con sus planes y paquetes.
    public function obtenerUsuariosCompletosIndividual($usuario)
    {
        $query = "SELECT 
            r.id_resumen,
            u.*, 
            CONCAT_WS(', ', pl.nombre, pl.duracion_suscripcion) AS Plan_Obtenido,
            pl.precio,
            CONCAT_WS(', ', p1.nombre, p2.nombre, p3.nombre) AS Paquetes_Obtenidos,
            CONCAT_WS(', ', p1.precio, p2.precio, p3.precio) AS Precios_Paquetes,
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

        // Retorna todos los resultados como un array asociativo.
        $planes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $planes;
    }

    // Obtiene el resumen de un usuario específico.
    public function obtenerUsuariosCompletosIndividual2($usuario)
    {
        $query = "SELECT * from Resumen where id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        // Retorna el primer resultado como un array asociativo.
        return $resultado->fetch_assoc();
    }

    // Elimina el plan de un usuario.
    public function EliminarPlan($id_usuario)
    {
        $query = "DELETE FROM Resumen where id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);

        // Muestra un mensaje dependiendo del éxito o fracaso de la eliminación.
        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar Usuario: " . $stmt->error;
        }
        $stmt->close();
    }

    // Asigna un plan y paquetes a un usuario.
    public function altaPlan($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {
        $query = "INSERT INTO Resumen (id_usuario, id_plan, id_paquete1, id_paquete2, id_paquete3) VALUES (?,?,?,?,?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("iiiii", $id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3);

        // Retorna true si la inserción fue exitosa, false en caso contrario.
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error al Seleccionar Paquete: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    // Obtiene todos los planes disponibles.
    public function obtenerPlanes()
    {
        $query = "SELECT * FROM Plan";
        $resultado = $this->conexion->conexion->query($query);
        $Plan = [];

        // Almacena cada fila de resultados en un array.
        while ($fila = $resultado->fetch_assoc()) {
            $Plan[] = $fila;
        }
        return $Plan;
    }

    // Obtiene un plan específico por su ID.
    public function obtenerPlan($id_plan)
    {
        $query = "SELECT * FROM Plan WHERE id_plan = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_plan);
        $stmt->execute();

        // Retorna el primer resultado como un array asociativo.
        return $stmt->get_result()->fetch_assoc();
    }

    // Verifica si un usuario puede añadir más planes.
    public function cantidadPlanes($usuario)
    {
        $query = "SELECT COUNT(id_plan) as cantidad FROM resumen WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Permite añadir un plan si el contador es menor a 1.
        if ($row['cantidad'] < 1) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    // Obtiene todos los paquetes disponibles.
    public function obtenerPaquetes()
    {
        $query = "SELECT * FROM Paquetes";
        $resultado = $this->conexion->conexion->query($query);
        $Plan = [];

        // Almacena cada fila de resultados en un array.
        while ($fila = $resultado->fetch_assoc()) {
            $Plan[] = $fila;
        }
        return $Plan;
    }

    // Inserta paquetes para un usuario, validando restricciones específicas.
    public function insertarPaquete($id_usuario, $id_plan, $id_paquete1, $id_paquete2, $id_paquete3)
    {
        // 1. Obtener información del usuario.
        // Consultamos la base de datos para obtener la información del usuario según su ID.
        // Esto nos permitirá acceder a datos clave como la edad del usuario, que es importante para las restricciones de paquetes.
        $usuario = $this->obtenerUsuarioporid($id_usuario);
        if (!$usuario) {
            return "Usuario no encontrado."; // Si el usuario no existe, terminamos la ejecución con un mensaje de error.
        }
        $edad = $usuario['edad']; // Guardamos la edad del usuario para las validaciones posteriores.

        // 2. Obtener información del plan.
        // Consultamos la base de datos para obtener el plan de suscripción del usuario.
        // Necesitamos conocer el nombre del plan y la duración de la suscripción para aplicar las reglas de selección de paquetes.
        $plan = $this->obtenerPlan($id_plan);
        if (!$plan) {
            return "Plan no encontrado."; // Si el plan no existe, terminamos la ejecución con un mensaje de error.
        }
        $nombrePlan = $plan['nombre']; // Nombre del plan (Ejemplo: "Básico", "Premium", etc.)
        $duracionPlan = $plan['duracion_suscripcion']; // Duración de la suscripción (Ejemplo: "Mensual", "Anual")

        // 3. Obtener información de los paquetes seleccionados.
        // Guardamos los IDs de los paquetes en un array para recorrerlos de manera más sencilla.
        $paquetesSeleccionados = [$id_paquete1, $id_paquete2, $id_paquete3];

        // Creamos un array vacío donde guardaremos los paquetes que realmente existen en la base de datos.
        $paquetesValidos = [];

        // Recorremos los paquetes seleccionados para verificar si existen en la base de datos.
        foreach ($paquetesSeleccionados as $id_paquete) {
            if ($id_paquete) { // Solo validamos si el paquete no es NULL.
                // Consultamos la base de datos para obtener el nombre del paquete correspondiente al ID.
                $sqlPaquete = "SELECT nombre FROM Paquetes WHERE id_paquete = ?";
                $stmtPaquete = $this->conexion->conexion->prepare($sqlPaquete);
                $stmtPaquete->bind_param("i", $id_paquete);
                $stmtPaquete->execute();
                $resultadoPaquete = $stmtPaquete->get_result();
                $paquete = $resultadoPaquete->fetch_assoc();

                if ($paquete) { // Si el paquete existe, lo añadimos a la lista de paquetes válidos.
                    $paquetesValidos[] = $paquete['nombre'];
                }
            }
        }

        // 4. Validaciones según las reglas establecidas.

        // Regla 1: Si el usuario es menor de 18 años, solo puede seleccionar el Pack Infantil.
        if ($edad < 18) {
            // Si seleccionó más de un paquete o el Pack Infantil no está incluido en la lista, se rechaza la solicitud.
            if (count($paquetesValidos) > 1 || !in_array("Infantil", $paquetesValidos)) {
                return "Los menores de 18 años solo pueden contratar el Pack Infantil.";
            }
        }

        // Regla 2: Si el usuario tiene el Plan Básico, solo puede seleccionar un paquete adicional.
        if ($nombrePlan === "Básico" && count($paquetesValidos) > 1) {
            return "Los usuarios del Plan Básico solo pueden seleccionar un paquete adicional.";
        }

        // Regla 3: Si el usuario selecciona el Pack Deporte, su suscripción debe ser de 1 año.
        if (in_array("Deporte", $paquetesValidos) && $duracionPlan !== "Anual") {
            return "El Pack Deporte solo puede ser contratado si la duración de la suscripción es de 1 año.";
        }

        // 5. Si todas las validaciones son correctas, actualiza la tabla Resumen.
        // En este paso actualizamos la tabla `Resumen`, asociando los paquetes seleccionados con el usuario y su plan.
        $sqlUpdate = "UPDATE Resumen SET id_paquete1 = ?, id_paquete2 = ?, id_paquete3 = ? WHERE id_usuario = ? AND id_plan = ?";
        $stmtUpdate = $this->conexion->conexion->prepare($sqlUpdate);

        // Asociamos los valores a los parámetros de la consulta SQL para evitar inyección de SQL.
        $stmtUpdate->bind_param("iiiii", $id_paquete1, $id_paquete2, $id_paquete3, $id_usuario, $id_plan);

        // Ejecutamos la actualización en la base de datos.
        if ($stmtUpdate->execute()) {
            return "Paquete actualizado correctamente."; // Confirmamos que la actualización fue exitosa.
        } else {
            return "Error al actualizar el paquete."; // Si hubo un error en la ejecución, se informa.
        }
    }
}
