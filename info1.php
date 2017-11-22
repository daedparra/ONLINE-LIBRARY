<?php
/* info1.php
Este programa carga la informacion del libro siendo usuario
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("administrador.html", true, true);
	$array=explode(".",$_GET['token']);
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query1 = "SELECT id_ususario,nombre,foto from pf_usuario where tokens=$array[0]";
	$result1 = mysql_query($query1) or die("Query 1 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$template->setVariable("NOMBRE", $line1['nombre']);
		$template->setVariable("FOTO",$line1['foto']);
		$template->setVariable("TOKEN",$array[0]);
	}
	$template->addBlockfile("CONTENIDO", "LIBROS", "info_l1.html");
	$template->setCurrentBlock("LIBROS");
	$template->setVariable("TOKEN1","$array[0].$array[1]");
	$template->setVariable("TOKEN2","$array[0].$array[1]");
	$x=0;
	$query = "SELECT titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where idlibro=$array[1]";
	$result = mysql_query($query) or die("Query 3 failed");
	while($line = mysql_fetch_assoc($result)){
		 	$template->setCurrentBlock("LIBRO");
			$template->setVariable("TITULO", $line['titulo']);
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
	$query3 = "SELECT comentarios,nombre,appaterno from pf_comentarios left join pf_usuario using(id_ususario) where idlibro=$array[1]";
	$result3 = mysql_query($query3) or die("Query 4 failed");
	while($line3 = mysql_fetch_assoc($result3)){
		 	$template->setCurrentBlock("COMENT");
			$template->setVariable("NOMBRE_C", "$line3[nombre] $line3[appaterno]");
			$template->setVariable("COMENTARIO", $line3['comentarios']);
			$template->parseCurrentBlock("COMENT");
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
