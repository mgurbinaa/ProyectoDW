<?php
session_start();
include('conexion.php');
$conexion = conexion ();
if(!isset($_SESSION['id_user'])){
	header('location:login.php');
}

$id_user = $_SESSION['id_user'];
$query  = "SELECT * FROM users where id_user = ".$id_user;
$usuarioQuery = consulta($query);
?>
<html>
	<head>
		<title>Publicación | DEALS</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<script type="text/javascript" src="../js/funciones.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,900" rel="stylesheet">
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
					<a href="index.php"><li class="actual">Hot</li></a>
					<a href="crearPublicacion.php"><li>compartir</li></a>
					<a href="contactos.php"><li>contactanos</li></a>
				</ul>

	<table>
		<?php 
		while($rUsu = mysqli_fetch_array($usuarioQuery)):
			?>
		<tr>
		<div id=nombre>
			<td>

			<td align="left"><?php echo $rUsu['nombre'].' '.$rUsu['apellido']?></td>	
			<a href="cerrar_sesion.php"> Finalizar sesión</a>
			</div>
			</td>
		</tr>
		</table>
		<?php 
		endwhile;
		?>
	
		</div>
		<div id="busqueda">
		<input type="search" name="busqueda" placeholder="Buscar ...">
	</div>
	</div>
	
		<link rel="stylesheet" type="text/css" href="../css/estilosVista.css">
		<div id="datosPublicacion">
		
			<div id='datosPubli'>
				<h1 id='titulPubli'>TÍTULO</h1>
				<img src='{$datos['imgPubli']}' id='imgPubli'>
				<form action='{$datos['link']}' id='oferta'>
				<button id='precioPubli' disabled>$ PRECIO</button>
				<button id='linkPubli'>LINK A LA OFERTA</button>
				</form>

					<div id='califPubli'>
						<p id='calif'>CALIFICACIÓN</p>
					</div>
					<p id='descPubli'>Descripción: </p>
				</div>

				<div id='comentarios'>
					<h2 id='noComments'>No hay comentarios aún :(</h2>
				</div>
				<div id='comentarios'>
					<div id='comentario'>
						<h3 id='usrComment'>Usuario que comenta</h3>
						<p id='fechaComment'>Fecha del comentario</p>
						<p id='comment'>Texto del comentario</p>
					</div>
				</div>
		</div>
	

	</body>
</html>
