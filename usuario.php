<?php
/* usuario.php
Este programa verifica que tipo de usuario es si es administrador o no y asi poder mandarlo a otro programa para que entren a su correspondiente pagina principal.
Daniela Requejo y David Parra 
3/11/2015 */
    include"config.php";
    require_once "HTML/Template/ITX.php";	
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$formPassword1=$_POST["formPassword1"];
	$userName = $_POST["userName"];
	$query ="SELECT idtipo,id_ususario from pf_usuario where num_cuenta='$userName' and contrasenia='$formPassword1'";
	$result = mysql_query($query) or die("Query 1 failed");
	$x=0;	
	while($line = mysql_fetch_assoc($result)){	
		$tipo = $line['idtipo'];
		if($line['idtipo'] == 1){
			$token=rand(1,1000);
			$token1=$line['id_ususario'];
			$query="update pf_usuario set tokens=$token where id_ususario=$token1";
			$result = mysql_query($query) or die("Query 1 failed");
			header("Location: administrador.php?token=$token");	
			$x=1;
		}
		if($line['idtipo'] == 2){		
			$token=rand(1,1000);
			$token1=$line['id_ususario'];
			$query="update pf_usuario set tokens=$token where id_ususario=$token1";
			$result = mysql_query($query) or die("Query 1 failed");
			header("Location: user.php?token=$token");        
			$x=1;
		}
	}// while
	if($x==0){
		header("Location: principal_error.html");
	}
	mysql_free_result($result);
	mysql_close($link);
?>

