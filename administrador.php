<?php
/* administrador.php
Este programa carga la informacion del nombre y la foto para poderla desplegarlo en su pagina principal. Por otro lado se checa el token. 
Daniela Requejo y David Parra 
3/11/2015 */

	include"config.php";
	require_once "HTML/Template/ITX.php";
	$template = new HTML_Template_ITX('./templates');
	$template->loadTemplatefile("administrador.html", true, true);
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");
	$query = "SELECT id_ususario from pf_usuario where tokens=$array";
	$result = mysql_query($query) or die("Query 1 failed");
	$x=0;	
	while($line = mysql_fetch_assoc($result)){
		if($line['id_ususario']==0){
			$x=0;
		}else{
			$x=1;
			$x1=$line['id_ususario'];
			$query1 = "SELECT tokens from pf_usuario where id_ususario=$x1";
			$result1 = mysql_query($query1) or die("Query 2 failed");
			while($line1 = mysql_fetch_assoc($result1)){
				if($array==$line1['tokens']){
					$query2 = "SELECT nombre,foto from pf_usuario where id_ususario=$x1";
					$result2 = mysql_query($query2) or die("Query 3 failed");
					while($line2 = mysql_fetch_assoc($result2)){
						$template->setVariable("NOMBRE", $line2['nombre']);
						$template->setVariable("FOTO",$line2['foto']);
						$template->setVariable("TOKEN",$array);
						
					}
				}
			}
		}
	}
	mysql_free_result($result);	 	
	mysql_close($link);
	if($x==1){
		$template->show();
	}
	else{
		header("Location: principal.html");
	}
?>
