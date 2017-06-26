<?php 
session_start();
if(isset($_SESSION['id_user'])){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Iniciar sesión | DEALS</title>
		
		<link rel="stylesheet" type="text/css" href="../css/estilosLogin.css">
	    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
	    <meta charset="utf-8">
	    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,900" rel="stylesheet">
	</head>
	<body>
	   	<div id="encabezado">
	    	<div id="logo">
	        	<div id="imagen">
	            	<img src="../img/logo.png">
	         	</div>
	        <div id="nombre">
	            <h2>Deals</h2>
	            <h5>Las mejores Ofertas</h5>
	        </div>
	    </div>
	<body>
		<div class="contenedor">
			<h1>Inicio de sesión</h1>
 			<p>Introduce tus datos para iniciar sesión</p>
			<input type="text" name="correo" id="correo" placeholder="Correo Electronico" >
			<br><br>
			<input type="password" name="password" id="password" placeholder="Password">
			<br><br>
			<input type="submit" name="login" id="boton" onclick="login()" value="Iniciar Sesión">
			<br><br>
			<br><br>
	 		<p>O puedes registrarte aquí: <a href="registro.php">Registro</a>.</p>
	 	</div>
	</body>

	<script type="text/javascript">
		function login(){
			usuario = document.getElementById('correo').value;
			password = document.getElementById('password').value;

			if(usuario != "" && password != ""){
				ajaxLogin = new XMLHttpRequest();
				ajaxLogin.open('GET', 'validaLogin.php?u='+usuario+'&p='+password, true);
				ajaxLogin.send();
				ajaxLogin.onreadystatechange = function(){
					if(ajaxLogin.readyState == 3 && ajaxLogin.status == 200){
						document.getElementById('correo').disabled = 'true';
						document.getElementById('password').disabled = 'true';
						document.getElementById('boton').disabled = 'true';
						document.getElementById('boton').innerHTML = 'Iniciando sesión...';
						document.getElementById('boton').style.opacity = '.5';
					}
					if(ajaxLogin.readyState == 4 && ajaxLogin.status == 200){
						if (ajaxLogin.responseText == "IN") {
							window.location.assign('index.php');
						}
						else{
							document.getElementById('correo').removeAttribute('disabled');
							document.getElementById('password').removeAttribute('disabled');
							document.getElementById('boton').removeAttribute('disabled');
							document.getElementById('boton').innerHTML = 'Iniciar Sesión';
							document.getElementById('boton').style.opacity = '1';
							mensaje('Usuario y/o contraseña incorrectos.');
						}
					}
				}
			}else{
				mensaje('Rellena todos los campos para iniciar sesión');
			}
		}

		function mensaje(msj){
			alert(msj);
		}
	</script>
</html>