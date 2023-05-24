<?php
// Incluir el archivo db.php para obtener la conexión a la base de datos
include 'db.php';

// Obtener los datos enviados en el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'));

// Verificar si los datos son válidos
if (isset($data->product_id) && isset($data->quantity_purchased)) {
  // Asignar los valores a variables
  $product_id = $data->product_id;
  $quantity_purchased = $data->quantity_purchased;

  // Realizar la actualización del stock en la base de datos
  $sql = "UPDATE productos SET stock = stock - $quantity_purchased WHERE id = $product_id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Operación exitosa
    $response = [
      'success' => true,
      'message' => 'Stock actualizado en la base de datos para el producto ID ' . $product_id
    ];
  } else {
    // Error en la operación
    $response = [
      'success' => false,
      'message' => 'Error al actualizar el stock en la base de datos'
    ];
  }
} else {
  // En caso de que falten datos
  $response = [
    'success' => false,
    'message' => 'Error: Faltan datos requeridos'
  ];
}

// Enviar la respuesta como un objeto JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión con la base de datos
mysqli_close($conn);
?>