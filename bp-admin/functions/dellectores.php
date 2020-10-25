<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
$USUARIO = $_REQUEST['USUARIO'];
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
        $devolucionlibros = "UPDATE FROM `bp_catalogo` WHERE ";
        $query = "DELETE FROM `$bbddusuarios` WHERE `USUARIO` = '" . $USUARIO . "' ";
        $result = mysqli_query($databaseconnection, $query);
        $err = mysqli_error($databaseconnection);
        echo $err;
        echo '<header>
            <div class="wrapper">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        echo '</header>
    <div class="bp-card-info">';
        echo "<p class='btn btn-danger'>Se ha eliminado el usuario $USUARIO</p><br><br><a class='btn btn-link' href='/bp-admin/lectores.php'>Volver al panel</a>
    </div>";
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