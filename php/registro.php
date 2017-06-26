<?php 
session_start();
if(isset($_SESSION['id_user'])){
   header('location:index.php');
}
$con = mysqli_connect('localhost','root','','appdesc');
?>
<html>
<body>
<title>Deals</title>
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
<div class="agregarNuevoUsuario">
   
      <link rel="stylesheet" type="text/css" href="../css/estiloslogin.css">
 <div class="contenedor">
    <h1>Bienvenido</h1>
    <p>Ingresa tus datos para crear una cuenta</p>
        <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario" >
        <br><br>
        <input type="text" id="correo" name="correo" placeholder="Correo Electrónico" >
        <br><br>
        <input type="text" id="name" name="nombre" placeholder="Nombre" >
        <br><br>
        <input type="text" id="apellido" name="apellido" placeholder="Apellido" >
        <br><br>
        <input type="password" id="password" name="password" placeholder="Password">
        <br><br>
        <input type="submit" id="boton" name="registro" onclick="registro()" value="Registrar">
        <br><br>
        <br><br>
        <p>O si ya tienes cuenta <a href="login.php">inicia sesión</a>.</p>
</div>

</body>
<script type="text/javascript">
    function registro(){
        usuario = document.getElementById('usuario').value;
        correo = document.getElementById('correo').value;
        nombre = document.getElementById('name').value;
        apellido = document.getElementById('apellido').value;
        password = document.getElementById('password').value;

        if(usuario != "" && correo != "" && nombre != "" && apellido != "" && password != ""){
            ajaxRegistro = new XMLHttpRequest();
            ajaxRegistro.open('GET', 'validaRegistro.php?u='+usuario+'&c='+correo+'&n='+nombre+'&a='+apellido+'&p='+password, true);
            ajaxRegistro.send();
            ajaxRegistro.onreadystatechange = function(){
                if(ajaxRegistro.readyState == 3 && ajaxRegistro.status == 200){
                    document.getElementById('usuario').disabled = 'true';
                    document.getElementById('correo').disabled = 'true';
                    document.getElementById('name').disabled = 'true';
                    document.getElementById('apellido').disabled = 'true';
                    document.getElementById('password').disabled = 'true';
                    document.getElementById('boton').disabled = 'true';
                    document.getElementById('boton').innerHTML = 'Validando...';
                    document.getElementById('boton').style.opacity = '.5';
                }
                if(ajaxRegistro.readyState == 4 && ajaxRegistro.status == 200){
                    if(ajaxRegistro.responseText == "SIGNED"){
                        alert("¡Registro exitoso! Por favor, inicia sesión.")
                        window.location.assign("login.php");
                    }
                    else{
                        document.getElementById('usuario').removeAttribute('disabled');
                        document.getElementById('correo').removeAttribute('disabled');
                        document.getElementById('name').removeAttribute('disabled');
                        document.getElementById('apellido').removeAttribute('disabled');
                        document.getElementById('password').removeAttribute('disabled');
                        document.getElementById('boton').removeAttribute('disabled');
                        document.getElementById('boton').innerHTML = "Registrar";
                        document.getElementById('boton').style.opacity = '1';
                        alert("El usuario o correo electrónico ya están registrados.")
                    }
                }
            }

        }
        else{
            alert("Rellena todos los campos para registrarte");
        }
    }
</script>
</html> 

