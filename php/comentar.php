<?php
include("connect.php");
include("DBFunctions.php");
$con = conectar();
$db = new Database($con);
$user = $_GET['u'];
$publi = $_GET['p'];
$comentario = $_GET['c'];

echo $db->comment($user, $publi, $comentario);

?>