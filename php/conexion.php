<?php 

function conexion(){
	$con = mysqli_connect('localhost','root','','appdesc');
	return $con;
}

function consulta($query){
	$con = conexion();
	$res = mysqli_query($con, $query);
	mysqli_close($con);
	return $res; 
	
}
