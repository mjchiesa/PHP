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
                      	 <li><a href="registrarse.php">Registrarse</li></a>
                    	</ul>
               		 </nav>
				</div>
			</div>
		</header>
	
		<section class="main">
			 <div class="row d-flex justify-content-center align-items-center container ">
				      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					        <div class="formularioolvi">
                        		<form class="" >
					   	    		<h1 class="delForm">Olvide Contraseña</h1>
  				    		    	<div class="form-group" id="mail-group">
    			   	   		       		<input class="form-control" type="email" placeholder="Ingrese email:">
    				   		    	</div>
  				    		  	<button type="submit" class="btn btn-primary">Enviar</button>
  								</form>
                      		</div>    
				      </div>
			</div>
		</section>
		<?php require_once 'footer.php'; ?>
		
	</div>

	<?php require_once 'scriptsBody.php'; ?>
</body>
</html>