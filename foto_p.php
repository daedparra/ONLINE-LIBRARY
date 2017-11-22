<?php
/* foto_p.php
Este programa permite camiar la foto del administrador y cargarla nuevamente y actualizarla en la bd
Daniela Requejo y David Parra 
3/11/2015 */

	include"config.php";
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");	
	$foto=$_FILES['userfile']['name'] ;
	$query1 = "SELECT id_ususario from pf_usuario where tokens=$array";
	$result1 = mysql_query($query1) or die("Query 1 failed");
	while($line1 = mysql_fetch_assoc($result1)){
		$id=$line1['id_ususario'];	
	}
	$query ="update pf_usuario set foto='$foto' where id_ususario=$id";
	$result = mysql_query($query) or die("Query 1 failed");
	mysql_free_result($result);
        $uploadDir = 'archivos/';
        $uploadFile = $uploadDir . $_FILES['userfile']['name'];

	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile))	
 	{	
              print "<tr>";
    	      print "<td align=\"center\" class=\"comText\">";
            print "El archivo " .$_FILES['userfile']['name'] ." se subi&oacute; satisfactoriamente";
   	    print "</td>";
            print "</tr>";
       }
       else{
           print "<tr>";
    	   print "<td align=\"center\" class=\"comText\">";
	   print "Error al subir el archivo";
   	print "</td>";
        print "</tr>";
      }
	mysql_close($link);	
	header("Location: cambia_perfil.php?token=$array");	 	

?>
