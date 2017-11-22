<?php
/* eliminar_u.php
Este programa elimina el usuario que se escribio de la base de datos
Daniela Requejo y David Parra 
3/11/2015 */

	include"config.php";
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$nombre=$_POST["nombre"];
	$appaterno=$_POST["appaterno"];
	$apmaterno=$_POST["apmaterno"];
	$query ="delete from pf_usuario where nombre='$nombre' and appaterno='$appaterno' and apmaterno='$apmaterno'";
	$result = mysql_query($query) or die("Query 1 failed");
	header("Location: eliminar_user.php?token=$array");
?>
