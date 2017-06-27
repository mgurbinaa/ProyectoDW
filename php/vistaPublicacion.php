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
							<div id='acciones'>
								<div id='califPubli'>
									<p id='calif'>Calificación: {$datos['calificacion']}</p>
								</div>
								<button class='votar' id='votar' onclick='votarmas({$_GET['id']})'>+ </button>
								<button class='votar' id='votar' onclick='votarmenos({$_GET['id']})'>- </button>
							</div>
							<p id='descPubli'>{$datos['descripcion']}</p>
							<div id='califPubli'>
							</div>
						  </div>";
					}
				else{
					header("location: index.php");
				}
			}
			?>
			<div class="comentarios ver-comentarios" id="id1">
				<textarea maxlength="140" placeholder="Escribe tu comentario aquí..." onkeyup="restar('idm1','contador1')" id="idm1"></textarea>
				<div class="btncar">
					<button id='com' onclick="comentar(<?php echo $_GET['id'] ?>,<?php echo $_SESSION['id_user'] ?>)">Comentar!</button>
					<h4 id="contador1">140</h4>
				</div>
				<div id="idp1">
					<p></p>	

		<?php
		if($_GET['id']){
			$comments = $db->getComments($_GET['id']);
			if($comments->num_rows>0){
				$i=0;
				while ($row = $comments->fetch_assoc()){
					$resp[$i]=$row;
					$i++;
				}
				if(is_array($resp)){
					foreach ($resp as $comment){
						echo "<p>{$comment['contenido']}</p>";
					}
				}	
			}else{
				echo"<h2>No hay comentarios aún :(</h2>";
			}
		}
		?>
			</div>		
		</div>
	
		</div>

	</body>

	<script type="text/javascript">
		function comentar(idPubli, idUser){
			comentario = document.getElementById('idm1').value;
			if(comentario!=''){
				ajaxComment = new XMLHttpRequest();
				ajaxComment.open('GET', 'comentar.php?p='+idPubli+'&u='+idUser+'&c='+comentario);
				ajaxComment.send();
				ajaxComment.onreadystatechange = function(){
					if(ajaxComment.readyState == 3 && ajaxComment.status == 200){
	                    document.getElementById('idm1').disabled = 'true';
	                    document.getElementById('com').disabled = 'true';
	                    document.getElementById('com').innerHTML = 'Publicando...';
	                    document.getElementById('com').style.opacity = '.5';
	                }
	                if(ajaxComment.readyState == 4 && ajaxComment.status == 200){
	                    if(ajaxComment.responseText == "YES"){
	                        window.location.reload();
	                    }
	                    else{
	                    	alert("Ups... Ocurrió un error al publicar tu comentario");
	                    }
	                }
				}
			}
		}
	</script>
</html>
