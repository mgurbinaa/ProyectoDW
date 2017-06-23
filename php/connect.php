<?php
function conectar(){
	$dbUser = "root";
    $dbPass = "";
    $dbHost = "localhost";
    $dbName = "appdesc";
    
    $con = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if($con->connect_errno > 0){
        return "No se pudo comunicar con la Base de Datos";
    }
    else{
        return $con;
    }
}
?>