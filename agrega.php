<?php
/* agrega.php
Este programa agrega la informacion del libro a la base de datos previamente hecha.
Daniela Requejo y David Parra 
3/11/2015 */

	include"config.php";
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$titulo=$_POST["titulo"];
	$tema = $_POST["tema"];
	$editorial=$_POST["editorial"];
	$fecha_libro=$_POST["fecha_libro"];
	$edicion=$_POST["edicion"];
	$autor=$_POST["autor"];
	$paginas=$_POST["paginas"];
	$libros=$_POST["libros"];
	$query ="insert pf_libros (titulo,tema,edicion,autor,num_paginas,fecha_registro,editorial) values ('$titulo','$tema','$edicion','$autor',$paginas,'$fecha_libro','$editorial')";
	$result = mysql_query($query) or die("Query 1 failed");
	$query1 ="select idlibro from pf_libros where titulo='$titulo'";
	$result1 = mysql_query($query1) or die("Query 2 failed");
	while($line = mysql_fetch_assoc($result1)){
		$id=$line['idlibro'];
	}
	$query2 ="insert pf_lista (numero,idlibro) values ($libros,$id)";
	$result2 = mysql_query($query2) or die("Query 3 failed");
	header("Location: agregar_libro.php?token=$array");
?>
