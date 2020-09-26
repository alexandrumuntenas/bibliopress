<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';

?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8"/>
        <title>
        <?php echo "Biblioteca del " . $sname;?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/bp-content/themes/vexia/style.css">
        <script src="https://use.fontawesome.com/releases/v5.14.0/js/all.js" data-auto-replace-svg="nest"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>
<body class="headerlogin">
<!--Modulo de codigo-->
      
<?php
	
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
    }
    // Eliminar tabla
    $sql = "DROP TABLE " . $tableMySQL; 
    $rs = mysqli_query($databaseconnection,$sql);

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
	   $rs = mysqli_query($databaseconnection,$sql);
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
        	$data[0] = $databaseconnection->real_escape_string($data[0]);
        	$data[1] = $databaseconnection->real_escape_string($data[1]); 
        	$data[3] = $databaseconnection->real_escape_string($data[3]);
        	$data[9] = $databaseconnection->real_escape_string($data[9]);
        	$data[18] = $databaseconnection->real_escape_string($data[18]);
        	$data[32] = $databaseconnection->real_escape_string($data[32]); 
        	$data[43] = $databaseconnection->real_escape_string($data[43]); 
        	$data[45] = $databaseconnection->real_escape_string($data[45]); 
        	$data[47] = $databaseconnection->real_escape_string($data[47]);
        	$data[49] = $databaseconnection->real_escape_string($data[49]);
        	$import="INSERT INTO " .  $tableMySQL . " (ANOPUB,AUTOR,EJEMPLAR,EDITORIAL,CIUDAD, SIGNATURA,TIPOEJEMPLAR,TITULO,UBICACION,ISBN) values('$data[0]','$data[1]','$data[3]','$data[9]','$data[32]','$data[43]','$data[45]','$data[47]','$data[49]','$data[18]')";
      	  $rs = mysqli_query($databaseconnection,$import);
      	}
    }
    fclose($handle);
    $databaseconnection->close();
		$_SESSION['ID'] = '';
    echo "<div class='loginsection'><p>Se han procesado <b>$fila ejemplares</b><br /></p>\n<p class='btn btn-success'>Importaci&oacute;n terminada</p><br><br><a class='btn btn-link' href='/bp-admin/panel.php'>Volver al panel</a>";

  
   
} else {

if (isset($_SESSION['ID'])) {
$var_session = $_SESSION['ID'];
} else {
$var_session = "";
}

if($var_session=='ok') {
    echo "<div class='loginsection'><form enctype='multipart/form-data' action='abies.php' method='post'>Nombre de archivo *.TXT a subir:<br /><br />\n<input size='50' type='file' name='filename'><br /><br />\n<input type='submit' name='submit' value='Subir'></form></div>";
   } else {
		echo"<div class='loginsection'><form name='loginform' id='loginform' method='post' action='abies.php'>
<p><label>Usuario<br /><input type='text' name='log' id='user_login' class='input' value='' size='20' /></label></p>
<p><label>Contrase&ntilde;a<br /><input type='password' name='pwd' id='user_pass' class='input' value='' size='20'  /></label></p>
<p class='submit'><input class='btn btn-primary' type='submit' name='pwd_submit' id='pwd_submit' value='Iniciar sesi&oacute;n' /></p></form></div>";
	  if ($var_session == "failed") {
	  	echo "<p style=' color: red;'>Error en usuario o clave</p>";
	  }
	}
}
?>      
</td>
    
  </tr></table>
</td></tr></table>

</body>
</html>