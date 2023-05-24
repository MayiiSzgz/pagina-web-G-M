// Función para generar y descargar el ticket de compra como imagen
function downloadTicketAsImage() {
    // Obtiene el elemento que contiene el carrito de compras
    var carritoContainer = document.querySelector('.carrito-container');
  
    // Genera una imagen a partir del elemento del carrito utilizando html2canvas
    html2canvas(carritoContainer).then(function(canvas) {
      // Crea un enlace para descargar la imagen
      var downloadLink = document.createElement('a');
      downloadLink.href = canvas.toDataURL('image/png');
      downloadLink.download = 'ticket_compra.png';
      
      // Simula el clic en el enlace para iniciar la descarga
      downloadLink.click();
    });
  }
  