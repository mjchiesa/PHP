<?php  

include 'funcs.php';
	$alert ='';

session_start();


if (!empty($_POST)) {

	if (empty($_POST['email'] || empty($_POST['password']))) {
		$alert = 'Ingrese usuario y contraseña';

	}else{
		require_once "conexion.php";
		//para encriptar la contraseña
		$user = mysqli_real_escape_string ($conexion, $_POST['email']);
		$pass = md5(mysqli_real_escape_string($conexion, $_POST['password']));

		$query = mysqli_query($conexion, "select * from usuarios where USU_MAIL = '$user' and USU_CLAVE = '$pass'");
		//mysqli_close($conexion);
		$resul = mysqli_num_rows($query);

		if ($resul > 0) {
		    $dato = mysqli_fetch_array($query);
			
			$_SESSION['active'] = true;
			$_SESSION['iduser'] = $dato['USU_ID'];
			$_SESSION['nombre'] = $dato['USU_NOMBRE'];
			$_SESSION['apellido'] = $dato['USU_APELLIDO'];
			$_SESSION['telefono'] = $dato['USU_TEL'];
			$_SESSION['estado'] = $dato['USU_ESTADO'];
			$_SESSION['user'] = $dato['USU_MAIL'];
			$_SESSION['rol'] = $dato['ROL_ID'];
            if (isActivo($_POST['email'])){
			    if ($_SESSION['rol'] == 1) {
				    header('location: user3.php');

			    }else if ($_SESSION['rol'] == 2) {
				    header('location: inicioAdmin.php');
			
			    }
		    }else{
		        $alert = 'el usuario no esta activo';
			session_destroy();
		    }	
		}else{
			$alert = 'el usuario o clave incorrecto';
			session_destroy();
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
                      	 <li><a href="registrarse.php">Registrarse</li></a>
                    	</ul>
               		 </nav>
				</div>
			</div>
		</header>
	
		<section class="main">
			 <div class="row d-flex justify-content-center align-items-center container ">
				<div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-xl-6">
				    <div class="formularioini">
                	    <form class="" method="POST">
					        <h1 class="delForm">Iniciar Sesion</h1>
  				            <div class="form-group" id="mail-group">
    			   		        <input class="form-control" name="email" type="email" placeholder="Ingrese email:">
    				   	    </div>
  				    	    <div class="form-group" id="pass-group">
    			   	   	        <input class="form-control" name="password" type="password" placeholder="Ingrese contraseña:">
    			   	        </div>
			 	           <button type="submit" value="ingresar" class="btn btn-primary">Enviar</button>
			 	           <p class="cuentaa">Olvidaste tu contraseña? <a href="olvido.php" class="link">presiona aqui</a></p>
						  <div class="alerttt"><?php echo isset($alert) ? $alert : ''; ?></div>
		               </form>
					              
                    </div>    
				</div>
			</div>
		</section>
	</div>
    <?php require_once 'scriptsBody.php'; ?>
	
</body>
</html>