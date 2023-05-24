<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="img/1 (2).jpg">
</head>
<body>
    <header class="main-header">
        <div class="container container--flex">
            
            <div class="main-header__container">
                <h1 class="main-header__title">Detalles G&M</h1>
                <span class="icon-menu" id="btn-menu"><i class="fa-solid fa-bars"></i></span>  
                <nav class="main-nav" id="main-nav">
                    <ul class="menu">
                        <li class="menu__item"><a href="index.html" class="menu__link">Inicio</a></li>
                        <li class="menu__item"><a href="acerca.html" class="menu__link">Acerca de</a></li>
                        <li class="menu__item"><a href="" class="menu__link">Opciones</a></li>
                        <li class="menu__item"><a href="tienda.html" class="menu__link">Tienda</a></li>
                        <li class="menu__item"><a href="contact.html" class="menu__link">Contacto</a></li>
                    </ul>
                </nav>
            </div>

            <div class="main-header__container">
                <span class="main-header__txt">Necesito Ayuda</span>
                <p class="main-header__txt"><i class="fa-solid fa-phone"></i> call 7229056613</p>
            </div>

            <div class="main-header__container">
                <a href="login.html" class="main-header__link"><i class="fa-sharp fa-solid fa-circle-user"></i> </a>
                <a href="carrito.html" class="main-header__btn" id="carrito-btn">Carrito <span id="carrito-count">0</span> <i class="fa-solid fa-cart-shopping"></i></a>

                <input type="search" class="main-header__input" placeholder="Buscar prodcutos"> <i class="fa-solid fa-magnifying-glass"></i>
            </div>

        </div>
    </header>

    <div class="container-slider">
        <div class="slider" id="slider">
            <div class="slider__section">
                <img src="img/1 (2).jpg" alt="" class="slider__img">
                <div class="slider__content">
                    <h2 class="slider__title">Beatiful</h2>
                    <p class="slider__txt">25% de descuento</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
            </div>
            <div class="slider__section">
                <img src="img/2.jpg" alt="" class="slider__img">
                <div class="slider__content">
                    <h2 class="slider__title">Happy birthday</h2>
                    <p class="slider__txt">10% de descuento</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
            </div>
            <div class="slider__section">
                <img src="img/3.jpg" alt="" class="slider__img">
                <div class="slider__content">
                    <h2 class="slider__title">Sorpresa</h2>
                    <p class="slider__txt">15% de descuento</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
            </div>
            <div class="slider__section">
                <img src="img/4.jpg" alt="" class="slider__img">
                <div class="slider__content">
                    <h2 class="slider__title">Desayunos </h2>
                    <p class="slider__txt">50% de descuento</p>
                    <a href="" class="btn-shop">COMPRAR </a>
                </div>
            </div>
            <div class="slider__section">
                <img src="img/5.jpg" alt="" class="slider__img">
                <div class="slider__content">
                    <h2 class="slider__title">Regalos</h2>
                    <p class="slider__txt">25% de descuento</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
            </div>
            <div class="slider__section">
                <img src="img/7.jpg" alt="" class="slider__img">
                <div class="slider__content">
                    <h2 class="slider__title">Beatiful</h2>
                    <p class="slider__txt">10% de descuento</p>
                    <a href="" class="btn-shop">COMPRAR </a>
                </div>
            </div>
            <div class="slider__section">
                <img src="img/8.jpg" alt="" class="slider__img">
                <div class="slider__content">
                    <h2 class="slider__title">Beatiful</h2>
                    <p class="slider__txt">30% de descuento</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
            </div>
        </div>
        <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
        <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
    </div>
    <main class="main">
        <div class="container">
            <h2 class="main-title">Nuevos articulos para ti</h2>
            <section class="container-products">
            <?php
                // Incluir el archivo de conexión a la base de datos
                require_once 'db.php';

                // Obtener los productos con stock disponible
                $query = "SELECT * FROM productos WHERE stock > 0";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die('Error al obtener los productos: ' . mysqli_error($conn));
                }

                // Mostrar la cantidad de productos disponibles y su descripción
                $count = mysqli_num_rows($result);
                echo "<h2>Productos disponibles</h2>
                <br>
                <br>
                <br>
                <p>Actualmente tenemos " . $count . " productos disponibles.</p>
                <br>";

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='product' data-id='" . $row['id'] . "' data-stock='" . $row['stock'] . "'>";
                        echo "<img src='img/" . $row['imagen'] . "' alt='' class='product__img'>";
                        echo "<div class='product_description'>";
                        echo "<h3 class='product__title'>" . $row['nombre'] . "</h3>";
                        echo "<span class='product__price'>$" . $row['precio'] . "</span>";
                        echo "</div>";
                        echo "<i class='product__icon fa-solid fa-cart-plus'></i>";
                        echo "</div>";
                    }
                }else {
                    echo "<p>No hay productos disponibles en este momento.</p>";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conn);
                ?>

                </section>
                

                <div class="container-slider__opinion">
                    <h2 class="section__title2">Opiniones</h2>
                    <div class="slider2" id="slider2">
                      <div class="slider__section2">
                        <div class="slider__content2">
                            <h3 class="testimonial__title">Luisa</h3>
                            <p class="testimonial__txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione repellat a odit cupiditate consequatur aliquid aspernatur adipisci amet impedit doloribus, maiores ex, quaerat tenetur numquam temporibus cumque, dignissimos repellendus iusto.</p>
                             
                        </div>
                      </div>
                      <div class="slider__section2">
                        <div class="slider__content2">
                            <h3 class="testimonial__titles">Luisa</h3>
                            <p class="testimonial__txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione repellat a odit cupiditate consequatur aliquid aspernatur adipisci amet impedit doloribus, maiores ex, quaerat tenetur numquam temporibus cumque, dignissimos repellendus iusto.</p>
                             
                        </div>
                      </div>
                      <div class="slider__section2">
                        <div class="slider__content2">
                            <h3 class="testimonial__title">Luisa</h3>
                            <p class="testimonial__txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione repellat a odit cupiditate consequatur aliquid aspernatur adipisci amet impedit doloribus, maiores ex, quaerat tenetur numquam temporibus cumque, dignissimos repellendus iusto.</p>
                             
                        </div>
                      </div>
                      <div class="slider__section2">
                        <div class="slider__content2">
                            <h3 class="testimonial__title">Luisa</h3>
                            <p class="testimonial__txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione repellat a odit cupiditate consequatur aliquid aspernatur adipisci amet impedit doloribus, maiores ex, quaerat tenetur numquam temporibus cumque, dignissimos repellendus iusto.</p>
                             
                        </div>
                      </div>
                    </div>
                    <div class="slider__btn2 slider__btn--right2" id="btn-right2">&#62;</div>
                    <div class="slider__btn2 slider__btn--left2" id="btn-left2">&#60;</div>
                  </div>




                


            <div class="container-editor">
                <div class="editor__item"> 
                    <img src="img/8.jpg" alt="" class="editor__img">
                    <p class="editor__circle">EXPRESA TU AMOR </p>
                </div>
                <div class="editor__item"> 
                    <img src="img/9.jpg" alt="" class="editor__img">
                    <p class="editor__circle">EXPRESA TU AMOR </p>
                </div>

            </div>

            <section class="container-tips">
                <div class="tip">
                    <i class="fa-solid fa-heart"></i>
                    <h2 class="tip__title">Granatizado</h2>
                    <p class="tip__txt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nobis eligendi praesentium itaque amet doloribus temporibus repellat, neque quis dolorum deleniti inventore debitis a odio dolorem incidunt possimus suscipit excepturi?</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
                <div class="tip">
                    <i class="fa-solid fa-rocket"></i>
                    <h2 class="tip__title">Envio Rapido</h2>
                    <p class="tip__txt">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea rerum labore natus, exercitationem, blanditiis minima ad voluptate odio id earum nisi explicabo laborum hic amet ullam omnis mollitia adipisci aspernatur?</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
                <div class="tip">
                    <i class="fa-solid fa-gear"></i>
                    <h2 class="tip__title">Soporte</h2>
                    <p class="tip__txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis architecto dolorum harum, ea beatae perspiciatis tenetur officiis dolor? Ducimus autem iste non voluptatem beatae cupiditate perferendis dolores sunt libero eos?</p>
                    <a href="" class="btn-shop">COMPRAR</a>
                </div>
            </section>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer__section">
            <h2 class="footer__title">Acerca de Nosotros</h2>
            <p class="footer__txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit nobis id non sequi ad voluptate tempora officiis, enim dolorem quos amet sunt iste mollitia aspernatur saepe tenetur modi eligendi explicabo.</p>
        </div>
        <div class="footer__section">
            <h2 class="footer__title">Direccion</h2>
            <p class="footer__txt">San Antonio la Isla, Estado de Mexico.</p>
            <h2 class="footer__Title">Contacto</h2>
            <p class="footer__txt">Telefono 7229056613</p>
            <p class="footer__text">Email: cajasg&m@gmail.com</p>
        </div>
        <div class="footer__section">
            <h2 class="footer__title">Enlace directo</h2>
            <a href="" class="footer__link">Inicio</a>
            <a href="" class="footer__link">Acerca de</a>
            <a href="" class="footer__link">Error</a>
            <a href="" class="footer__link">Tienda</a>
            <a href="" class="footer__link">Contactanos</a>
            
        </div>
        <div class="footer__section">
            <h2 class="footer__title">Registro para tus ofertas</h2>
            <p class="footer__txt">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam consequuntur a veniam eos neque architecto perferendis magnam porro temporibus exercitationem ea natus, ullam saepe voluptas animi fugiat maiores iure enim.</p>
            <input type="email" class="footer__input" placeholder="Ingresa tu e-mail">
        </div>
        <p class="copy">© 2023 Detalles G&M. Todos los derechos reservados </p>

    </footer>
    <!--genera un boton para subir-->
    <a href="#" class="btn-up"><i class="fas fa-arrow-up"></i></a>
    


    <script src="js/slider.js"></script>
    <script src="js/slider2.js"></script>
    //carrito.js
    <script src="js/carrito.js"></script>
  

  


    
</body>
</html>