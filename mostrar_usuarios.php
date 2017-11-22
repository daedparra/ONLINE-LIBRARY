<?php
/* mostrar_usuarios.php
Este programa nos imprimira el contenido de esa tabla y asi poder ver todos los usuarios
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("administrador.html", true, true);
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query = "SELECT id_ususario,nombre,appaterno,apmaterno,fecha_nacimiento,foto,num_cuenta,contrasenia,carrera,correo_electronico FROM pf_usuario left join pf_tipo using(idtipo)";
	$query1 = "SELECT nombre,foto from pf_usuario where tokens=$array";
	$result1 = mysql_query($query1) or die("Query 1 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$template->setVariable("NOMBRE", $line1['nombre']);
		$template->setVariable("FOTO",$line1['foto']);
		$template->setVariable("TOKEN",$array);
	}	
	$template->addBlockfile("CONTENIDO", "USUARIOS", "tabla_usuarios.html");
	$template->setCurrentBlock("USUARIOS");
	$result = mysql_query($query) or die("Query 1 failed");
	$x=0;
	while($line = mysql_fetch_assoc($result)){
		 	$template->setCurrentBlock("USUARIO");
			$template->setVariable("ID", $line['id_ususario']);
			$template->setVariable("NOMBRE1", $line['nombre']);
			$template->setVariable("APP", $line['appaterno']);
			$template->setVariable("APM", $line['apmaterno']);
			$template->setVariable("FECHA", $line['fecha_nacimiento']);
			$template->setVariable("FOTO1", $line['foto']);
			$template->setVariable("NUM_C", $line['num_cuenta']);
			$template->setVariable("CONTRA", $line['contrasenia']);
			$template->setVariable("CARRERA", $line['carrera']);
			$template->setVariable("CORREO", $line['correo_electronico']);
			$template->parseCurrentBlock("USUARIO");
			$x=1;
		 }// while
	$template->parseCurrentBlock("USUARIOS");
	mysql_free_result($result);	 	
	mysql_close($link);
	if($x==1){
		$template->show();
	}
	else{
		
	}

?>
