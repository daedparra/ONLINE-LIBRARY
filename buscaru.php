<?php
/* buscarl_u.php
Este programa hace el query necesario para buscar la info que se tecleo y asi de spues poderlo imprimir en el template de html.
Se buscan los usuarios.
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	$array=$_GET['token'];
        require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("administrador.html", true, true);	
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$nombre=$_POST["busqueda"];
	$query ="SELECT id_ususario,nombre,appaterno,apmaterno,fecha_nacimiento,foto,num_cuenta,contrasenia,carrera,correo_electronico FROM pf_usuario left join pf_tipo using(idtipo) where nombre='$nombre'";
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
		header("Location: buscar_usuario_error.php?token=$array");
	}
?>
