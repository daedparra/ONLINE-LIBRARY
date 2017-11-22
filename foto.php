<?php
/* foto.php
Este programa lleva al usuario a la carpeta de archivos para cargar la foto y poderla subir
Daniela Requejo y David Parra 
3/11/2015 */

	include"config.php";
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");	
	$foto=$_FILES['userfile']['name'] ;
	$id=$_POST['id'];
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
	header("Location: modificar_usuario.php?token=$array");
?>
