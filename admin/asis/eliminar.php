<?php
    // Obtener el ID del registro a eliminar
    $id = $_GET['id'];

    // Conectar a la base de datos utilizando PDO
    $dsn = 'mysql:host=localhost;dbname=asistencias';
    $usuario = 'root';
    $contraseña = '';

    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Eliminar el registro de la base de datos
        $consulta = "DELETE FROM asistencia WHERE id = ?";
        $statement = $conexion->prepare($consulta);
        $statement->execute([$id]);

        echo "Registro eliminado exitosamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión a la base de datos
    $conexion = null;
?>