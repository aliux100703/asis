<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $abandono = $_POST['abandono'];
        $enfermo = $_POST['enfermo'];
        $falta = $_POST['falta'];
        $no_registro = $_POST['no_registro'];
        $retraso = $_POST['retraso'];
        $permiso = $_POST['permiso'];

        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=asistencias';
        $usuario = 'root';
        $contraseña = '';

        try {
            $conexion = new PDO($dsn, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insertar el nuevo registro en la base de datos
            $consulta = "INSERT INTO asistencia (empleado_id, abandono, enfermo, falto, no_r, permiso, retardo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $statement = $conexion->prepare($consulta);
            $statement->execute([$nombre, $abandono, $enfermo, $falta, $no_registro, $retraso, $permiso]);

            echo "Registro creado exitosamente.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Cerrar la conexión a la base de datos
        $conexion = null;
    }
?>
