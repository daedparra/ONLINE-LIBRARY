<?php
	include"config.php";
	$array=$_GET['token'];
        require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("administrador.html", true, true);	
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$libro=$_POST["busqueda"];
	if(isset($_POST['titulo'])&&$_POST['titulo']=='1'){
	$opc1=$_POST['titulo'];
	}else{$opc1=0;}
	if(isset($_POST['autor'])&&$_POST['autor']=='2'){
	$opc2=$_POST['autor'];
	}else{$opc2=0;}
	if(isset($_POST['editorial'])&&$_POST['editorial']=='3'){
	$opc3=$_POST['editorial'];
	}else{$opc3=0;}
	if(isset($_POST['tema'])&&$_POST['tema']=='4'){
	$opc4=$_POST['tema'];
	}else{$opc4=0;}
	$query1 = "SELECT nombre,foto from pf_usuario where tokens=$array";
	$result1 = mysql_query($query1) or die("Query 1 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$template->setVariable("NOMBRE", $line1['nombre']);
		$template->setVariable("FOTO",$line1['foto']);
		$template->setVariable("TOKEN",$array);
	}
	$template->addBlockfile("CONTENIDO", "LIBROS", "tabla_libro.html");
	$template->setCurrentBlock("LIBROS");
	
	if($opc1==1){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using 	(idlibro) where titulo like '%$libro%'";	
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
		}
	}
	if($opc4==4){
		$query ="SELECT idlibro, titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where tema like'%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}	
	}
	if($opc3==3){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where editorial like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}	
	}
	if($opc2==2){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}	
	}
	if($opc1==1&&$opc2==2){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and titulo like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc1==1&&$opc3==3){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and editorial like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc1==1&&$opc4==4){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and tema like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc2==2&&$opc3==3){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and editorial like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc2==2&&$opc4==4){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and tema like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc3==3&&$opc4==4){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where editorial like '%$libro%' and tema like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc1==1&&$opc2==2&&$opc3==3){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and titulo like '%$libro%' and editorial like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc1==1&&$opc2==2&&$opc4==4){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and titulo like '%$libro%' and tema like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc1==1&&$opc3==3&&$opc4==4){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where titulo like '%$libro%' and tema like '%$libro%' and editorial like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc2==2&&$opc3==3&&$opc4==4){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and tema like '%$libro%' and editorial like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	if($opc1==1&&$opc2==2&&$opc3==3&&$opc4==4){
		$query ="SELECT idlibro,titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial,numero FROM pf_libros left join pf_lista using(idlibro) where autor like '%$libro%' and titulo like '%$libro%' and editorial like '%$libro%' and tema like '%$libro%'";
		$result = mysql_query($query) or die("Query 1 failed");	
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
		}		
	}
	$template->parseCurrentBlock("LIBROS");
	mysql_free_result($result);	 	
	mysql_close($link);
	if($x==1){
		$template->show();
	}
	else{
		header("Location: buscar_libro_error.php?token=$array");
	}
	
?>
