<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
<title>Subir archivo</title>
<link rel="stylesheet" href="include/styles.css" type="text/css">
</head>
<body>
<!-- ******************* -->
<table border=0 cellspacing=0 cellpadding=0 width='450' align='left'>
  <tr><td>
<br>
<table border=0 cellspacing=0 cellpadding=0 width='100%'>
  <tr>
    <td>&nbsp;</td>
  <td width="41%" align=right>
<a href="javascript:self.parent.tb_remove();void(0)"><img src="images/logout.gif" align=absmiddle border=0><b> Cerrar</b></a>
</td></tr></table>
<!--Fin Tabla cabecera donde se encuentra el titulo de la pagina en cuestion -->
<!--******Tabla de Pestaña-->
<table cellSpacing=0 cellPadding=0 border=0 width="200">
<tr>
<td background="images/tile1.gif" bgColor="#efebf7" width="13"><img height="20" src="images/top_left.gif" width="13"></td>
<td background="images/tile1.gif"  bgColor="#efebf7">&nbsp;<b>Subir cat&aacute;logo</b></td>
<td background="images/tile1.gif" bgColor="#efebf7" width="15"><img height="20" src="images/top_right.gif" width="15"></td>
</tr>
<tr><td colspan="3"><img height="1"  src="images/spacer.gif" width="1"></td></tr>
</table>                          
<!--****Fin tabla de pestaña-->

<table border=0 cellspacing=1 cellpadding=0  bgcolor="#336699" align="center" width="100%"><tr><td>
<table border=0 cellspacing=0 cellpadding=10 width='100%' nowrap bgcolor=white>
<tr ><td class='Font8v' >
<!--Modulo de codigo-->
      
<?php
	include("include/conn.php");
	$_SESSION['ID'] = '';
// Check user and password
if(isset($_POST['pwd_submit'])) {
	
	$username = strip_tags($_POST['log']);
	$password = strip_tags($_POST['pwd']);
	$result = ($username == $userUpload ) && ($password == $pwdUpload);

	if($result){
		$_SESSION['ID'] = 'ok';
	} else {
		$_SESSION['ID'] = 'failed';
	}
}	

//Upload File
if (isset($_POST['submit'])) {
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<b>". $_FILES['filename']['name'] ."</b> subido con &eacute;xito." . "<br />\n";
    }
    // Eliminar tabla
    $sql = "DROP TABLE " . $tableMySQL; 
    $rs = mysqli_query($link,$sql);

	  // Crear tabla
	  $sql = 'CREATE TABLE ' . $tableMySQL . '( '.
       'ANOPUB VARCHAR(8), '.
       'AUTOR VARCHAR(30), '.
       'EJEMPLAR VARCHAR(8), '.
       'EDITORIAL VARCHAR(50), '.
       'SIGNATURA VARCHAR(18), '.
       'TIPOEJEMPLAR VARCHAR(12), '.
       'TITULO VARCHAR(80), '.
       'UBICACION VARCHAR(12), '.
       'ISBN VARCHAR(18), '.
       'CIUDAD VARCHAR(18), '.
       'PRIMARY KEY ( EJEMPLAR ))';
	   $rs = mysqli_query($link,$sql);
	   //Import uploaded file to Database
	  ini_set("auto_detect_line_endings", true);
	  //$query = "SET CHARACTER SET utf8";
		//$rs = mysql_query($query);
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
    $fila = -6;
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $fila++;
        if ($fila > 0) {
        	// Eliminar caracteres especiales que hacen fallar la consulta INSERT en MySQL        	
        	$data[0] = $link->real_escape_string($data[0]);
        	$data[1] = $link->real_escape_string($data[1]); 
        	$data[3] = $link->real_escape_string($data[3]);
        	$data[9] = $link->real_escape_string($data[9]);
        	$data[18] = $link->real_escape_string($data[18]);
        	$data[32] = $link->real_escape_string($data[32]); 
        	$data[43] = $link->real_escape_string($data[43]); 
        	$data[45] = $link->real_escape_string($data[45]); 
        	$data[47] = $link->real_escape_string($data[47]);
        	$data[49] = $link->real_escape_string($data[49]);
        	$import="INSERT INTO " .  $tableMySQL . " (ANOPUB,AUTOR,EJEMPLAR,EDITORIAL,CIUDAD, SIGNATURA,TIPOEJEMPLAR,TITULO,UBICACION,ISBN) values('$data[0]','$data[1]','$data[3]','$data[9]','$data[32]','$data[43]','$data[45]','$data[47]','$data[49]','$data[18]')";
      	  $rs = mysqli_query($link,$import);
      	}
    }
    fclose($handle);
    $link->close();
		$_SESSION['ID'] = '';
    echo "Se han procesado <b>$fila ejemplares</b><br />\n";
    echo "Importaci&oacute;n terminada";

  
   
} else {

if (isset($_SESSION['ID'])) {
$var_session = $_SESSION['ID'];
} else {
$var_session = "";
}

if($var_session=='ok') {
    echo "<form enctype='multipart/form-data' action='upload.php' method='post'>";
    echo "Nombre de archivo *.TXT a subir:<br /><br />\n";
    echo "<input size='50' type='file' name='filename'><br /><br />\n";
    echo "<input type='submit' name='submit' value='Subir'></form>";
   } else {
		echo"<form name='loginform' id='loginform' method='post' action='upload.php'>";
	  echo "<p><label>Usuario<br />";
	  echo "<input type='text' name='log' id='user_login' class='input' value='' size='20' /></label></p>";
	  echo "<p><label>Contrase&ntilde;a<br />";
	  echo "<input type='password' name='pwd' id='user_pass' class='input' value='' size='20'  /></label></p>";
	  echo "<p class='submit'><input type='submit' name='pwd_submit' id='pwd_submit' value='Iniciar sesi&oacute;n' /></p></form>";
	  if ($var_session == "failed") {
	  	echo "<p style=' color: red;'>Error en usuario o clave</p>";
	  }
	}
}
?>      
</td>
    
  </tr></table>
</td></tr></table>
<!--Fin Modulo de codigo-->


<table cellSpacing=0 cellPadding=0 border=0 width="100%">
<tr>
<TD colSpan=3 ><IMG height=1  src="images/spacer.gif" width=1></TD>
</tr>
<tr>
<td background=images/tile1.gif bgColor=#efebf7 width="13"><IMG  src="images/bottom_left.gif" width="13"></td>
<td bgColor=#ffffff background=images/bottom_center.gif align=right>&nbsp;</td>
<td background=images/tile1.gif bgColor=#efebf7 width="15"><IMG src="images/bottom_right.gif" width="15"></td>	
</tr></table>
           
      <table  border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
      <br>       	  

        </td></tr></table>

</td></tr></table>

</body>
</html>