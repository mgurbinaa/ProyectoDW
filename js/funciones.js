function abrircomen(idComent){
	document.getElementById(idComent).classList.toggle("ver-comentarios");
}
function like(idimg){
	document.getElementById(idimg).src="img/mas2.png";
	
}
function dislike(idimg){
	document.getElementById(idimg).src="img/menos2.png";
}

function publicar(idtexta, idparr){
	comentario=document.getElementById(idtexta).value;
	comentarios=localStorage.getItem(idtexta)
	comentarios=comentarios + "|"+ comentario;
	localStorage.setItem(idtexta,comentarios)
	document.getElementById(idtexta).value="";
	document.getElementById(idparr).innerHTML+="<p>"+comentario+"</p>"
	document.getElementById(c).innerHTML=140;
}
function obtener(idtexta){
	i=1;
	p=1;
	console.log(idtexta)
	while(localStorage.getItem(idtexta+i)){
		comentarios=localStorage.getItem(idtexta+i)
		coment=comentarios.split("|")
		for(j=1; j< coment.length; j++){
			parrafoID = 'idp' + p;
			document.getElementById(parrafoID).innerHTML+="<p>"+coment[j]+"</p>"
		}
		p++;
		i++;
	}
}


function restar(idtexta,cont){
	// cont = 140;
	// cont--;
	c=cont
	letras=document.getElementById(idtexta).value;
	restante=140-letras.length;
	// alert(restante);
	document.getElementById(cont).innerHTML=restante;
}

function verFoto (foto) {
		document.getElementById('bg-negro').style.visibility="visible";
		document.getElementById('foto-grande').style.visibility="visible"
		document.getElementById('bg-negro').style.opacity="1";
		document.getElementById('foto-grande').style.opacity="1"
		document.getElementById('big-foto').setAttribute("src","img/"+foto+".jpg")	
	}

	function cerrarFoto () {
		document.getElementById('bg-negro').style.visibility="hidden";
		document.getElementById('foto-grande').style.visibility="hidden"
		document.getElementById('bg-negro').style.opacity="0";
		document.getElementById('foto-grande').style.opacity="0"		
	}