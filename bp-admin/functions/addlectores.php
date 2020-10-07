<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];

//Tomar datos de formulario añadir registro desde catalogo.php
$nombre = $_REQUEST["element_1"];
$apellido = $_REQUEST["element_2"];
$curso = $_REQUEST["element_3"];
$fechaalta = date('d-j-Y');
$usuario = "$nombre$apellido";
$usuariob = str_replace(' ', '', $usuario);
$usuarioc = strtolower($usuariob);
$insert = "INSERT INTO bp_estudiantes (`USUARIO`,`NOMBRE`,`APELLIDOS`,`FECHA_ALTA`,`CLASE`) VALUES ('$usuarioc','$nombre','$apellido','$fechaalta','$curso')";
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
                                    <th><h5><strong>" . $apellido . ", " . $nombre . "</strong></h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p>Fecha de Alta > <em>" . $fechaalta . "</em></p><p>Curso > " . $curso . "</p></td>
                                </tr>
                            </tbody>
                        </table> </div>"; ?>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/bp-admin/lectores.php">Volver</a>
                            <input type = "button" class="btn btn-success" value = "Imprimir página" onclick = "window.print()" />
                        </div>
            
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>
