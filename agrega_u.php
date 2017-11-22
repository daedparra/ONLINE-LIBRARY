<?php
/* agrega_u.php
Este programa agrega la informacion del usuario a la base de datos previamente hecha.
Daniela Requejo y David Parra 
3/11/2015 */
	include"config.php";
	$array=$_GET['token'];
	$link = mysql_pconnect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die("Could not connect to MySQL database");
	mysql_select_db($cfgServer['dbname']) or die("Could not select database");		
	$nombre=$_POST["nombre"];
	$appaterno= $_POST["appaterno"];
	$apmaterno=$_POST["apmaterno"];
	$fecha_nacimiento=$_POST["fecha_nacimiento"];
	$numcuenta=$_POST["numcuenta"];
	$carrera=$_POST["carrera"];
	$tipo=$_POST["tipo"];
	$mail=$_POST["mail"];
	$contrasenia=$_POST["contra"];
	$foto=$_FILES['userfile']['name'] ;
        $uploadDir = 'archivos/';
        $uploadFile = $uploadDir . $_FILES['userfile']['name'];
	if($foto!=""){
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
	}
	else{
	$foto="default.jpg" ;	
	}

	$query ="insert pf_usuario (nombre,appaterno,apmaterno,fecha_nacimiento,num_cuenta,carrera,idtipo,correo_electronico,foto,contrasenia) values ('$nombre','$appaterno','$apmaterno','$fecha_nacimiento','$numcuenta','$carrera',$tipo,'$mail','$foto','$contrasenia')";
	$result = mysql_query($query) or die("Query 1 failed");
	mysql_free_result($result);	 	
	mysql_close($link);
	header("Location: agregar_usuario.php?token=$array");
?>
