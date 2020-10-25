<!DOCTYPE html>
<html>
<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';

$_SESSION['ID'] = '';
// Check user and password
if (isset($_POST['pwd_submit'])) {

	$username = strip_tags($_POST['log']);
	$password = strip_tags($_POST['pwd']);
	$result = ($username == $userUpload) && ($password == $pwdUpload);

	if ($result) {
		$_SESSION['ID'] = 'ok';
	} else {
		$_SESSION['ID'] = 'failed';
	}
}

//Upload File
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
	}
	//Import uploaded file to Database
	ini_set("auto_detect_line_endings", true);
	//$query = "SET CHARACTER SET utf8";
	//$rs = mysql_query($query);
	$handle = fopen($_FILES['filename']['tmp_name'], "r");
	$fila = -5;
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
			$import = "INSERT INTO bp_catalogo (ANOPUB,AUTOR,EJEMPLAR,EDITORIAL,CIUDAD, SIGNATURA,TIPOEJEMPLAR,TITULO,UBICACION,ISBN) values('$data[0]','$data[1]','$data[3]','$data[9]','$data[32]','$data[43]','$data[45]','$data[47]','$data[49]','$data[18]')";
			$rs = mysqli_query($databaseconnection, $import);
		}
	}
	fclose($handle);
	$databaseconnection->close();
	$_SESSION['ID'] = '';
	echo "<div class='bp-card-info'><p>Se han procesado <b>$fila ejemplares</b><br /></p>\n<p class='btn btn-success'>Importaci&oacute;n terminada</p><br><br><a class='btn btn-link' href='/'>Volver al panel</a>";
} else {

	if (isset($_SESSION['ID'])) {
		$var_session = $_SESSION['ID'];
	} else {
		$var_session = "";
	}

	if ($var_session == 'ok') {
		echo "<div class='bp-card-info'><form enctype='multipart/form-data' action='abies.php' method='post'>Nombre de archivo *.TXT a subir:<br /><br />\n<input size='50' type='file' name='filename'><br /><br />\n<input type='submit' name='submit' value='Subir'></form></div>";
	} else {
		echo "<div class='bp-card-info'><form name='loginform' id='loginform' method='post' action='abies.php'>
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

</tr>
</table>
</td>
</tr>
</table>

</body>

</html>