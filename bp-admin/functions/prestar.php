<!DOCTYPE html>
<html>
<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
$id = $_REQUEST['id'];
//Tomar datos de formulario añadir registro desde lectores.php
$nombre = $_REQUEST["element_1"];
$apellido = $_REQUEST["element_2"];
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
        $fnamechecksql = "SELECT * FROM `$bbddusuarios` WHERE `FULLNAME` = '" .$FNAME. "'";
        $fnamedata = mysqli_query($databaseconnection, $fnamechecksql);
        $fnamecheck = mysqli_fetch_assoc($fnamedata);
        $query = "SELECT * FROM `$tableMySQL` WHERE `ID` = '" . $id . "'";
        $result = mysqli_query($databaseconnection, $query);
        $row = mysqli_fetch_assoc($result);
        if($fnamecheck['FULLNAME'] == $FNAME){
            echo 'To correcto';
            print_r($fnamecheck);
            $sql = "UPDATE `bp_catalogo` SET `DISPONIBILIDAD` = '0', `PRESTADOA` = '" .$fnamecheck['USUARIO']. "', `FECHADEV` = '" .$timestamp. "' WHERE `bp_catalogo`.`ID` = ".$id;
            $databaseconnection->query($sql);
        }
        else {
            echo 'Ha fallado papu';
        }
        echo '
        <header>
            <div class="wrapper">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        echo '
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
                       <table>
                            <thead>
                                <tr>
                                    <th><h5>Se ha prestado el libro <em>' .$row['TITULO']. '</em> a <strong>' . $apellido . ', ' . $nombre . '</strong></h5></th>
                                </tr>
                            </thead>
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