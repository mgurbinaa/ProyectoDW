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
					<a href="vistaPublicacion.php"><li>Publicaciones</li></a>
				
				
			<table>
				<?php 
				while($rUsu = mysqli_fetch_array($usuarioQuery)):
				?>
				<tr>
					<td align="left"><?php echo $rUsu['nombre'].' '.$rUsu['apellido']?></td>
					
					<a href="cerrar_sesion.php"> Finalizar sesión</a>
					</td>
				</tr>
			</table>
			<?php 
			endwhile;
			?>		
			</div>

			
	<link rel="stylesheet" type="text/css" href="../css/estilosPublicacion.css">
		<div id="crearPublicacion">
		<p>Compartir una nueva oferta</p>

			<form action="cargarImagen.php">
				
				<input class="inputCarga" type="text" name="titulo" id="titulo" placeholder="Título">
				<input class="inputCarga" type="text" name="tienda" id="tienda" placeholder="tienda">
				<textarea class="textCarga" name="descripcion" id="descripcion" placeholder="Descripción"></textarea>
				<input class="inputCarga" type="text" id="link" name="link" placeholder="Enlace a la oferta">
				<input class="inputCarga" type="number" id="precio" name="precio" placeholder="Precio">
				<input type="date" class="inputCarga" id="fechaExpira">
				<div id="file">
				<p>Comparte tu fotografia</p>
				<input type="file"  name="image" id="imagen" accept="image/jpeg" > 
				</div>
				<input type="submit" value="Enviar Oferta">

				

			</form>
		</div>
	</body>
</html>
