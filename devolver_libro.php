<?php
/* devolver_libro.php
Este carga el template para ver que libros ah  rentado y asi poderlos regresar.
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("usuario.html", true, true);
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query2="select id_ususario from pf_usuario where tokens=$array";
	$result2 = mysql_query($query2) or die("Query 1 failed");
	while($line2 = mysql_fetch_assoc($result2)){
		$id=$line2['id_ususario'];
	}
	$query = "select idlibro,titulo, fecha_retiro, fecha_vencimiento, count(a.idlibro) as numero from pf_prestamo a left join pf_libros using(idlibro) where id_ususario=$id and fecha_entrega is null group by idlibro";
	$query1 = "SELECT nombre,foto from pf_usuario where tokens=$array";
	$result1 = mysql_query($query1) or die("Query 2 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$template->setVariable("NOMBRE", $line1['nombre']);
		$template->setVariable("FOTO",$line1['foto']);
		$template->setVariable("TOKEN",$array);
	}	
	$template->addBlockfile("CONTENIDO", "LIBROS", "tabla_libro_d.html");
	$template->setCurrentBlock("LIBROS");
	$result = mysql_query($query) or die("Query 3 failed");
	$x=0;
	while($line = mysql_fetch_assoc($result)){
		 	$template->setCurrentBlock("LIBRO");
			$template->setVariable("TITULO", $line['titulo']);
			$template->setVariable("TOKEN1",$array);
			$template->setVariable("ID",$line['idlibro']);
			$template->setVariable("FECHA_R",$line['fecha_retiro']);
			$template->setVariable("FECHA_V",$line['fecha_vencimiento']);
			$template->setVariable("NUMERO",$line['numero']);			
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
		$template->setCurrentBlock("NO_LIBRO");
		$template->setVariable("NO_HAY_LIBROS","No tiene libros a devolver");
		$template->parseCurrentBlock("NO_LIBRO");
		$template->show();
	}
?>
