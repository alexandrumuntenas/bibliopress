<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];

//Tomar datos de formulario añadir registro desde panel.php
$titulo = $_REQUEST["element_1"];
$autor = $_REQUEST["element_2"];
$ISBN = $_REQUEST["element_3"];
$editorial = $_REQUEST["element_4"];
$anopub = $_REQUEST["element_5"];
$ejemplar = $_REQUEST["element_6"];
$ubicacion = $_REQUEST["element_7"];
$disponibilidad = "En desarrollo!";

//Utilizado durante las pruebas
/*$titulo = "Hola";
$autor = "SM";
$ISBN = "181818";
$editorial = "SM";
$anopub = "1919";
$ejemplar = "1191";
$ubicacion = "13";*/

$insert = "INSERT INTO $tableMySQL(`ANOPUB`, `AUTOR`, `EJEMPLAR`, `EDITORIAL`,`TITULO`, `UBICACION`, `ISBN`) VALUES ('$anopub','$autor','$ejemplar','$editorial','$titulo','$ubicacion','$ISBN')";
$databaseconnection->query($insert);

//Futura interfaz de información
?>
<!DOCTYPE html>
<html>
    <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.html';?>
    <body>
        <header>
            <div class="wrapper">
            <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.html';?>
        </header>
            <div class="header">
                <h2 class="centered">Dashboard</h2>
            </div>
        </header>
        <section class="section">
            <div>
                <h2 class="stitle"></h2>
            </div>
            <div class="cardse card-body">
                       <?php echo "<table>
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
                                    <td><p><strong>ISBN</strong> <em>' . $ISBN . '</em></p></td>
                                    <td><p><strong>Ubicación</strong> <em>' . $ubicacion . '</td>
                                    <td><p><strong>Disponibilidad</strong>'. $disponibilidad .' <em></td>
                                </tr>
                                <tr>
                                    <td><p><strong>Editorial</strong> <em>' . $editorial . '</em></p></td>
                                    <td><p><strong>Año de Publicación</strong> <em>' . $anopub . '</td>
                                    <td><p><strong>Ejemplar</strong> <em>' . $ejemplar . '</td>
                                </tr>
                            </tbody>
                        </table> </div>"; ?>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/bp-admin/panel.php">Volver</a>
                            <input type = "button" class="btn btn-success" value = "Imprimir página" onclick = "window.print()" />
                        </div>
            
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>
