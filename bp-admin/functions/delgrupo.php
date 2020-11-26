<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$GRUPO = $_REQUEST['GRUPO'];
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err403">';
    }
} else {
    echo '<body class="err403">';
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        $devolucionlibros = "UPDATE FROM `$bbddcatalogo` WHERE ";
        $query = "DELETE FROM `$bbddgrupos` WHERE `ID` = '" . $GRUPO . "' ";
        $result = mysqli_query($databaseconnection, $query);
        $err = mysqli_error($databaseconnection);
        echo $err;
        echo '<header>
            <div class="wrapper">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        echo '</header>
    <div class="bp-card-info">';
        echo "<p class='btn btn-danger'>Se ha eliminado el grupo con identificador $GRUPO</p><br><br><a class='btn btn-link' href='/bp-admin/grupos.php'>Volver al panel</a>
    </div>";
    } else {

        echo '<section class="error-container">
                                <span><span>4</span></span>
                                <span>0</span>
                                <span><span>4</span></span>
                              </section>
                              <center>
                                <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                                <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
    }
} else {
    echo '<section class="error-container">
                            <span><span>4</span></span>
                            <span>0</span>
                            <span><span>4</span></span>
                          </section>
                          <center>
                          <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                          <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>

</body>

</html>