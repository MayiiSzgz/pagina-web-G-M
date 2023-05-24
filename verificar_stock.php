<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Obtener el parámetro de la URL
$id = $_GET['id'];

// Consultar el stock disponible para el producto
$query = "SELECT stock FROM productos WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result) {
  die('Error al obtener el stock del producto: ' . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$stockDisponible = $row['stock'];

// Devolver el stock disponible en formato JSON
header('Content-Type: application/json');
echo json_encode(['stock_disponible' => $stockDisponible]);

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
