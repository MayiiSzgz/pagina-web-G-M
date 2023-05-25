<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Obtener los datos del ticket enviados por el formulario
$ticketData = $_POST['ticket_data'];

// Insertar el ticket en la base de datos
$sql = "INSERT INTO tickets (cliente_id, fecha_ticket, descripcion) VALUES (1, NOW(), '$ticketData')"; // Reemplaza 1 por el ID del cliente correspondiente
if ($conn->query($sql) === TRUE) {
  echo "El ticket se guardó en la base de datos.";
} else {
  echo "Error al guardar el ticket: " . $conn->error;
}

$conn->close();
?>
