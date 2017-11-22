<?php
/* coment.php
Este programa se carga el comentario a la base de datos.
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	$array=explode(".",$_GET['token']);
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$comentarios=$_POST['edicion'];
	$query ="select id_ususario from pf_usuario where tokens=$array[0]";
	$result = mysql_query($query) or die("Query 1 failed");
	while($line = mysql_fetch_assoc($result)){
		$id=$line['id_ususario'];
	}
	$query1 ="insert pf_comentarios (comentarios,idlibro,id_ususario) values ('$comentarios',$array[1],$id)";
	$result1 = mysql_query($query1) or die("Query 2 failed");
	header("Location: info1.php?token=$array[0].$array[1]");
?>
