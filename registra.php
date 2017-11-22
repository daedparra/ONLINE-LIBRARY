<?php
/* registra.php
Este programa registra un nuevo usuario, es decir lo agrega a la bd.
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$nombre=$_POST["nombre"];
	$appaterno= $_POST["appaterno"];
	$apmaterno=$_POST["apmaterno"];
	$fecha_nacimiento=$_POST["fecha_nacimiento"];
	$numcuenta=$_POST["numcuenta"];
	$carrera=$_POST["carrera"];
	$mail=$_POST["mail"];
	$contrasenia=$_POST["contra"];
	$foto="default.jpg";
	$tipo=2;
	$query ="insert pf_usuario (nombre,appaterno,apmaterno,fecha_nacimiento,num_cuenta,carrera,idtipo,correo_electronico,foto,contrasenia) values ('$nombre','$appaterno','$apmaterno','$fecha_nacimiento','$numcuenta','$carrera',$tipo,'$mail','$foto','$contrasenia')";
	$result = mysql_query($query) or die("Query 1 failed");
	mysql_free_result($result);	 	
	mysql_close($link);
	header("Location: principal.html");
?>
