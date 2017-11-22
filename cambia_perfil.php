<?php
	include"config.php";
	require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("administrador.html", true, true);
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query1 = "SELECT nombre,foto from pf_usuario where tokens=$array";
	$result1 = mysql_query($query1) or die("Query 1 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$template->setVariable("NOMBRE", $line1['nombre']);
		$template->setVariable("FOTO",$line1['foto']);
		$template->setVariable("TOKEN",$array);
	}
	$template->addBlockfile("CONTENIDO", "CONTENT", "cambia_perfil.html");	
	$template->setCurrentBlock("CONTENT");
	$query2 = "SELECT nombre, appaterno,apmaterno, carrera, fecha_nacimiento, correo_electronico, num_cuenta, contrasenia from pf_usuario where tokens=$array";
	$result2 = mysql_query($query2) or die("Query 2 failed");
	while($line2 = mysql_fetch_assoc($result2)){
		$template->setVariable("NOM", $line2['nombre']);
		$template->setVariable("APPATERNO",$line2['appaterno']);
		$template->setVariable("APMATERNO",$line2['apmaterno']);
		$template->setVariable("CARRERA",$line2['carrera']);
		$template->setVariable("FECHA_N",$line2['fecha_nacimiento']);
		$template->setVariable("MAIL",$line2['correo_electronico']);
		$template->setVariable("NUM",$line2['num_cuenta']);
		$template->setVariable("CONTRA",$line2['contrasenia']);
	}
	$template->setVariable("TOKEN1",$array);	
	$template->TouchBlock("CONTENT");
	$template->show();
?>
