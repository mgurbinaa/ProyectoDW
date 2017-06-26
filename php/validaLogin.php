<?php
include("connect.php");
include("DBFunctions.php");
$con = conectar();
$db = new Database($con);
$usuario = $_GET['u'];
$password = $_GET['p'];

echo $db->startSession($usuario, $password);

?>