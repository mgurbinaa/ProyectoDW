<?php
session_start();
$user = $_SESSION['id_user'];
require("connect.php");
include("DBFunctions.php");
$con = conectar();
$bd = new Database($con);

$link = $_POST['link'];
$titulo = $_POST['titulo'];
$tienda = $_POST['tienda'];
$descripcion = $_POST['descripcion'];
$fechaExpira = $_POST['fechaExpira'];

if(isset($_POST['precio'])){
	$precio = $_POST['precio'];
}
else{
	$precio = NULL;
}

$destino = '../src' ; 
$name = $_FILES["file"]["name"];
$sep=explode('image/',$_FILES["file"]["type"]);
$tipo=$sep[1];
if($tipo == "jpg" || $tipo == "jpeg"){
	$nueva = $bd->nuevaPublicacion($titulo, $tienda, $descripcion, $link, $precio, $fechaExpira, $newName, $user);
	if($nueva == "ERROR"){
		header("location: error.php");
	}
	else{
		move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/'.$nueva.'.'.$tipo);
		header("location: vistaPublicacion.php?id=$nueva");
	}
} 
else{
	header("Location: error1.php");
}
?>