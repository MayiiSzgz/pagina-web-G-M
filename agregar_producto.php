<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$categoria = $_POST['categoria'];

// Obtener la información de la imagen
$imagenNombre = $_FILES['imagen']['name'];
$imagenTempPath = $_FILES['imagen']['tmp_name'];
$imagenError = $_FILES['imagen']['error'];

// Verificar si se cargó correctamente la imagen
if ($imagenError === UPLOAD_ERR_OK) {
  // Obtener el último número de imagen almacenada
  $query = "SELECT imagen FROM productos ORDER BY id DESC LIMIT 1";
  $result = mysqli_query($conn, $query);
  
  if ($result && mysqli_num_rows($result) > 0) {
    $lastImage = mysqli_fetch_assoc($result)['imagen'];
    $lastNumber = (int)substr($lastImage, 0, strpos($lastImage, '.'));
  } else {
    $lastNumber = 0;
  }

  // Generar el nuevo nombre de la imagen
  $newNumber = $lastNumber + 1;
  $extension = pathinfo($imagenNombre, PATHINFO_EXTENSION);
  $newImageName = $newNumber . '.' . $extension;

  // Mover la imagen a la carpeta "img" con el nuevo nombre
  move_uploaded_file($imagenTempPath, 'img/' . $newImageName);

  // Insertar el producto en la base de datos
  $query = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, imagen) VALUES ('$nombre', '$descripcion', $precio, $stock, $categoria, '$newImageName')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Producto agregado correctamente
    session_start();
    $_SESSION['mensaje'] = 'Producto agregado correctamente.';
    header('Location: index.php');
    exit();
  } else {
    echo 'Error al agregar el producto: ' . mysqli_error($conn);
  }
} else {
  echo 'Error al cargar la imagen: ' . $imagenError;
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
