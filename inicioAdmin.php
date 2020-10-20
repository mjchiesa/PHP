<?php  

	session_start();
	if (empty($_SESSION['active'])) {
		header('location: iniciar.php');
	}

	if ($_SESSION['rol'] == 1) {
	header('location: user3.php');

}	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio Administrador</title>
	<?php require_once 'scripts.php'; ?>
</head>
<body>
	<div class="head2 container-fluid">
		<?php require_once 'headerAdmin.php' ?>
	</div>
	<?php require_once 'scriptsBody.php'; ?>
</body>
</html>