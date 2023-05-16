<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
</head>
<body>
    <h1>CRUD</h1>

    <h2>Crear registro:</h2>
    <form action="crear.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label for="abandono">Abandono:</label>
        <input type="number" name="abandono" required><br>
        <label for="enfermo">Enfermo:</label>
        <input type="number" name="enfermo" required><br>
        <label for="falta">Falta:</label>
        <input type="number" name="falta" required><br>
        <label for="no_registro">No registro:</label>
        <input type="number" name="no_registro" required><br>
        <label for="retraso">Retraso:</label>
        <input type="number" name="retraso" required><br>
        <label for="permiso">Permiso:</label>
        <input type="number" name="permiso" required><br>
        <input type="submit" value="Crear">
        
    </form>

    <h2>Listar registros:</h2>
    <form action="importar.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="archivo" required>
        <input type="submit" value="Importar">
    </form>
    <?php
        // Conectar a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=asistencias';
        $usuario = 'root';
        $contraseña = '';

        try {
            $conexion = new PDO($dsn, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Realizar la consulta
            $consulta = "SELECT * FROM asistencia";
            $resultado = $conexion->query($consulta);

            // Mostrar los registros en una tabla
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Abandono</th><th>Enfermo</th><th>Falta</th><th>No Registro</th><th>Retraso</th><th>Permiso</th></tr>";
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['abandono'] . "</td>";
                echo "<td>" . $fila['enfermo'] . "</td>";
                echo "<td>" . $fila['falta'] . "</td>";
                echo "<td>" . $fila['no_registro'] . "</td>";
                echo "<td>" . $fila['retraso'] . "</td>";
                echo "<td>" . $fila['permiso'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Cerrar la conexión a la base de datos
        $conexion = null;
    ?>
</body>
</html>
