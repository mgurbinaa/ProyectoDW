<html>
	<head>
		<title>Publicación | DEALS</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<script type="text/javascript" src="../js/funciones.js"></script>
	</head>
	<body>
		<div id="encabezado">
			<div id="logo">
				<div id="imagen">
					<img src="../img/logo.png">
				</div>
				<div id="nombre">
					<h1>Deals</h1>
					<h5>Las mejores Ofertas</h5>
				</div>
			</div>

			<div id="menu">
				<ul>
					<a href="index.html"><li class="actual">Hot</li></a>
					<a href="login.html"><li>Iniciar sesion</li></a>
					<a href="compartir.html"><li>compartir</li></a>
				</ul>
			</div>
			<div id="busqueda">
				<input type="search" name="busqueda" placeholder="Buscar ...">
			</div>
		</div>

		<div id="datosPublicacion">
			<?php
			require_once("connect.php");
			require("DBFunctions.php");
			$con = conectar();
			$db = new Database($con);

			$datos = $db->getPubliData($_POST['idPubli']);
			if($datos->num_rows > 0){
				echo ""
			}

			?>
		</div>
	

	</body>
</html>