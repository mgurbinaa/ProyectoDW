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
		<div id="crearPublicacion">
			<form action="cargarImagen.php">
				<input type="file" name="image" id="imagen" accept="image/jpeg">
				<input class="inputCarga" type="text" name="titulo" id="titulo" placeholder="Título">
				<input class="inputCarga" type="text" name="tienda" id="tienda" placeholder="tienda">
				<textarea class="textCarga" name="descripcion" id="descripcion" placeholder="Descripción"></textarea>
				<input class="inputCarga" type="text" id="link" name="link" placeholder="Enlace a la oferta">
				<input class="inputCarga" type="number" id="precio" name="precio" placeholder="Precio">
				<input type="date" class="inputCarga" id="fechaExpira">
				<input type="submit" value="Guardar">
			</form>
		</div>
	</body>
</html>