<!DOCTYPE html>
<html>
<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';

//Tomar datos de formulario añadir registro desde catalogo.php
$titulo = mysqli_real_escape_string($databaseconnection, $_POST["element_1"]);
$autor = mysqli_real_escape_string($databaseconnection, $_POST["element_2"]);
$ISBN = mysqli_real_escape_string($databaseconnection, $_POST["element_3"]);
$editorial = mysqli_real_escape_string($databaseconnection, $_POST["element_4"]);
$anopub = mysqli_real_escape_string($databaseconnection, $_POST["element_5"]);
$ejemplar = mysqli_real_escape_string($databaseconnection, $_POST["element_6"]);
$ubicacion = mysqli_real_escape_string($databaseconnection, $_POST["element_7"]);
$descripcion = mysqli_real_escape_string($databaseconnection, $_POST["element_8"]);

//Utilizado durante las pruebas
/*$titulo = "Hola";
$autor = "SM";
$ISBN = "181818";
$editorial = "SM";
$anopub = "1919";
$ejemplar = "1191";
$ubicacion = "13";*/
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
        $insert = "INSERT INTO `$bbddcatalogo`(ANOPUB, AUTOR, EJEMPLAR, EDITORIAL,TITULO, UBICACION, ISBN, DESCRIPCION) VALUES ('$anopub','$autor','$ejemplar','$editorial','$titulo','$ubicacion','$ISBN','$descripcion')";
        $databaseconnection->query($insert);
        echo '<header><div class="wrapper">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        echo '
        </header>
            <div class="bp-header">
                <h2 class="bp-page-title">Dashboard</h2>
            </div>
        </header>
        <section class="bp-section">
            <div>
                <h2 class="stitle"></h2>
            </div>
            <div class="bp-card-info">
                       <?php 
                       echo "<table>
                            <thead>
                                <tr>
                                    <th><h5><strong>' . $titulo . '</strong></h5></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p><em>' . $autor . '</em></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p><strong>Sipnósis <br></strong> <em>' . $descripcion . '</em></p></td>
                                </tr>
                                <tr>
                                    <td><p><strong>ISBN</strong> <em>' . $ISBN . '</em></p></td>
                                    <td><p><strong>Ubicación</strong> <em>' . $ubicacion . '</td>
                                </tr>
                                <tr>
                                    <td><p><strong>Editorial</strong> <em>' . $editorial . '</em></p></td>
                                    <td><p><strong>Año de Publicación</strong> <em>' . $anopub . '</td>
                                    <td><p><strong>Ejemplar</strong> <em>' . $ejemplar . '</td>
                                </tr>
                            </tbody>
                        </table> </div>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/">Volver</a>
                            <input type = "button" class="btn btn-success" value = "Imprimir página" onclick = "window.print()" />
                        </div>
            
        </section>';
    } else {

        echo '<section class="error-container">
                        <span><span>4</span></span>
                        <span>0</span>
                        <span><span>3</span></span>
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
};
?>
</body>

</html>