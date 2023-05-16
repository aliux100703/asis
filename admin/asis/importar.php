<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha seleccionado un archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['archivo']['name'];
        $rutaArchivo = $_FILES['archivo']['tmp_name'];

        // Verificar la extensión del archivo
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
        if ($extension === 'xlsx' || $extension === 'xls') {
            // Conectar a la base de datos utilizando PDO
            $dsn = 'mysql:host=localhost;dbname=asistencias';
            $usuario = 'root';
            $contraseña = '';

            try {
                $conexion = new PDO($dsn, $usuario, $contraseña);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Leer el archivo Excel utilizando una biblioteca como PHPExcel o PhpSpreadsheet
                // Aquí se asume que se utiliza la biblioteca PhpSpreadsheet
                require 'vendor/autoload.php';
                use PhpSpreadsheet\IOFactor;

                $documento = IOFactory::load($rutaArchivo);
                $hoja = $documento->getActiveSheet();
                $datos = $hoja->toArray();

                // Iterar sobre los datos y guardarlos en la base de datos
                foreach ($datos as $fila) {
                    $nombre = $fila[0];
                    $abandono = $fila[1];
                    $enfermo = $fila[2];
                    $falta = $fila[3];
                    $no_registro = $fila[4];
                    $retraso = $fila[5];
                    $permiso = $fila[6];

                    $consulta = "INSERT INTO asistencias (nombre, abandono, enfermo, falta, no_registro, retraso, permiso) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $statement = $conexion->prepare($consulta);
                    $statement->execute([$nombre, $abandono, $enfermo, $falta, $no_registro, $retraso, $permiso]);
                }

                echo "Datos importados correctamente.";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Cerrar la conexión a la base de datos
            $conexion = null;
        } else {
            echo "Por favor, selecciona un archivo Excel válido (xlsx o xls).";
        }
    } else {
        echo "Por favor, selecciona un archivo para importar.";
    }
}
?>
