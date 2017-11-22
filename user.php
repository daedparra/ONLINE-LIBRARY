<?php
	include"config.php";
	require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("usuario.html", true, true);
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query = "SELECT id_ususario from pf_usuario where tokens=$array";
	$result = mysql_query($query) or die("Query 1 failed");
	$x=0;	
	while($line = mysql_fetch_assoc($result)){
		if($line['id_ususario']==0){
			$x=0;
		}else{
			$x=1;
			$x1=$line['id_ususario'];
			$query1 = "SELECT tokens from pf_usuario where id_ususario=$x1";
			$result1 = mysql_query($query1) or die("Query 2 failed");
			while($line1 = mysql_fetch_assoc($result1)){
				if($array==$line1['tokens']){
					$query2 = "SELECT nombre,foto from pf_usuario where id_ususario=$x1";
					$result2 = mysql_query($query2) or die("Query 3 failed");
					while($line2 = mysql_fetch_assoc($result2)){
						$template->setVariable("NOMBRE", $line2['nombre']);
						$template->setVariable("FOTO",$line2['foto']);
						$template->setVariable("TOKEN",$array);
					}
				}
			}
		$template->addBlockfile("CONTENIDO", "LIBROS", "historial.html");
		$template->setCurrentBlock("LIBROS");
		$query3 = "select idlibro,titulo, fecha_retiro, fecha_vencimiento, count(a.idlibro) as numero from pf_prestamo a left join pf_libros using(idlibro) where id_ususario=$x1 and fecha_entrega is null group by idlibro";
		$query4 = "select idlibro,titulo, fecha_retiro, fecha_vencimiento, fecha_entrega from pf_prestamo a left join pf_libros using(idlibro) where id_ususario=$x1 and fecha_entrega is not null";
		$result3 = mysql_query($query3) or die("Query 4 failed");
		while($line3 = mysql_fetch_assoc($result3)){
		 	$template->setCurrentBlock("LIBRO");
			$template->setVariable("TITULO", $line3['titulo']);
			$template->setVariable("FECHA_R",$line3['fecha_retiro']);
			$template->setVariable("FECHA_V",$line3['fecha_vencimiento']);
			$template->setVariable("NUMERO",$line3['numero']);			
			$template->parseCurrentBlock("LIBRO");
			$x=1;
		 }// while
		$result4 = mysql_query($query4) or die("Query 5 failed");
		while($line4 = mysql_fetch_assoc($result4)){
		 	$template->setCurrentBlock("LIBROS_R");
			$template->setVariable("TITULO", $line4['titulo']);
			$template->setVariable("FECHA_R",$line4['fecha_retiro']);
			$template->setVariable("FECHA_V",$line4['fecha_vencimiento']);
			$template->setVariable("FECHA_E", $line4['fecha_entrega']);
			$template->setVariable("NUMERO",$line3['numero']);			
			$template->parseCurrentBlock("LIBROS_R");
			$x=1;
		 }// while
		$template->parseCurrentBlock("LIBROS");
		}
	}
	mysql_free_result($result);	 	
	mysql_close($link);
	if($x==1){
		$template->show();
	}
	else{
		header("Location: principal.html");
	}
?>
