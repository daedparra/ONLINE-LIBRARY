<?php
/* rentar_l.php
Este programa nos permite rentar un libro y descontarle uno a la cantidad de esos y tenerlo guardado en la base para cuando se regrese llegue a su numero original.
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
	if($x>0){
		$x=$x-1;
		$query2 ="update pf_lista set numero=$x where idlibro=$array[1]";
		$result2 = mysql_query($query2) or die("Query 3 failed");
		$query3 ="select id_ususario from pf_usuario where tokens=$array[0]";
		$result3 = mysql_query($query3) or die("Query 4 failed");
		while($line2 = mysql_fetch_assoc($result3)){
			$id=$line2['id_ususario'];
		}
		$query4 ="insert pf_prestamo (idlibro, id_ususario, fecha_retiro, fecha_vencimiento) values ($array[1],$id,'$hoy',date_add('$hoy',interval 10 day))";
		$result4 = mysql_query($query4) or die("Query 5 failed");
	}
		header("Location: user.php?token=$array[0]");
		
?>
