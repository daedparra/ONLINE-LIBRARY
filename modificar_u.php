<?php
/* modifica_p.php
Este programa modifica cualquier cosa seleccionada previamente en el template para una vez asi actualizar automaticamente en la bd.
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");	
	$x=$_POST['usuario'];
	$id=$_POST['id'];
	$modificar=$_POST['modifica'];	
	if($x==1){
		$query ="update pf_usuario set nombre='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 1 failed");	
	}
	if($x==2){
		$query ="update pf_usuario set appaterno='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 2 failed");	
	}
	if($x==3){
		$query ="update pf_usuario set apmaterno='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 3 failed");	
	}
	if($x==4){
		$query ="update pf_usuario set carrera='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 4 failed");	
	}
	if($x==5){
		$query ="update pf_usuario set fecha_nacimiento='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 5 failed");	
	}
	if($x==6){
		$query ="update pf_usuario set correo_electronico='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 6 failed");	
	}
	if($x==7){
		$query ="update pf_usuario set num_cuenta='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 7 failed");	
	}
	if($x==8){
		$query ="update pf_usuario set contrasenia='$modificar' where id_ususario=$id";
		$result = mysql_query($query) or die("Query 8 failed");	
	}
	if($x==9){
		$query ="update pf_usuario set idtipo=$modificar where id_ususario=$id";
		$result = mysql_query($query) or die("Query 9 failed");	
	}
	mysql_free_result($result);	 	
	mysql_close($link);	
	header("Location: modificar_usuario.php?token=$array");
?>
