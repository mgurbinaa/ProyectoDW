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
					<a href="compartir.php"><li>compartir</li></a>
					<a href="contactos.php"><li>contactanos</li></a>
				</ul>
			<table>
				<?php 
				while($rUsu = mysqli_fetch_array($usuarioQuery)):
				?>
				<tr>
					<td align="left"><?php echo $rUsu['nombre'].' '.$rUsu['apellido']?></td>
					<td align="left">
					<a href="cerrar_sesion.php"> Finalizar sesión</a>
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

		<div id="datosPublicacion">
			<div id='datosPubli'>
				<h1 id='titulPubli'>{$datos['title']}</h1>
				<form action='{$datos['link']}' id='oferta'>
					<button id='precioPubli' disabled>$datos['precio']</button>
					<button id='linkPubli'>Ir a la oferta</button>
					<button id='linkPubli2'>Ir a la oferta</button>
				</form>
					<img src='{$datos['imgPubli']}' id='imgPubli'>
					<div id='califPubli'>
						<p id='calif'>{$datos['calificacion']}</p>
					</div>
					<p id='descPubli'>{$datos['descripcion']}</p>
				</div>
				<div id='comentarios'>
					<h2 id='noComments'>No hay comentarios aún :(</h2>
				</div>
				<div id='comentarios'>
					<div id='comentario'>
						<img src='{$usr['imagen']}' id='imgComment'>
						<h3 id='usrComment'>$usr['usuario']</h3>
						<p id='fechaComment'>$comment['fecha_comment']</p>
						<p id='comment'>$comment['contenido']</p>
					</div>
				</div>
		</div>
	

	</body>
</html>