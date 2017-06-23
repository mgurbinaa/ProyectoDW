<?php 
session_start();
include('conexion.php');

$correo = $_POST['correo'];
$password = $_POST['password'];
$query  = "SELECT * FROM users where correo like '".$correo."'";
$rQuery = consulta($query);
if(mysqli_num_rows($rQuery) == 1){
	while($r = mysqli_fetch_array($rQuery)){
		if ($r['password'] == MD5($password)) {
			$_SESSION['id_user'] = $r['id_user'];
			header('location:index.php');
		} else {
			echo 'El password es incorrecto.';
		}
	}
} else {
	echo 'Lo lamentamos pero su ususario no existe,verifique los datos ingresados.';
}
