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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SIBCO</title>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
                                <a class="canavv-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fas fa-user-circle"></i><?php echo $_SESSION['user']; ?></a>
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

        <main>
            <div class="losdelmain row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown">
                                    <a class="catenav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categorias</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Heladeras</a>
                                        <a class="dropdown-item" href="#">Lavarropas</a>
                                        <a class="dropdown-item" href="#">Televisores</a>
                                    </div>
                                </li>
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Buscar"
                                    aria-label="Search">
                                <button class="cabtn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                        </div>
                    </nav>

                </div>

            </div>
        </main>
        <section>
            <div class="container4">
            <div class="row">
                <?php
        $sentencia = "SELECT * FROM `productos` where TIPO_ID = 3";
        $listaProductos = mysqli_query($conexion, $sentencia);
        ?>
                <?php

        foreach ($listaProductos as $producto) { ?>

                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <div class="card">
                        <img title="<?php echo $producto['PROD_MARCA']; ?>"
                            alt="<?php echo $producto['PROD_MODELO']; ?>" class="card-img-top"
                            src="<?php echo $producto['PROD_IMAGEN']; ?>" height="200px" width="200px"
                            data-toggle="popover" data-trigger="hover"
                            data-content="<?php echo $producto['PROD_PRECIO']; ?>" height="317px">
                        <div class="card-body">
                            <span><?php echo $producto['PROD_MODELO']; ?></span>
                            <h5 class="card-title">$<?php echo $producto['PROD_PRECIO']; ?></h5>
                            <p class="card-text"><?php echo $producto['PROD_DESC']; ?></p>

                           <form action="mostrarCarrito.php" method="POST">

                                <input type="hidden" name="id" id="id" value="<?php echo $producto['PROD_ID']; ?>">
                                <input type="hidden" name="nombre" id="nombre"
                                    value="<?php echo $producto['PROD_MODELO']; ?>">
                                <input type="hidden" name="precio" id="precio"
                                    value="<?php echo $producto['PROD_PRECIO']; ?>">
                                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1; ?>">

                                <button class="btn btn-primary text-center" id="carro" name="btnAccion" value="Agregar"
                                    type="submit">
                                    Agregar al Carrito
                                </button>

                            </form>

                        </div>
                    </div>
                </div>

                <?php  } ?>
            </div>
            </div>
        </section>
        <?php require_once 'footer.php'; ?>


        <?php require_once 'scriptsBody.php'; ?>
</body>

</html>