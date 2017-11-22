<?php
/* salir.php
Pone los tokens a NULL y se sale de la pagina y vuelve a la principal.
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
        require_once "HTML/Template/ITX.php";	
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query ="update pf_usuario set tokens=NULL";
	$result = mysql_query($query) or die("Query 1 failed");	
	mysql_free_result($result);	 	
	mysql_close($link);
	header("Location: principal.html");
?>
