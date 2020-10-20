<?php  
session_start();
	if (empty($_SESSION['active'])) {
		header('location: iniciar.php');
	}

include "conexion.php";

if (!empty($_POST)) {
	$alertas = '';
	if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['telefono']) || empty($_POST['email']) || empty($_POST['rol'])) {
		$alertas = '<p class = "msg_error"> Todos los campos son obligatorios.</p>';
	}else{
		$idUsuario = $_POST['idUsuario'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$telefono = $_POST['telefono'];
		$user = $_POST['email'];
		$password = md5($_POST['password']);
		$rol = $_POST['rol'];

		$query = mysqli_query($conexion, "select * from usuarios where (USU_MAIL = '$user' and USU_ID != $idUsuario)");

		$resultado = mysqli_fetch_array($query);

		if ($resultado >0) {
			$alertas = '<p class = "msg_error">El correo Ingresado ya esta registrado.</p>';
		}else{
			if(empty($_POST['password'])){
				$sql_update = mysqli_query($conexion, "update usuarios set  USU_NOMBRE = '$nombre', USU_APELLIDO = '$apellido', USU_MAIL = '$user', USU_TEL = '$telefono', ROL_ID = '$rol' where USU_ID = $idUsuario");
			}else{
				$sql_update = mysqli_query($conexion, "update usuario set  USU_NOMBRE = '$nombre', USU_APELLIDO = '$apellido', USU_MAIL = '$user', USU_CLAVE= '$password',  USU_TEL = '$telefono', USU_ESTADO = 1,ROL_ID = '$rol' where USU_ID = $idUsuario");
			}

			if ($sql_update) {
				$alertas = '<p class = "msg_save"> Usuario actualizado exitosamente.</p>';		
			}else{
				$alertas = '<p class = "msg_error"> Error al actualizar el usuario.</p>'; 
			}

		}
	}
}

//Mostramos los datos
	if (empty($_GET['id'])) {
		header('location: listarUsuarios.php');
	}
	$iduser = $_GET['id'];

	$sql = mysqli_query($conexion, "select u.USU_ID, u.USU_NOMBRE, u.USU_APELLIDO, u.USU_MAIL, u.USU_TEL, (u.ROL_ID) AS ROL_ID, (r.ROL_DESC) AS ROL_DESC
		from usuarios u
		inner join roles r
		on u.ROL_ID = r.ROL_ID
		where USU_ID = $iduser");

	$resul_sql = mysqli_num_rows($sql);

	if ($resul_sql == 0) {
		header('location: listarUsuarios.php');
	}else{
		$option = '';
		while ($dato = mysqli_fetch_array($sql)) {
			$iduser = $dato['USU_ID'];
			$nombre = $dato['USU_NOMBRE'];
			$apellido = $dato['USU_APELLIDO'];
			$user = $dato['USU_MAIL'];
			$telefono = $dato['USU_TEL'];
			$rol = $dato['ROL_ID'];
			$roldesc = $dato['ROL_DESC'];

			if ($rol == 1) {
				$option = '<option value="'.$rol.'" select>'.$roldesc.'</option>';
			}else if($rol == 2){
				$option = '<option value="'.$rol.'" select>'.$roldesc.'</option>';
			}
			
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Usuario</title>
	<?php require_once 'scripts.php'; ?>
</head>
<body>
	<div class="head2 container-fluid">
		<header class="cabeza2">
			<div class="cabe row">
				<div class="col-md-12">
					<a href="index.php"><img src="img/cm_mc.png" alt="" class="logo"></a>
              			<nav>
                  			<ul>
                    			<li class="nav-item dropdown">
        							<a class="canav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i><?php echo $_SESSION['user'];?></a>
        					    	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
          						    	<a class="dropdown-item" href="salir.php"><span>Cerrar Sesion</span></a>
        							</div>
                      			</li>
                 			</ul>
              			</nav>
				</div>
			</div>
			
		</header>
			<div class="container-fluid">
				<section id="iniAdmin">
					<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<nav id="menuAdmin" >
							<ul id="menuul">
								<li id="item"><a href="inicioAdmin.php">Inicio</a></li>
								<li id="item"><a href="#">Usuarios</a>
									<ul id="submenu">
										<li id="desple" ><a href="registroUsuario.php">Agregar usuario</a></li>
										<li id="desple"><a href="listarUsuarios.php">Eliminar/Modificar usuario</a></li>
									</ul>
								</li>
								<li id="item"><a href="#">Productos</a>
									<ul id="submenu">
										<li id="desple"><a href="#">Agregar producto</a></li>
										<li id="desple"><a href="#">Eliminar/Modificar producto</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
					</div>				
				</section>
			</div>
			<section>
				<div class="row">
				<div class="formu col-xs-4 col-sm-7 col-md-5 col-lg-4 col-xl-3 ">
					<form  action="" method="POST">
						<h1 class="delForm1">Registrar Usuario</h1>
						<input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
  						<div class="form-group" id="user-group">
    						<input class="form-control" name="nombre" type="text" id="nombre" placeholder="Ingrese Nombre:" value="<?php echo $nombre; ?>">
    						
  						</div>
  						<div class="form-group" id="ape-group">
    				   		<input class="form-control" name="apellido" type="text" id="apellido" placeholder="Ingrese Apellido:" value="<?php echo $apellido; ?>">
    				   		
  						</div>
  						<div class="form-group" id="cel-group">
    				   		<input class="form-control" name="telefono" type="number" id="telefono" placeholder="Ingrese Celular:" value="<?php echo $telefono; ?>">
    				   		
  						</div>
  						<div class="form-group" id="mail-group">
    				   		<input class="form-control" name="email" type="email" id="email" placeholder="Ingrese email:" value="<?php echo $user; ?>">
    				   		
  						</div>
  						<div class="form-group" id="pass-group">
    				   		<input class="form-control" type="password" name="password" id="password" placeholder="Ingrese contraseña:" >
    				   		
  						</div>
  						<div class="form-group" id="rol-group">
    				   		<?php 
    				   			$query_rol = mysqli_query($conexion, "select * from roles");
    				   			$resultado_rol = mysqli_num_rows($query_rol);
    				   		?>

  						 	<select name="rol" id="rol" name="rol" class="itemVacio form-control">
  						 	<?php 
  						 		echo $option; 
  						 		if (condition) {
    				   				while($rol = mysqli_fetch_array($query_rol)){
    				   		?>
    				   			<option value="<?php echo $rol['ROL_ID'] ?>"><?php echo $rol['ROL_DESC'] ?></option>	
    				   		<?php 			
    				   				}	
    				   			}			
  						 	?>		
  						 	
  						 	</select>
  						 </div>
  						<button type="submit" class="bb btn btn-primary" value="Ingresar" id="guardar">Actualizar Usuario</button>
  		    		</form>
  		    		<div class="alertas"><?php echo isset($alertas) ? $alertas : ''; ?></div>
			</section>
			 
	</div>
	<?php require_once 'scriptsBody.php'; ?>
</body>
</html>


