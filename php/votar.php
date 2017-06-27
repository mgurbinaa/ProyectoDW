<?php
session_start();
include("connect.php");
include("DBFunctions.php");
$con = conectar();
$db = new Database($con);
$user = $_SESSION['id_user'];
$publi = $_GET['id'];
$voto = $_GET['v'];

echo $db->vote($user, $publi, $voto);

?>