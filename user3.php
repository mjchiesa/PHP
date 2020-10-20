<?php  
session_start();
if (empty($_SESSION['active'])) {
  header('location:index.php');
}
if ($_SESSION['rol'] == 2) {
  header('location: inicioAdmin.php');

} 
require 'conexion.php';
require 'funcs.php';


$mensaje = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>SIBCO</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <?php require_once "scripts.php"; ?>
</head>
<body>
  <div class="head container-fluid">
    <header class="cabeza">
      <div class="row">
        <div class="col-md-12">
          <a href="user3.php"><img src="img/cm_mc.png" alt="" class="logo"></a>
              <nav>
                  <ul>
                      <li class="nav-item dropdown">
                         <a class="canavv-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i><?php echo $_SESSION['user'];?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                           <a class="dropdown-item" href="#"><span>Datos Personales</span></a>
                           <a class="dropdown-item" href="#"><span>Mis Reservas</span></a>
                           <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="salir.php"><span>Cerrar Sesion</span></a>
                         </div>
                      </li>
                  </ul>
              </nav>
        </div>
      </div>
    </header>
  <br>
  </div>
    <main>
      <div class="losdelmain row">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-light bg-dark">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item active">
                        <a class="catenav-link" href="mostrarCarrito.php"><i class="fas fa-shopping-cart"></i>(<?php 
                             echo (empty($_SESSION['CARRITO']))? 0 : count($_SESSION['CARRITO']);
                      ?>)</a>
                      </li>
                      <li class="nav-item active">
                        <?php if ($mensaje !="") { ?>
                               <?php echo $mensaje; ?>
                                <a class="catenav-link" href="mostrarCarrito.php"><i class="fas fa-shopping-cart"></i></a>
                             
                         <?php } ?>
                        <?php 
                          $sentencia= "SELECT * FROM `productos`";
                          $listaProductos = mysqli_query($conexion, $sentencia);
                        ?>
                          
                       </li>

                    </ul>
                    
                            
                  <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                      <button class="cabtn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                     </form>
                </div>
                
                 
        
        </nav>
         
        
      </div>
<br>
      <div class="losdelmain row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div id="carousel1" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel1" data-slide-to="1"></li>
                  <li data-target="#carousel1" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img class="d-block w-100" src="img/ima1.png" alt="First slide">
                  </div>
                  <div class="carousel-item">
                      <img class="d-block w-100" src="img/ima2.png" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                      <img class="d-block w-100" src="img/ima3.png" alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
              </a>
                <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
          </div>
          <br>
        </div>
        <div class="container">
          <div class="losdelmain row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <a href="tele.php"><img src="img/tv.png" class="rounded-circle img-thumbnail mx-auto d-block img-fluid max-width:100% height:auto"></a>
              <p class="ofertas">televisores</p>
              <p class="ofertas2">32% off</p>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <h1 class="casa">Casa Terrazco</h1>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <a href="lava.php"><img src="img/lavarropas.png" class="rounded-circle img-thumbnail mx-auto d-block img-fluid max-width:100% height:auto"></a>
                <p class="ofertas">Lavarropas y Heladeras</p>
                <p class="ofertas2">40% off</p>
            </div>
          </div>
        </div>
      </div>
    <section>
      <div class="container4" id="catt">
        <h2 class="sema">CATEGORIAS</h2>
                 
           <div class="site-section site-blocks-2">
        <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-4 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
            <a class="block-2-item" href="tele.php">
              <figure class="image">
                <img src="img/tv.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                
                <h3 id="cate">Televisores</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
            <a class="block-2-item" href="hela.php">
              <figure class="image">
                <img src="img/hela.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                
                <h3 id="cate">Heladeras</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
            <a class="block-2-item" href="lava.php">
              <figure class="image">
                <img src="img/lava.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                
                <h3 id="cate">Lavarropas</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
              
      </div>
     
        
    </section>  
      <br>
    </main>
    <?php require_once 'footer.php'; ?>
    
  
  <?php require_once 'scriptsBody.php'; ?>
  
</body>
</html>