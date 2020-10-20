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
	<br>
		<main>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div id="carousel1" class="carousel slide" data-ride="carousel">
  							<ol class="carousel-indicators">
    							<li data-target="#carousel1" data-slide-to="0" class="active"></li>
    							<li data-target="#carousel1" data-slide-to="1"></li>
    							<li data-target="#carousel1" data-slide-to="2"></li>
  							</ol>
  							<div class="carousel-inner">
    							<div class="carousel-item active">
      								<img class="d-block w-100" src="img/ima1.png" alt="First slide">
   				 				</div>
    							<div class="carousel-item">
      								<img class="d-block w-100" src="img/ima2.png" alt="Second slide">
    							</div>
    							<div class="carousel-item">
      								<img class="d-block w-100" src="img/ima3.png" alt="Third slide">
    							</div>
  							</div>
  							<a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
    							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    							<span class="sr-only">Previous</span>
 							</a>
  							<a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
    							<span class="carousel-control-next-icon" aria-hidden="true"></span>
    							<span class="sr-only">Next</span>
  							</a>
					</div>
					<br>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
							<a href="registrarse.php"><img src="img/tv.png" class="rounded-circle img-thumbnail mx-auto d-block img-fluid max-width:100% height:auto"></a>
							<p class="ofertas">televisores</p>
							<p class="ofertas2">32% off</p>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
							<h1 class="casa">Casa Terrazco</h1>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
							<a href="registrarse.php"><img src="img/lavarropas.png" class="rounded-circle img-thumbnail mx-auto d-block img-fluid max-width:100% height:auto"></a>
								<p class="ofertas">Lavarropas y Heladeras</p>
								<p class="ofertas2">40% off</p>
						</div>
					</div>
				</div>
				<section class="testi">
					<div class="container">
						<h1>Clientes Satisfechos</h1>
					</div>
					<div class="row">
						<div class="col-md-4 text-center">
							<div class="cliente">
								<img src="img/chubaca.jpg" class="clien">
								<blockquote>
									Totalmente satisfecho con mi compra!! Compre mi cortadora de pelo y gracias a <strong>Casa Terrazco</strong> Consegui mi papel en Star Wars.
									<h3><strong>Chewbacca</strong></h3>
								</blockquote>
							</div>
						</div>
						<div class="col-md-4 text-center">
							<div class="cliente">
								<img src="img/forrest.jpg" class="clien">
								<blockquote>
									Realice la compra de una cinta para correr, sin esta compra no podria haberme pegado la corrida que me pegue!! Gracias <strong>Casa Terrazco.</strong> 
									<h3><strong>Forrest Gump</strong></h3>
								</blockquote>
							</div>
						</div>
						<div class="col-md-4 text-center">
							<div class="cliente">
								<img src="img/dave.jpg" class="clien">
								<blockquote>
									No hay guitarras como las de <strong>Casa Terrazco!!</strong> My Hero la escribi pensado en ellos.
									<h3><strong>Dave Grohl</strong></h3>
								</blockquote>
							</div>
						</div>
					</div>
				</section>				
			</div>
		</main>
		<?php require_once 'footer.php'; ?>
	</div>

	<?php require_once 'scriptsBody.php'; ?>
</body>
</html>