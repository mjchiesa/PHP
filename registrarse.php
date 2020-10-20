<?php
require 'conexion.php';
require 'funcs.php';

$errors = array();

if (!empty($_POST)) {
    $nombre = $conexion->real_escape_string(limpiarDatos($_POST['nombre']));
    $apellido = $conexion->real_escape_string(limpiarDatos($_POST['apellido']));
    $telefono = $conexion->real_escape_string(limpiarDatos($_POST['telefono']));
    $password = $conexion->real_escape_string($_POST['contraseña']);
    $con_password = $conexion->real_escape_string($_POST['recontraseña']);
    $email = $conexion->real_escape_string(limpiarDatos($_POST['email']));
    $estado = 0;
    $tipo_rol = 1;
    $rese_id = 0;

    if (isNull($nombre, $telefono, $password, $con_password, $email)) {
        $errors[] = 'Llene todos los campos por favor';
    } else {

        if (!isLetra($apellido)) {
            $errors[] = 'Ingrese solo letras en el apellido';
        }

        if (minMax(3, 30, $apellido)) {
            $errors[] = 'El apellido debe tener un minimo de 3 letras';
        }

        if (!isLetra($nombre)) {
            $errors[] = 'Ingrese solo letras en el nombre';
        }

        if (minMax(3, 30, $nombre)) {
            $errors[] = 'El nombre debe tener un minimo de 3 letras';
        }

        if (!isNumero($telefono)) {
            $errors[] = 'Ingrese solo numeros en el telefono';
        }

        if (!isEmail($email)) {
            $errors[] = 'Direccion de email invalida';
        }

        if (!validaPassword($password, $con_password)) {
            $errors[] = 'Las contaseñas no coinciden';
        } else {
            if (minMax(6, 10, $password)) {
                $errors[] = 'La contraseña debe comprender entre 6 y 10 caracteres';
            }
        }

        if (emailExiste($email)) {
            $errors[] = "El email $email ya existe";
        }
    }
    if (count($errors) == 0) {
        $hash_password = md5($password);
        $registro = registraUsuario($nombre, $apellido, $email, $hash_password, $telefono, $estado, $tipo_rol, $rese_id);

        if ($registro > 0) {
            $url = 'http://' . $_SERVER["SERVER_NAME"] . '/activar.php?id=' . $registro;
            $asunto = 'Activar Cuenta - SIBCO';
            $cuerpo = "Estimado $nombre: Para continuar con el proceso de registro de click en el siguiente enlace
            <a href='$url'> </a>";

            if (enviarEmail2($email, $nombre, $asunto, $cuerpo)) {
                echo "Para terminar el proceso de registracion se envio al correo $email un enlace para actviar la cuenta";
                echo "<a href='index.php' > Iniciar Sesion</a>";
                exit;
            } else {
                $errors[] = 'Error al enviar el email';
            }
        } else {
            $errors[] = 'Error al registrar';
        }
    }
}
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
  <div class="container-fluid">
    <header class="header-gral">
      <div class="row">
        <div class="col-md-12">
          <a href="index.php"><img src="img/cm_mc.png" alt="" class="logo"></a>
                  <nav>
                      <ul>
                          <li><a href="iniciar.php">Iniciar Sesion</li></a>
                      </ul>
                   </nav>
        </div>
      </div>
    </header>
  
    <main>
      <div class="row">
        <div class="formu col-xs-4 col-sm-7 col-md-5 col-lg-4 col-xl-3 ">
          <form action="" method="POST">
            <h1 class="delForm1">Registrate</h1>
              <div class="form-group" id="user-group">
                <input class="form-control" name="nombre" type="text" id="nombre" placeholder="Ingrese Nombre:">
                
              </div>
              <div class="form-group" id="ape-group">
                  <input class="form-control" name="apellido" type="text" id="apellido" placeholder="Ingrese Apellido:">
                  
              </div>
              <div class="form-group" id="cel-group">
                  <input class="form-control" name="telefono" type="number" id="telefono" placeholder="Ingrese Celular:">
                  
              </div>
              <div class="form-group" id="mail-group">
                  <input class="form-control" name="email" type="email" id="email" placeholder="Ingrese email:">
                  
              </div>
              <div class="form-group" id="pass-group">
                  <input class="form-control" type="password" name="contraseña" id="password" placeholder="Ingrese contraseña:">
                  
              </div>
              <div class="form-group" id="repass-group">
                  <input class="form-control" type="password" name="recontraseña" id="password2" placeholder="vuelva a ingresar su contraseña:">
                  
              </div>
               <a href="index.php" class="btn btn-primary">Volver</a>
              <button type="submit" class="btn btn-primary" value="Ingresar" id="registrar">Enviar</button>
              <p class="cuenta2">ya tienes cuenta? <a href="iniciar.php" class="hiper"> Inicia Sesion</a></p>
              
              <?php echo resultBlock($errors); ?>

          </form>
             
        </div>
      </div>
    </main>
    <?php require_once 'footer.php'; ?>
    
  </div>

  <?php require_once 'scriptsBody.php'; ?>
</body>
</html>

