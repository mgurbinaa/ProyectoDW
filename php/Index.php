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
<!DOCTYPE html>
<html>
<head>
	
	
	<title>Deals</title>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<meta charset="utf-8">
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
		<div id="busqueda">
		<input type="search" name="busqueda" placeholder="Buscar ...">
	</div>
	</div>
	

<!-- ===================================== -->
	<div id="bg-negro" onclick="cerrarFoto()">
	
	</div>

	<div id="foto-grande">
		<img id="big-foto">
	</div>
<!-- ===================================== -->

	<div id="contenedor">

		<?php
		require_once("connect.php");
		require("DBFunctions.php");
		$con = conectar();
		$db = new Database($con);

		$publis = $db->load();
		if($publis->num_rows >0){
			$i=0;
			while ($row = $publis->fetch_assoc()){
				$resp[$i]=$row;
				$i++;
			}
			if(is_array($resp)){
				foreach ($resp as $publi) {
					echo "<div id='modelo'>
							<div id='foto'>
								<img src='../src/{$publi['id_publi']}.jpeg' onclick='goToPubli({$publi['id_publi']})'>
							</div>
							<div id='datos'>
								<h3>{$publi['shop']}: {$publi['title']}</h3>
								<div id='calif'>
									<h4>{$publi['calificacion']}</h4>
								</div>
							</div>
					
							<div id='acciones'>
								<button class='votar' id='votar' onclick='votarmas({$publi['id_publi']})'>+ </button>
								<button class='votar' id='votar' onclick='votarmenos({$publi['id_publi']})'>- </button>
							</div>
						</div>";
				}
			}
		}
		?>
	</div>

	<footer></footer>
	<script>
		function goToPubli(id){
			window.location.href = 'vistaPublicacion.php?id='+id;
		}
		window.addEventListener('load', obtener('idm'), true)
	</script>

</body>
</html>
