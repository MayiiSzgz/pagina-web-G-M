document.addEventListener('DOMContentLoaded', function() {
    var carritoBtn = document.getElementById('carrito-btn');
    var btnShop = document.getElementsByClassName('btn-shop');
    var productIcons = document.getElementsByClassName('product__icon');
    var productList = JSON.parse(localStorage.getItem('carritoProductos')) || [];
  
    function updateCarritoBtn() {
      var totalItems = productList.reduce(function(acc, curr) {
        return acc + (curr.quantity || 0);
      }, 0);
  
      carritoBtn.textContent = 'Carrito ' + totalItems;
    }
  
    function addToCart(product) {
        var productName = product.getElementsByClassName('product__title')[0].textContent; // Obtener el nombre del producto
        var productPrice = parseFloat(product.getElementsByClassName('product__price')[0].textContent.replace('$', '')); // Obtener el precio del producto
        var stock = parseInt(product.dataset.stock); // Obtener el stock disponible del producto
        var poid = parseInt(product.dataset.id);
        productList.push({ name: productName, quantity: 1, price: productPrice, stock: stock, pid : poid });
        updateCarritoBtn();
        localStorage.setItem('carritoProductos', JSON.stringify(productList));
        alert('Producto agregado al carrito: ' + productName + '\nStock disponible: ' + stock + '\n id: ' + poid);
      }
      
      
  
    Array.from(btnShop).forEach(function(button) {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        var product = this.parentNode;
        addToCart(product);
      });
    });
  
    Array.from(productIcons).forEach(function(icon) {
      icon.addEventListener('click', function() {
        var product = this.parentNode;
        addToCart(product);
      });
    });
  
    updateCarritoBtn();
  });