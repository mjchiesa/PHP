<?php  

	session_start();
	
	//if (empty($_SESSION['active'])) {
	//	header('location: iniciar.php');
	//}
	if ($_SESSION['rol'] == 1) {
	header('location: user3.php');

}	
include "conexion.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar Usuario</title>
	<?php require_once 'scripts.php'; ?>
</head>
<body>
	<div class="head2 container-fluid">
		<?php require_once 'headerAdmin.php' ?>
				<section id="lista_gral">
						<h1 class="lista">Lista de Usuarios</h1>
					<div class="row">
						<div class="col-xs-10 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<form action="buscarUsuarios.php" method="GET" class="buscarUser">
								<input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." >
								<input type="submit" value="buscar" class="btn-buscar">
							</form>
					<table class="table" id="tabla">
						<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Celular</th>
							<th scope="col">Usuario</th>
							<th scope="col">Estado</th>
							<th scope="col">Rol</th>
							<th scope="col">Acciones</th>
						</tr>
						</thead>
						<?php 
							//paginador
							$sql_registros = mysqli_query($conexion, "select count(*) as total_registro from usuarios where USU_ESTADO = 1");
							$resul_registros = mysqli_fetch_array($sql_registros);
							$total_registro = $resul_registros['total_registro'];

							$por_pagina = 4;

							if (empty($_GET['pagina'])) {
								$pagina = 1;
							}else{
								$pagina = $_GET['pagina'];
							}

							$desde = ($pagina - 1) * $por_pagina;
							$total_paginas = ceil($total_registro / $por_pagina); 

							$query = mysqli_query($conexion, "SELECT u.USU_ID, u.USU_NOMBRE, u.USU_APELLIDO, u.USU_MAIL, u.USU_TEL,u.USU_ESTADO, r.ROL_DESC from usuarios u INNER JOIN roles r ON u.ROL_ID = r.ROL_ID where u.USU_ESTADO = 1 
								order by u.USU_ID asc
								limit $desde,$por_pagina 
								 ");

							//mysqli_close($conexion);
							$resul = mysqli_num_rows($query);
							if ($resul > 0) {
								while ($data = mysqli_fetch_array($query)) {
						?>
									<tbody>
										<tr>
											<td><?php echo $data['USU_ID'] ?></td>
											<td><?php echo $data['USU_NOMBRE'] ?></td>
											<td><?php echo $data['USU_APELLIDO'] ?></td>
											<td><?php echo $data['USU_TEL'] ?></td>
											<td><?php echo $data['USU_MAIL'] ?></td>
											<td><?php echo $data['USU_ESTADO'] ?></td>
											<td><?php echo $data['ROL_DESC'] ?></td>
											<td>
											<a href="modificarUsu.php?id=<?php echo $data['USU_ID'] ?>" id="edit">Editar</a>
											<!--PARA EL SUPER ADMIN QUE NO APAREZACA ELIMINAR-->
											<?php if ($data['USU_ID'] != 1) { ?>
											|
											<a href="eliminarUsuario.php?id=<?php echo $data['USU_ID'] ?>" id="elim">Eliminar</a>
										<?php } ?>
											</td>
										</tr>
									</tbody>
						<?php  			
								}
								
							}
						?>	
					</table>

					<div class="paginador">
						<ul>
							<?php if ($pagina !=1) {
								
							 ?>

							<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
							<li><a href="?pagina=<?php echo $pagina - 1; ?>"><<</a></li>
							<?php
							} 
								for ($i=1; $i <= $total_paginas ; $i++) { 
									if ($i == $pagina) {
										echo '<li class="parada">'.$i.'</li>';	
									}else{
										echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
									}
								}

								if ($pagina != $total_paginas) {
									
								?>
														
							<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
							<li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
						</ul>
					<?php } ?>
					</div>
				</section>
				</div>
				</div>
			</div>
	</div>
	<?php require_once 'scriptsBody.php'; ?>
</body>
</html>

 