<!DOCTYPE html>
<html>
<head>
  <title>Tienda</title>
  <style>
    .form-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f4f4f4;
    }
    
    .form-container h2 {
      margin-top: 0;
    }
    
    .form-container input,
    .form-container textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }
    
    .form-container select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }
    
    .form-container button {
      display: block;
      width: 100%;
      padding: 8px;
      background-color: #337ab7;
      color: #fff;
      border: none;
      cursor: pointer;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .delete-btn {
      background-color: #f44336;
      color: #fff;
      border: none;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      cursor: pointer;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Agregar Producto</h2>
    
    <form action="agregar_producto.php" method="POST" enctype="multipart/form-data">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" required>
      
      <label for="descripcion">Descripcion:</label>
      <textarea name="descripcion" id="descripcion" required></textarea>
      
      <label for="precio">Precio:</label>
      <input type="number" name="precio" id="precio" step="0.01" required>
      
      <label for="stock">Stock:</label>
      <input type="number" name="stock" id="stock" required>
      
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" required>
        <option value="1">Categoria 1</option>
        <option value="2">Categoria 2</option>
        <option value="3">Categoria 3</option>
        <!-- Agrega más opciones según tus necesidades -->
      </select>
      
      <label for="imagen">Imagen:</label>
      <input type="file" name="imagen" id="imagen" accept="image/*" required>
      
      <button type="submit">Agregar Producto</button>
    </form>
    <br>
    <br>
    <br>
    <br>
    
    <h2>Productos existentes</h2>
  
    <table>
      <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Categoría</th>
        <th>Acciones</th>
      </tr>
      <?php
      // Incluir el archivo de conexión a la base de datos
      require_once 'db.php';

      // Obtener los productos existentes de la base de datos
      $query = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.stock, c.nombre AS categoria_nombre
      FROM productos p
      INNER JOIN categorias c ON p.categoria_id = c.id";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['nombre'] . "</td>";
      echo "<td>" . $row['descripcion'] . "</td>";
      echo "<td>" . $row['precio'] . "</td>";
      echo "<td><form method='POST' action='" . $_SERVER['PHP_SELF'] . "'><input type='number' name='stock_actualizado' value='" . $row['stock'] . "' data-product-id='" . $row['id'] . "'><input type='hidden' name='product_id' value='" . $row['id'] . "'><input type='submit' value='Actualizar'></form></td>";
      echo "<td>" . $row['categoria_nombre'] . "</td>";
      echo "<td><a href='eliminar_producto.php?id=" . $row['id'] . "' class='delete-btn'>Eliminar</a></td>";
      echo "</tr>";
      }
      } else {
      echo "<tr><td colspan='6'>No hay productos existentes.</td></tr>";
      }

      // Procesar la actualización del stock
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stock_actualizado']) && isset($_POST['product_id'])) {
      $product_id = $_POST['product_id'];
      $stock_actualizado = $_POST['stock_actualizado'];

      // Realizar la actualización del stock en la base de datos
      $update_query = "UPDATE productos SET stock = $stock_actualizado WHERE id = $product_id";
      $update_result = mysqli_query($conn, $update_query);

      if ($update_result) {
      //echo "<script>alert('El stock se ha actualizado correctamente');</script>";
      //refescar la pagina
      echo "<script>Location.reload();</script>";
      } else {
      echo "<script>alert('Error al actualizar el stock');</script>";
      }
      }

      // Cerrar la conexión a la base de datos
      mysqli_close($conn);

      ?>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Escuchar el evento "change" en la caja de texto de stock
      $('input[name="stock_actualizado"]').on('change', function() {
        var productId = $(this).data('product-id');
        var quantityPurchased = $(this).val();

        // Realizar la solicitud AJAX para actualizar el stock
        $.ajax({
          url: window.location.href, // Enviar la solicitud al mismo archivo PHP
          type: 'POST',
          data: {
            action: 'update_stock',
            product_id: productId,
            quantity_purchased: quantityPurchased
          },
          success: function(response) {
            // Verificar la respuesta del servidor
            if (response.success) {
              // Éxito al actualizar el stock}
              //actualizar la pagina
              window.location.reload();
              alert(response.message);
            } else {
              // Error al actualizar el stock
              alert(response.message);
            }
          },
          error: function() {
            // Error en la solicitud AJAX
            alert('Error en la solicitud AJAX');
          }
        });
      });

      // Escuchar el evento "click" en los enlaces de eliminación
      $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        var confirmDelete = confirm('¿Estás seguro de que deseas eliminar este producto?');
        if (confirmDelete) {
          window.location.href = $(this).attr('href');
        }
      });
    });
  </script>
</body>
</html>
