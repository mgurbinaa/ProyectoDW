<?php
class Database{
	function __construct($con){
		$this->con = $con;
	}

	function end(){
		mysqli_close($this->con);
	}

    function getPubliData($idpubli){
        $query = "SELECT * FROM publicaciones where id_publi = '{$id_publi}'";
        $publi = $this->con-query($query);
        return $publi;
    }

	function getUser($user){
		$query = "SELECT usuario FROM users WHERE id_user = {$user};";
		$usr = $this->con->query($query);
		return $usr->fetch_array();
	}

	function startSession($user, $pass){
        $sel = $this->con->query("SELECT usuario, password FROM users WHERE usuario = '{$user}';");
        if($sel){
            $datos = $sel->fetch_array();
            if($pass == $datos['password']){
                $_SESSION["appdesc"] = $datos['id_user'];
                header('Location: index.php');
            }
            else{
                return "Usuario y/o contraseña incorrectos.";
            }
        }
        else{
            return "Usuario y/o contraseña incorrectos.";
        }
    }
    
    function endSession(){
        session_destroy();
        header('Location: index.php');
    }
    
    function signup($user, $pass, $nombre, $apellido, $correo, $imagen, $password){
        $ins = $this->con->query("INSERT INTO users VALUES(0, '{$user}', '{$correo}', '{$nombre}', '{$apellido}', '{$imagen}', '{$password}');");
        if($ins){
            header('Location: login.php');
        }
        else{
            echo "El usuario o correo ya está registrado, intenta con uno diferente.";
        }
    }

    function load(){
        $sel = $this->con->query("SELECT * FROM publicaciones WHERE fk_status = '1' ORDER BY calificacion DESC;");
        return $sel;
    }
    
    function search($words){
        $sel = $this->con->query("SELECT * FROM publicaciones WHERE title LIKE '%{$words}%' OR descripcion LIKE '%{$words}%' ORDER BY calificacion DESC;");
        return $sel;
    }
}
?>