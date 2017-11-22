<?php
/* mostrar_libros.php
Este programa nos imprimira el contenido de esa tabla y asi poder ver todos los libros 
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("administrador.html", true, true);
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query = "SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro)";
	$query1 = "SELECT nombre,foto from pf_usuario where tokens=$array";
	$result1 = mysql_query($query1) or die("Query 1 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$template->setVariable("NOMBRE", $line1['nombre']);
		$template->setVariable("FOTO",$line1['foto']);
		$template->setVariable("TOKEN",$array);
	}	
	$template->addBlockfile("CONTENIDO", "LIBROS", "tabla_libro.html");
	$template->setCurrentBlock("LIBROS");
	$result = mysql_query($query) or die("Query 1 failed");
	$x=0;
	while($line = mysql_fetch_assoc($result)){
		 	$template->setCurrentBlock("LIBRO");
			$template->setVariable("TITULO", $line['titulo']);
			$template->setVariable("TOKEN1",$array);
			$template->setVariable("ID",$line['idlibro']);
			$template->setVariable("TEMA", $line['tema']);
			$template->setVariable("EDICION", $line['edicion']);
			$template->setVariable("AUTOR", $line['autor']);
			$template->setVariable("NUMERO_P", $line['num_paginas']);
			$template->setVariable("FECHA_REGISTRO", $line['fecha_registro']);
			$template->setVariable("EDITORIAL", $line['editorial']);
			$template->setVariable("NUMERO_L", $line['numero']);
			$template->parseCurrentBlock("LIBRO");
			$x=1;
		 }// while
	$template->parseCurrentBlock("LIBROS");
	mysql_free_result($result);	 	
	mysql_close($link);
	if($x==1){
		$template->show();
	}
	else{
		
	}
?>
