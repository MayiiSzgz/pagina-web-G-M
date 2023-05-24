<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "TiendaMG";

// Establecer conexión con la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión si es exitosa muestra un mensaje de conexión exitosa
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>
