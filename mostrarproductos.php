<?php
$sentencia = $conexion->prepare("SELECT * FROM `productos`");
$sentencia->execute();
$listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($listaProductos);
?>
<?php
foreach ($listaProductos as $producto) { ?>
<div class="col-3">
    <div class="card">
        <img title="<?php echo $producto['PROD_MARCA']; ?>" alt="<?php echo $producto['PROD_MODELO']; ?>"
            class="card-img-top" src="<?php echo $producto['PROD_IMAGEN']; ?>" height="200px" width="200px"
            data-toggle="popover" data-trigger="hover" data-content="<?php echo $producto['PROD_PRECIO']; ?>"
            height="317px">
        <div class="card-body">
            <span><?php echo $producto['PROD_MODELO']; ?></span>
            <h5 class="card-title">$<?php echo $producto['PROD_PRECIO']; ?></h5>
            <p class="card-text"><?php echo $producto['PROD_DESC']; ?></p>

            <form action="" method="POST">

                <input type="hidden" name="id" id="id" value="<?php echo $producto['ID']; ?>">
                <input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['nombre']; ?>">
                <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio']; ?>">
                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1; ?>">

                <button class="btn btn-primary text-center" id="carro" name="btnAccion" value="Agregar" type="submit">
                    Agregar al Carrito
                </button>

            </form>


        </div>
    </div>
</div>
<?php  } ?>