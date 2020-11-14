<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';

$nombre = $_POST["element_1"];
$apellido = $_POST["element_2"];
$curso = $_POST["element_3"];
$permiso = $_POST["element_4"];

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
        $insert = "INSERT INTO `$bbddusuarios` (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PIN`,`PERM`) VALUES ('$usuarioc','$FNAME','$nombre','$apellido','$curso', '$pin', '$permiso')";
        $databaseconnection->query($insert);
        echo mysqli_error($databaseconnection);
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
                                    <td><p>Grupo > ' . $curso  . '</p></td>
                                </tr>
                            </tbody>
                        </table> </div>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/bp-admin/usuarios.php">Volver</a>
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

</body>

</html>