<?php  
$con = mysqli_connect('localhost','root','','appdesc');
?>
<html>
<body>
<title>Deals</title>
   <link rel="stylesheet" type="text/css" href="estilos.css">
   <meta charset="utf-8">
   
   <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,900" rel="stylesheet">
</head>
<body>
   <div id="encabezado">
      <div id="logo">
         <div id="imagen">
            <img src="img/logo.png">
         </div>
         <div id="nombre">
            <h2>Deals</h2>
            <h5>Las mejores Ofertas</h5>
         </div>
      </div>
<div class="agregarNuevoUsuario">
   
      <link rel="stylesheet" type="text/css" href="estiloslogin.css">
 <form method="post" action="registro.php">
 <div class="contenedor">
 <h1>Bienvenido</h1>
 <p>Ingresa tus datos para crear una cuenta</p>
         <input type="text" name="usuario" placeholder="Nombre de usuario" >
         <br><br>
         <input type="text" name="correo" placeholder="Correo Electrónico" >
         <br><br>
         <input type="text" name="nombre" placeholder="Nombre" >
         <br><br>
         <input type="text" name="apellido" placeholder="Apellido" >
         <br><br>
         <input type="password" name="password" placeholder="Password">
         <br><br>
         <input type="submit" name="registro" value="Registro">
          <br><br>
         <br><br>
         <a href="login.html">  Inicia sesion </a>
   </form>
 </div>


<?php 
if (isset($_POST['registro'])) {
   //CAPTURAR VARIABLES DEL POST
   $usuario = $_POST['usuario'];
   $correo = $_POST['correo'];
   $nombre = $_POST['nombre'];
   $apellido = $_POST['apellido'];
   $password = $_POST['password'];
   $password = MD5($password);
  

   $insertarUsuario = "INSERT INTO users (usuario,correo,nombre,apellido,password) VALUES ('$usuario','$correo','$nombre','$apellido','$password')";
   mysqli_query($con, $insertarUsuario);
   echo "Te has Registrado correctamente!";
}

 ?>

</body>
</html> 
