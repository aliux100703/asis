<?php
    // Obtener el ID del registro a editar
    $id = $_GET['id'];

    // Conectar a la base de datos utilizando PDO
    $dsn = 'mysql:host=localhost;dbname=asistencias';
    $usuario = 'root';
    $contraseña = '';

    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener los datos del registro
        $consulta = "SELECT * FROM asistencia WHERE id = ?";
        $statement = $conexion->prepare($consulta);
        $statement->execute([$id]);
        $registro = $statement->fetch(PDO::FETCH_ASSOC);

        // Verificar si el formulario ha sido enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Actualizar los datos del registro
            $nombre = $_POST['nombre'];
            $abandono = $_POST['abandono'];
            $enfermo = $_POST['enfermo'];
            $falta = $_POST['falta'];
            $no_registro = $_POST['no_registro'];
            $retraso = $_POST['retraso'];
            $permiso = $_POST['permiso'];

            $consulta = "UPDATE registros SET nombre = ?, abandono = ?, enfermo = ?, falta = ?, no_registro = ?, retraso = ?, permiso = ? WHERE id = ?";
            $statement = $conexion->prepare($consulta);
            $statement->execute([$nombre, $abandono, $enfermo, $falta, $no_registro, $retraso, $permiso, $id]);

            echo "Registro actualizado exitosamente.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión a la base de datos
    $conexion =
    null;
    ?>
    <!DOCTYPE html>
<html>
<head>
    <title>Editar registro</title>
</head>
<body>
    <h2>Editar registro:</h2>
    <form action="editar.php?id=<?php echo $id; ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $registro['nombre']; ?>" required><br>
        <label for="abandono">Abandono:</label>
        <input type="number" name="abandono" value="<?php echo $registro['abandono']; ?>" required><br>
        <label for="enfermo">Enfermo:</label>
        <input type="number" name="enfermo" value="<?php echo $registro['enfermo']; ?>" required><br>
        <label for="falta">Falta:</label>
        <input type="number" name="falta" value="<?php echo $registro['falta']; ?>" required><br>
        <label for="no_registro">No registro:</label>
        <input type="number" name="no_registro" value="<?php echo $registro['no_registro']; ?>" required><br>
        <label for="retraso">Retraso:</label>
        <input type="number" name="retraso" value="<?php echo $registro['retraso']; ?>" required><br>
        <label for="permiso">Permiso:</label>
        <input type="number" name="permiso" value="<?php echo $registro['permiso']; ?>" required><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>