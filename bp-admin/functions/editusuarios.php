<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$USUARIO = $_REQUEST['USUARIO'];
$query = "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` = '" . $USUARIO . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
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
        echo '
    <div class="form">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
            $USUARIO = $_REQUEST['USUARIO'];
            $fecha = date("Y-m-d H:i:s"); //Fecha FECHA
            //Datos
            $nombre = $_REQUEST["nombre"];
            $apellidos = $_REQUEST["APELLIDOS"];
            $curso = $_REQUEST["CLASE"];

            $update = "UPDATE `$bbddusuarios` set NOMBRE='" . $nombre . "', APELLIDOS='" . $apellidos . "', CLASE='" . $curso . "' where USUARIO='" . $USUARIO . "'";
            mysqli_query($databaseconnection, $update);
            $status = "<div class='bp-card-info'><p class='btn btn-success'>Se ha actualizado el registro $USUARIO</p><br><br><a class='btn btn-link' href='/bp-admin/usuarios.php'>Volver al panel</a></div>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else {
            echo '
            <div class="bp-card-info card-body">
                <form name="form" method="post" action="">
                    <input style="float:right;" class="btn btn-danger" name="submit" type="submit" value="Actualizar" />
        
                        <table style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th><input type="hidden" name="new" value="1" /><input name="USUARIO" type="hidden" value="' . $row['USUARIO'] . '" /><h5>Nombre <input type="text" name="nombre" placeholder="Escribe el nombre del lector" required value="' . $row['NOMBRE'] . '" /></h5><h5>Apellidos <input type="text" name="APELLIDOS" placeholder="Escribe los apellidos del lector" required value="' . $row['APELLIDOS'] . '" /></h5></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p>Clase <em><input type="text" name="CLASE" placeholder="Escribe el curso" required value="' . $row["CLASE"] . '" /></em></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>';
        };
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
?>?>

<div>
</div>
</div>

</body>

</html>