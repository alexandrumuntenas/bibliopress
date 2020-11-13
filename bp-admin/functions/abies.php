<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err404">';
    }
} else {
    echo '<body class="err404">';
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
		
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
	}
	ini_set("auto_detect_line_endings", true);
	$handle = fopen($_FILES['filename']['tmp_name'], "r");
	$fila = -5;
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		$fila++;
		if ($fila > 0) {
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
			$import = "INSERT INTO `bp_catalogo` (ANOPUB,AUTOR,EJEMPLAR,EDITORIAL,CIUDAD, SIGNATURA,TIPOEJEMPLAR,TITULO,UBICACION,ISBN) values('$data[0]','$data[1]','$data[3]','$data[9]','$data[32]','$data[43]','$data[45]','$data[47]','$data[49]','$data[18]')";
			$rs = mysqli_query($databaseconnection, $import);
		}
	}
	fclose($handle);
	$databaseconnection->close();
	$_SESSION['ID'] = '';
	echo "<div class='bp-card-info'><p>Se han procesado <b>$fila ejemplares</b><br /></p>\n<p class='btn btn-success'>Importaci&oacute;n terminada</p><br><br><a class='btn btn-link' href='/'>Volver al panel</a>";
} else {

	echo "<div class='bp-card-info'><form enctype='multipart/form-data' action='abies.php' method='post'>Nombre de archivo *.TXT a subir:<br /><br />\n<input size='50' type='file' name='filename'><br /><br />\n<input type='submit' name='submit' value='Subir'></form></div>";

}
    } else {

        echo '<section class="error-container">
                                <span><span>4</span></span>
                                <span>0</span>
                                <span><span>4</span></span>
                              </section>
                              <center>
                                <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
                                <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
    }
} else {
    echo '<section class="error-container">
                            <span><span>4</span></span>
                            <span>0</span>
                            <span><span>4</span></span>
                          </section>
                          <center>
                          <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
                          <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
} ?>
</body>

</html>