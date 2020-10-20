<?php

session_start();
	if (empty($_SESSION['active'])) {
		header('location: iniciar.php');
	}
	
include "conexion.php";

	
if (!empty($_POST)) {
	//esta validacion es para que si van al html y cambian el id por 1 no elimine el superadmin
	if ($_POST['idusuario'] == 1) {
		header('location: listarUsuarios.php');
		//mysqli_close($conexion);	
		exit;
	}	
	$idusuario = $_POST['idusuario'];
	//con este eliminamos
	//$query_eliminar = mysqli_query($conexion, "delete from usuarios where USU_ID = $idusuario");
	//con este dejamos inactivo
	$query_eliminar = mysqli_query($conexion, "update usuarios set USU_ESTADO = 0 where USU_ID = $idusuario");
	//mysqli_close($conexion);
	if ($query_eliminar) {
		header('location: listarUsuarios.php');	
	}else{
		echo "Error al eliminar";
	}

}
//request xq acepta GET o POST
if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1 ) {
	header('location: listarUsuarios.php');
	//mysqli_close($conexion);
}else{
	$idusuario = $_REQUEST['id'];

	$query = mysqli_query($conexion, "select  u.USU_MAIL, r.ROL_DESC 
											  from usuarios u
											  inner join 
											  roles r
											  on u.ROL_ID = r.ROL_ID
											  where u.USU_ID = $idusuario");
	//mysqli_close($conexion);
	$resul = mysqli_num_rows($query);

	if ($resul > 0 ) {
		while ($dato = mysqli_fetch_array($query)) {

			$user = $dato['USU_MAIL'];
			//$rol = $dato['ROL_ID'];
			$roldesc = $dato['ROL_DESC'];
		}	
	}else{
			header('location: listarUsuarios.php');
		}
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Eliminar Usuario</title>
	<?php require_once 'scripts.php'; ?>
</head>
<body>
	<div class="head2 container-fluid">
		<?php require_once 'headerAdmin.php' ?>
			<section>
				<div class="row">
					<div class="col-xs-10 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="data-delete">
							<h2>Esta seguro que desea eliminar el registro?</h2>
							<p>Usuario: <span><?php echo $user; ?></span> </p>
							<p>Tipo Usuario: <span><?php echo $roldesc; ?></span></p>
						<form class="eliusu" method="POST" action="">	
								<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">						
								<a href="modiEli.php" class="btn_cancelar">Cancelar</a>
    							<input class="btn_ok" name="submit" value="Aceptar" type="submit">
    					</form>						

						</div>
					</div>
				</div>
			</section>
	</div>
	<?php require_once 'scriptsBody.php'; ?>
</body>
</html>


