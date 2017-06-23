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
				<a href="compartir.php"><li>compartir</li></a>
				<a href="contactos.php"><li>contactanos</li></a>

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
	

<!-- ===================================== -->
	<div id="bg-negro" onclick="cerrarFoto()">
	
	</div>

	<div id="foto-grande">
		<img id="big-foto">
	</div>
<!-- ===================================== -->

	<div id="contenedor">
	
		<div id="modelo">
			<div id="foto">
				<img src="../img/m1.jpg" onclick="verFoto(this.id)" id="m1">
			</div>
	
			<div id="acciones">
			<button class="votar" onclick="votarmas('idm5','idp5')">Votar + </button>
			<button class="votar"  onclick="votarmenos('idm6','idp6')">Votar - </button>


				<img src="../img/comen.png" onclick="abrircomen('id1')" style="opacity: .7; height: 90% !important;">
			</div>
			<div class="comentarios" id="id1">
				<textarea maxlength="140" placeholder="Escribe tu comentario aquí..." onkeyup="restar('idm1','contador1')" id="idm1"></textarea>
				<div class="btncar">
					<button onclick="publicar('idm1','idp1')">Comentar!</button>
					<h4 id="contador1">140</h4>
				</div>
				<div id="idp1">
					<p></p>	
				</div>
				
			</div>
		</div>

		<div id="modelo">
			<div id="foto">
			
				<img src="../img/m2.jpg" onclick="verFoto(this.id)" id="m2">
			</div>
			
			<div id="acciones">
				
			<button onclick="votarmas('idm7','idp7')">Votar + </button>
			<button onclick="votarmenos('idm8','idp8')">Votar - </button>
				<img src="../img/comen.png" onclick="abrircomen('id2')" style="opacity: .7; height: 90% !important;">
			</div>
			<div class="comentarios" id="id2">
				<textarea maxlength="140" placeholder="Escribe tu comentario aquí..." onkeyup="restar('idm2','contador2')" id="idm2"></textarea>
				<div class="btncar">
					<button onclick="publicar('idm2','idp2')">Comentar!</button>
					<h4 id="contador2">140</h4>
				</div>
				<div id="idp2">
					<p></p>	
				</div>
				
			</div>
		</div>

		<div id="modelo">
			<div id="foto">
			
				<img src="../img/.jpg" onclick="verFoto(this.id)" id="m3">
			</div>
		
			<div id="acciones">
				<button onclick="votarmas('idm9','idp9')">Votar + </button>
				<button onclick="votarmenos('idm10','idp10')">Votar - </button>
				<img src="../img/comen.png" onclick="abrircomen('id3')" style="opacity: .7; height: 90% !important;">
			</div>
			<div class="comentarios" id="id3">
				<textarea maxlength="140" placeholder="Escribe tu comentario aquí..." onkeyup="restar('idm3','contador3')" id="idm3"></textarea>
				<div class="btncar">
					<button onclick="publicar('idm3','idp3')">Comentar!</button>
					<h4 id="contador3">140</h4>
				</div>
				<div id="idp3">
					<p></p>	
				</div>
				
			</div>
		</div>

		<div id="modelo">
			<div id="foto">
			
				<img src="../img/m4.jpg" onclick="verFoto(this.id)" id="m4">
			</div>
		
			<div id="acciones">
			<button onclick="votarmas('idm11','idp11')">Votar + </button>
			<button onclick="votarmenos('idm12','idp12')">Votar - </button>
				<img src="../img/comen.png" onclick="abrircomen('id4')" style="opacity: .7; height: 90% !important;">
			</div>
			<div class="comentarios" id="id4">
				<textarea maxlength="140" placeholder="Escribe tu comentario aquí..." onkeyup="restar('idm4','contador4')" id="idm4"></textarea>
				<div class="btncar">
					<button onclick="publicar('idm4','idp4')">Comentar!</button>
					<h4 id="contador4">140</h4>
				</div>
				<div>
					<p id="idp4"></p>	
				</div>
				
			</div>
		</div>

		
	</div>

	<footer></footer>
	<script>
		window.addEventListener('load', obtener('idm'), true)
	</script>

</body>
</html>
