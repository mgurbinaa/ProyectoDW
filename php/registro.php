<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Registro</title>
</head>
<body>
<div class="contenedor">
<link href="estilosLogin.css" rel="stylesheet">
   <h1>Registro</h1>
   <p>Introduce tus datos para poder ingresar</p>
   <input type="text" id="usuario" placeholder="Nombre  o email">
   <input type="text" id="Apellidos" placeholder="Apellidos">
   <input type="password" id="password" placeholder="Password">
   <button onclick="login()" id="boton">Iniciar Sesión</button>
   <p>O si ya tienes cuenta, <a href="login.html">inicia sesión</a>.</p>
   <p  id="msj-error"></p>

   
</div>

<script>
   function login(){
      //capturamos valores de login
      usuario = document.getElementById('usuario').value;
      password = document.getElementById('password').value;
      //validar que tengan contenido
      if (usuario != "" && password != "") {

         //SI SON DIFERENTES DE ANADA, ENTRA EN EL LADO VERDADEDO
         ajaxLogin = new XMLHttpRequest();
         ajaxLogin.open('GET','validalogin.php?u=' +usuario+'&p='+password, true);
         ajaxLogin.send();
         ajaxLogin.onreadystatechange = function(){
            if (ajaxLogin.readyState == 3 && ajaxLogin.status == 200) {
               //ESTA CARGANDO
               document.getElementById('usuario').disable = "true";
               document.getElementById('password').disable = "true";
               document.getElementById('boton').disable = "true";
               document.getElementById('boton').innerHTML = "Cargando...";
               document.getElementById('boton').style.opacity =".5";
            }
            if (ajaxLogin.readyState == 4 && ajaxLogin.status == 200) {
               //YA HAY UNA RESPUESTA 
               console.log(ajaxLogin.responseText)
               if (ajaxLogin.responseText == "loguado") {
                  //SE PUEDE LOGAR
                  window.location.assign('http://www.google.com');
               }
               else{
                  //NO INICIO DE SESION
                  setTimeout(function(){
                     document.getElementById('usuario').removeAttribute = ('disable');
                     document.getElementById('password').removeAttribute = ('disable');
                     document.getElementById('boton').removeAttribute = ('disable');
                     document.getElementById('boton').innerHTML = "Iniciar sesion";
                     document.getElementById('boton').style.opacity ="1";
                     mensaje('tus datos no coinciden');
                  }, 2000);
                  
               }
            }
         }
      }
      else{
         //SI SON IGUALES A NADA, ENTRA EN EL LADO FALSO
         mensaje('campos Incompletos');
      }
   }

   function mensaje(msj){
      cuadroMensaje = document.getElementById('msj-error');
      cuadroMensaje.innerHTML = msj;
      cuadroMensaje.classList.add('ver');
      setTimeout(function(){
         cuadroMensaje.classList.remove('ver')
      }, 2000);
   }
</script>
    
</body>
</html>