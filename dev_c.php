<?php
/* dev.c.php
Este programa se devuelve el libro y se carga uno mas a la cantidad de libros de ese mismo. Se modifica automaticamente la bd
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	$array=explode(".",$_GET['token']);
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$query ="select curdate() as hoy";
	$result = mysql_query($query) or die("Query 1 failed");
	while($line = mysql_fetch_assoc($result)){
		$hoy=$line['hoy'];
	}
	$query1 ="select numero from pf_lista where idlibro=$array[1]";
	$result1 = mysql_query($query1) or die("Query 2 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$x=$line1['numero'];
	}
	$x=$x+1;
	$query2 ="update pf_lista set numero=$x where idlibro=$array[1]";
	$result2 = mysql_query($query2) or die("Query 3 failed");
	$query3 ="select id_ususario from pf_usuario where tokens=$array[0]";
	$result3 = mysql_query($query3) or die("Query 4 failed");
	while($line2 = mysql_fetch_assoc($result3)){
		$id=$line2['id_ususario'];
	}
	$query4 ="update pf_prestamo set fecha_entrega='$hoy' where idlibro=$array[1]";
	$result4 = mysql_query($query4) or die("Query 5 failed");
	header("Location: devolver_libro.php?token=$array[0]");
		
?>
