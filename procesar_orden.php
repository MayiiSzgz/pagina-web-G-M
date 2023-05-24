<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Obtener los datos enviados desde el cliente
$data = json_decode(file_get_contents('php://input'), true);

// Realizar las operaciones necesarias para procesar la orden de compra y actualizar el stock
foreach ($data as $product) {
  $productId = $product['id'];
  $quantity = $product['quantity'];
  
  // Verificar si el producto existe en la base de datos y si hay suficiente stock
  $query = "SELECT stock FROM productos WHERE id = $productId";
  $result = mysqli_query($conn, $query);
  
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $stock = $row['stock'];
    
    if ($stock >= $quantity) {
      // Restar la cantidad comprada al stock disponible
      $newStock = $stock - $quantity;
      $updateQuery = "UPDATE productos SET stock = $newStock WHERE id = $productId";
      mysqli_query($conn, $updateQuery);
    } else {
      // No hay suficiente stock disponible para el producto
      // Aquí puedes manejar el caso de error y devolver una respuesta al cliente
    }
  } else {
    // El producto no existe en la base de datos
    // Aquí puedes manejar el caso de error y devolver una respuesta al cliente
  }
}

// Aquí debes realizar cualquier otra operación necesaria para completar el procesamiento de la orden de compra
// Por ejemplo, puedes guardar la información de la orden en una tabla "ordenes" y generar un número de orden

// Cerrar la conexión a la base de datos
mysqli_close($conn);

// Devolver una respuesta al cliente (puede ser en formato JSON)
http_response_code(200); // Código de respuesta HTTP 200 (OK)
echo json_encode(['message' => 'Orden de compra procesada correctamente']);
?>
