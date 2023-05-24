<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Obtener los productos con stock disponible
$query = "SELECT * FROM productos WHERE stock > 0";
$result = mysqli_query($conn, $query);

if (!$result) {
  die('Error al obtener los productos: ' . mysqli_error($conn));
}

// Crear un arreglo para almacenar los productos
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $product = [
      'id' => $row['id'],
      'nombre' => $row['nombre'],
      'precio' => $row['precio'],
      'stock' => $row['stock'],
      'cantidad_carrito' => 0 // Agregar una propiedad para el seguimiento de la cantidad en el carrito
    ];
  
    $products[] = $product;
  }
  

// Cerrar la conexión a la base de datos
mysqli_close($conn);

// Devolver los productos en formato JSON
header('Content-Type: application/json');
echo json_encode($products);
?>
