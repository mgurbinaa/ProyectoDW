<?php
include("connect.php");
include("DBFunctions.php");
$con = conectar();
$db = new Database($con);
$usuario = $_GET['u'];
$correo = $_GET['c'];
$nombre = $_GET['n'];
$apellido = $_GET['a'];
$password = $_GET['p'];

echo $db->signup($usuario, $correo, $nombre, $apellido, $password);

?>