<!DOCTYPE html>
<html>
<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];

//Tomar datos de formulario añadir registro desde lectores.php
$nombre = $_REQUEST["element_1"];
$apellido = $_REQUEST["element_2"];
$curso = $_REQUEST["element_3"];
function generateRandomString($length = 9)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$usuarioc = generateRandomString(9);
$pin = rand();
$FNAME = "$nombre $apellido";
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
        $insert = "INSERT INTO $bbddusuarios (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PIN`) VALUES ('$usuarioc','$FNAME','$nombre','$apellido','$curso', '$pin')";
        $databaseconnection->query($insert);
        echo '
        <header>
            <div class="wrapper">';
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
            <div class="bp-card card-body">
                       <table>
                            <thead>
                                <tr>
                                    <th><h5><strong>' . $apellido . ', ' . $nombre . '</strong></h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p>Curso > ' . $curso . '</p></td>
                                </tr>
                            </tbody>
                        </table> </div>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/bp-admin/lectores.php">Volver</a>
                            <input type = "button" class="btn btn-success" value = "Imprimir página" onclick = "window.print()" />
                        </div>
            
        </section>';
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
};
?>
<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>