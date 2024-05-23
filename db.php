<?php
$servername = "bd-pf.mysql.database.azure.com";
$username = "sam";
$password = "Bleach150!!!";
$dbname = "estudianteDB";
$port = 3306;
$ssl_ca = "{path to CA cert}";

// Crear la conexión
$conn = mysqli_init();

if (!$conn) {
    die("mysqli_init failed");
}

mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

if (!mysqli_real_connect($conn, $servername, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa";
?>
