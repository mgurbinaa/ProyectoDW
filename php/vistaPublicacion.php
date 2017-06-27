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
			<?php
			require_once("connect.php");
			require("DBFunctions.php");
			$con = conectar();
			$db = new Database($con);

			if($_GET['id']){
				$data = $db->getPubliData($_GET['id']);
				$datos = $data->fetch_array();
				if(is_array($datos)){
					echo "<div id='datosPubli'>
							<h1 id='titulPubli'>{$datos['shop']}: {$datos['title']}</h1>
							<form action='{$datos['link']}' id='oferta'>";
					if(isset($datos['precio'])){
						echo "<button id='precioPubli' disabled>{$datos['precio']}</button>
							  <input type='submit' id='linkPubli' value='Ir a la oferta'>";
					}
					else{
						echo "<input id='linkPubli2' type='submit' value='Ir a la oferta'>";
					}
					echo "</form>
							<img src='../src/{$_GET['id']}.jpeg' id='imgPubli'><br><br>
							<p id='descPubli'>{$datos['descripcion']}</p>
							<div id='califPubli'>
							<p id='calif' style='color:red; font-weight:bold'>Calificación: {$datos['calificacion']}</p>
							</div>
						  </div>";
					}
				else{
					header("location: index.php");
				}
			}
			else{
				$datos = $db->getPubliData($_POST['idPubli']);
				if($datos->num_rows > 0){
					echo "<div id='datosPubli'>
							<h1 id='titulPubli'>{$datos['title']}</h1>
							<form action='{$datos['link']}' id='oferta'>";
					if(isset($datos['precio'])){
						echo "<button id='precioPubli' disabled>{$datos['precio']}</button>
							  <button id='linkPubli'>Ir a la oferta</button>";
					}
					else{
						echo "<button id='linkPubli2'>Ir a la oferta</button>";
					}
					echo "</form>
							<img src='{$datos['imgPubli']}' id='imgPubli'>
							<div id='califPubli'>
								<p id='calif'>{$datos['calificacion']}</p>
							</div>
							<p id='descPubli'>{$datos['descripcion']}</p>
						  </div>";
				}
				else
				{
					header("Location: index.php");
				}
			}
			?>
		</div>

		<?php
		if($_GET['id']){
			$comm = $db->getComments($_GET['id']);
			$comments = $comm->fetch_array();
			if(is_array($comments)){
				$i=0;
				while ($row = $comments->fetch_assoc()){
					$resp[$i]=$row;
					$i++;
				}
				if(is_array($resp)){
					foreach ($resp as $comment){
						$usr = $db->getUserComment($comment['fk_id_user_comment']);
						echo "<div id='comentarios'>
								<div id='comentario'>
								<h3 id='usrComment'>{$usr['usuario']}</h3>
								<p id='fechaComment'>{$comment['fecha_comment']}</p>
								<p id='comment'>{$comment['contenido']}</p>
							</div>
						</div>";
					}
				}	
			}else{
				echo"<div id='comentarios'>
						<h2 id='noComments'>No hay comentarios aún :(</h2>
				 	</div>";
			}
		}
		else{
			$comm = $db->getComments($_POST['idPubli']);
			$comments = $comm->fetch_array();
				if(is_array($comments)){
					$i=0;
					while ($row = $comments->fetch_assoc()){
						$resp[$i]=$row;
						$i++;
					}
				}
				else{
					echo"<div id='comentarios'>
							<h2 id='noComments'>No hay comentarios aún :(</h2>
						 </div>";
				}

				if(is_array($resp)){
					foreach ($resp as $comment){
						$usr = $db->getUserComment($comment['fk_id_user_comment']);
						echo "<div id='comentarios'>
								<div id='comentario'>
									<h3 id='usrComment'>{$usr['usuario']}</h3>
									<p id='fechaComment'>{$comment['fecha_comment']}</p>
									<p id='comment'>{$comment['contenido']}</p>
								</div>
							  </div>";
					}
				}
			}
			?>
	

	</body>
</html>
