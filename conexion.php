<?php
$dsn = 'mysql:host=localhost;dbname=asistencias';
$usuario = 'root';
$contraseña = '';
try {
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Resto del código...
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

try {
    // Consulta para obtener datos de una tabla
    $consultaTabla1 = "SELECT * FROM asistencia";
    $statementTabla1 = $conexion->query($consultaTabla1);
    $datosTabla1 = $statementTabla1->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener datos de otra tabla
    $consultaTabla2 = "SELECT * FROM empleado";
    $statementTabla2 = $conexion->query($consultaTabla2);
    $datosTabla2 = $statementTabla2->fetchAll(PDO::FETCH_ASSOC);

      // Consulta para obtener datos de otra tabla
      $consultaTabla2 = "SELECT * FROM empleado";
      $statementTabla2 = $conexion->query($consultaTabla2);
      $datosTabla2 = $statementTabla2->fetchAll(PDO::FETCH_ASSOC);
    // Resto del código para procesar los datos de las tablas...
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>