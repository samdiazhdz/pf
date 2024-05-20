<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $numero_control = $_POST['numero_control'];

    $sql = "INSERT INTO estudiantes (nombre, numero_control) VALUES ('$nombre', '$numero_control')";

    if ($conn->query($sql) === TRUE) {
        $message = "Nuevo registro creado exitosamente";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $numero_control = $_POST['numero_control_search'];

    $sql = "SELECT * FROM estudiantes WHERE numero_control = '$numero_control'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $search_results = "";
        while($row = $result->fetch_assoc()) {
            $search_results .= "Nombre: " . $row["nombre"]. " - Número de Control: " . $row["numero_control"]. "<br>";
        }
    } else {
        $search_results = "No se encontraron resultados";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado de Procesamiento</title>
</head>
<body>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (isset($search_results)): ?>
        <p><?php echo $search_results; ?></p>
    <?php endif; ?>

    <a href="index.php">Volver</a>
</body>
</html>
