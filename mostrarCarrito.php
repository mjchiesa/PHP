<?php
session_start();
//ession_destroy();
if (empty($_SESSION['active'])) {
    header('location:index.php');
}
if ($_SESSION['rol'] == 2) {
    header('location: inicioAdmin.php');
}
if(empty($_SESSION['CARRITO'])) {
    header('location:user3.php');
}
require 'conexion.php';
$mensaje = "";

if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'Agregar':
            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    $id = $_POST['id'],
                    $nombre = $_POST['nombre'],
                    $precio = $_POST['precio'],
                    $cantidad = $_POST['cantidad']
                                      
                );
                $_SESSION['CARRITO'][0] = $producto;
            } else {
                $encontre = 0;
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($_POST['id'] == $_SESSION['CARRITO'][$indice][0]) {
                        $_SESSION['CARRITO'][$indice][3] += 1;
                        $encontre = 1;
                    }
                }
                if ($encontre == 0) {
                    $numProductos = count($_SESSION['CARRITO']);
                    $producto = array(
                        $id = $_POST['id'],
                        $nombre = $_POST['nombre'],
                        $precio = $_POST['precio'],
                        $cantidad = $_POST['cantidad']
                                            
                    );
                    $_SESSION['CARRITO'][$numProductos] = $producto;
                    $encontre = 0;
                }
            }
            break;
            
             case 'Eliminar':
                $id = $_POST['id'];
            foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                if ($producto[0] == $id) {
                    //unset: funcion que elemina segun la sesion y un indice
                    unset($_SESSION['CARRITO'][$indice]);
                    echo "<script>alert('Elemento borrado');</script>";
                }
            }
            break;

        default:
            # code...
            break;
    }
}
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
    </div>
    <main id="largo">
        <div class="losdelmain row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Buscar"
                                    aria-label="Search">
                                <button class="cabtn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                        </div>
                    </nav>

                </div>

            </div>
        <br>
        <h3>Lista del Carrito</h3>

        <?php if ($_SESSION['CARRITO']) { ?>
        <table class="table table-light table-bordered">
            <tbody id="importes">
                <tr>
                    <th width="35%">Descripcion</th>
                    <th width="20%" class="text-center">Cantidad</th>
                    <th width="20%" class="text-center">Precio</th>
                    <th width="20%" class="text-center">Total</th>
                    <th width="05%" class="text-center">--</th>
                </tr>
                <?php $total = 0;
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                //   echo var_dump($_SESSION['CARRITO']); 
                ?>
                <tr>
                    <td width="35%"><?php echo $producto[1];?></td>
                    <td width="20%" class="text-center" ><?php echo $producto[3]; ?></td>
                    <td width="20%" class="text-center" >$<?php echo $producto[2]?></td>
                    <td width="20%" class="text-center">$<?php echo number_format($producto[3] * $producto[2], 2); ?></td>

                    <form action="mostrarCarrito.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $producto[0]; ?>">
                            <td width="05%"> <button class="btn4 btn-danger" type="submit" name="btnAccion"
                            value="Eliminar"><i class="far fa-trash-alt"></i></button></td>
                    </form>

                </tr>
                    <?php
                        $total += $producto[3] * $producto[2];
                    } ?>

                <tr>
                    <td colspan="3" align="right">
                        <h3>TOTAL</h3>
                    </td>
                    <td align="right">
                        <h3>$<?php echo number_format($total, 2) ?></h3>
                    </td>
                    <td></td>
                </tr>
                </tbody>
                <br>
        </table>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                No hay productos en el carrito
            </div>
        <?php } ?>
        <button class="btn5">
            <a href="user3.php">seguir comprando</a>

        </button>
        

        </main>
        <br>
        <br>
        
       

    <div class="maseta">
        <?php require_once 'footer.php'; ?>
    </div>
    <?php require_once 'scriptsBody.php'; ?>

</body>

</html>