<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
$query = "SELECT * FROM `$bbddcatalogo` WHERE `ID` = '" . $id . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
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
        echo '<div class="form">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        $status = "";
        $id = $_REQUEST['id'];

        $update = "UPDATE `$bbddcatalogo` set DISPONIBILIDAD='1', PRESTADOA='' where id='" . $id . "'";
        mysqli_query($databaseconnection, $update);
        echo mysqli_error($databaseconnection);
        $status = "<div class='bp-card-info'><p class='btn btn-success'>Se ha devuelto el libro con identificador $id</p><br><br><a class='btn btn-link' href='/bp-admin/prestamos.php'>Volver al panel</a></div>";
        echo '<p style="color:#FF0000;">' . $status . '</p>';
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
                        <span><span>3</span></span>
                      </section>
                      <center>
                      <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                      <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>

<div>
</div>
</div>
</body>

</html>