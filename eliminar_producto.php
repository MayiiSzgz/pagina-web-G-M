<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Verificar si se ha proporcionado el parámetro "id" en la URL
if (isset($_GET['id'])) {
  $productoId = $_GET['id'];

  // Verificar si el producto existe en la base de datos
  $query = "SELECT * FROM productos WHERE id = $productoId";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    // Eliminar el producto de la base de datos
    $query = "DELETE FROM productos WHERE id = $productoId";
    $result = mysqli_query($conn, $query);

    if ($result) {
      // Producto eliminado correctamente
      session_start();
      $_SESSION['mensaje'] = 'Producto eliminado correctamente.';
      header('Location: index.php');
      exit();
    } else {
      echo 'Error al eliminar el producto: ' . mysqli_error($conn);
    }
  } else {
    echo 'El producto no existe.';
  }
} else {
  echo 'ID de producto no proporcionado.';
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
