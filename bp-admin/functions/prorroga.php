<!DOCTYPE html>
<html>
<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
//Tomar datos de formulario añadir registro desde lectores.php
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

        $query = "SELECT * FROM `bp_catalogo` WHERE `ID` = '" . $id . "'";
        $result = mysqli_query($databaseconnection, $query);
        $row = mysqli_fetch_assoc($result);
        $sql = "UPDATE `bp_catalogo` SET `FECHADEV` = '" . $prorrogafecha . "' WHERE `bp_catalogo`.`ID` = " . $id;
        $databaseconnection->query($sql);

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
            <div class="bp-card card-body"><h5>Se ha atrasado la devolución del libro <em>' . $row['TITULO'] . '</em></h5></div>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/bp-admin/prestamos.php">Volver</a>
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
}

?>
</body>

</html>