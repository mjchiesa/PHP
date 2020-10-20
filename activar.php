<?php
require 'conexion.php';
include 'funcs.php';


if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];
    $mensaje = validaId($idUsuario);
}
?>
<html>

<head>
    <title>Registro</title>


</head>

<body>
    <div class="container">
        <div class="jumbotron">

            <h1><?php echo $mensaje; ?></h1>

            <br />
            <p><a class="" href="index.php" role="button">Iniciar Sesion</a></p>
        </div>
    </div>
</body>

</html>