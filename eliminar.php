<?php
/* eliminar.php
Este programa elimina libros de la base de datos
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$titulo=$_POST["titulo"];
	$edicion=$_POST["edicion"];
	$libros=$_POST["libros"];
	$query ="select idlibro from pf_libros where titulo='$titulo'";
	$result = mysql_query($query) or die("Query 1 failed");
	while($line = mysql_fetch_assoc($result)){
		$id=$line['idlibro'];
	}
	$query1 ="select numero from pf_lista where idlibro=$id";
	$result1 = mysql_query($query1) or die("Query 2 failed");
	while($line = mysql_fetch_assoc($result1)){
		$x=$line['numero'];
	}
	$x=$x-$libros;
	if($x==0){
		$query2 ="delete from pf_libros where idlibro=$id";
		$result2 = mysql_query($query2) or die("Query 3 failed");
		$query3 ="delete from pf_lista where idlibro=$id";
		$result3 = mysql_query($query3) or die("Query 4 failed");	
	}else{
		$query4 ="update pf_lista set numero=$x where idlibro=$id";
		$result4 = mysql_query($query4) or die("Query 5 failed");

	}
	header("Location: eliminar_libro.php?token=$array");
?>
