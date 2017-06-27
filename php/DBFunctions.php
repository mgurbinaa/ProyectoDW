<?php
class Database{
	function __construct($con){
		$this->con = $con;
	}

	function end(){
		mysqli_close($this->con);
	}

    function getPubliData($idpubli){
        $query = "SELECT * FROM publicaciones where id_publi = '{$idpubli}'";
        $publi = $this->con->query($query);
        return $publi;
    }

    function getComments($idpubli){
        $query = "SELECT * FROM comentarios WHERE fk_id_publi = '{$idpubli}'";
        $comment = $this->con->query($query);
        return $comment;
    }

    function getUserComment($iduser){
        $query = "SELECT usuario, imagen FROM users WHERE id_user = '{$iduser}'";
        $usr = $this->con->query($query);
        return $usr->fetch_assoc();
    }

	function getUser($user){
		$query = "SELECT usuario FROM users WHERE id_user = {$user};";
		$usr = $this->con->query($query);
		return $usr->fetch_array();
	}

	function startSession($user, $pass){
        session_start();
        $consulta = "SELECT * FROM users WHERE correo = '{$user}' AND password = md5('{$pass}')";
        $result = $this->con->query($consulta);
        $r = $result->fetch_assoc();
        if(is_array($r)){
            $_SESSION['id_user'] = $r['id_user'];
            return "IN";
        }else{
            return "NO";
        }
    }
    
    function signup($user, $correo, $nombre, $apellido, $password){
        $pass = MD5($password);
        $ins = "INSERT INTO users VALUES(0, '{$user}', '{$correo}', '{$nombre}', '{$apellido}', '{$pass}');";
        $result = $this->con->query($ins);
        if($result){
            return "SIGNED";
        }
        else{
            return "NO";
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

    function nuevaPublicacion($titulo, $tienda, $descripcion, $link, $precio, $fechaExpira, $newName, $user){
        $date = date("Y-m-d");
        $query = "INSERT INTO publicaciones VALUES (0, '{$tienda}', '{$titulo}', '{$link}', '{$descripcion}', '{$precio}', 0, '{$date}', '{$fechaExpira}', '{$user}', 1);";
        $ins = $this->con->query($query);
        if($ins){
            $sel = "SELECT * FROM publicaciones ORDER BY id_publi DESC";
            $last = $this->con->query($sel);
            $id = $last->fetch_assoc();
            return $id['id_publi'];
        }
        else{
            return "ERROR";
        }
    }
}
?>