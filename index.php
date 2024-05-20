<!DOCTYPE html>
<html>
<head>
    <title>Registro de Estudiantes</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form method="post" action="process.php">
        Nombre: <input type="text" name="nombre" required><br>
        Número de Control: <input type="text" name="numero_control" required><br>
        <input type="submit" name="register" value="Registrar">
    </form>

    <h2>Consulta de Estudiantes</h2>
    <form method="post" action="process.php">
        Número de Control: <input type="text" name="numero_control_search" required><br>
        <input type="submit" name="search" value="Buscar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servername = "bd-pf.mysql.database.azure.com";
        $username = "sam";
        $password = "Bleach150!!!";
        $dbname = "estudianteDB";
        
        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        if (isset($_POST['register'])) {
            $nombre = $_POST['nombre'];
            $numero_control = $_POST['numero_control'];

            $sql = "INSERT INTO estudiantes (nombre, numero_control) VALUES ('$nombre', '$numero_control')";

            if ($conn->query($sql) === TRUE) {
                echo "Registro exitoso!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        if (isset($_POST['search'])) {
            $numero_control_search = $_POST['numero_control_search'];

            $sql = "SELECT nombre, numero_control FROM estudiantes WHERE numero_control = '$numero_control_search'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "Nombre: " . $row["nombre"]. " - Número de Control: " . $row["numero_control"]. "<br>";
                }
            } else {
                echo "No se encontraron resultados.";
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>
