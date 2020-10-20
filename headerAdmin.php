<header class="cabeza2">
	<div class="cabe row">
		<div class="col-md-12">
			<a href="#"><img src="img/cm_mc.png" alt="" class="logo"></a>
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