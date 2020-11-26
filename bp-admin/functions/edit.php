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
        if (isset($_POST['new']) && $_POST['new'] == 1) {
            $id = $_REQUEST['id'];
            $ANOPUB = mysqli_real_escape_string($databaseconnection, $_POST["anopub"]);
            $AUTOR = mysqli_real_escape_string($databaseconnection, $_POST["autor"]);
            $EJEMPLAR = mysqli_real_escape_string($databaseconnection, $_POST["ejemplar"]);
            $EDITORIAL = mysqli_real_escape_string($databaseconnection, $_POST["editorial"]);
            $TITULO = mysqli_real_escape_string($databaseconnection, $_POST["titulo"]);
            $UBICACION = mysqli_real_escape_string($databaseconnection, $_POST["ubicacion"]);
            $ISBN = mysqli_real_escape_string($databaseconnection, $_POST["isbn"]);
            $DESCRIPCION = mysqli_real_escape_string($databaseconnection, $_POST["descripcion"]);

            $update = "UPDATE `$bbddcatalogo` set ANOPUB='" . $ANOPUB . "', AUTOR='" . $AUTOR . "', EJEMPLAR='" . $EJEMPLAR . "', EDITORIAL='" . $EDITORIAL . "', TITULO='" . $TITULO . "', UBICACION='" . $UBICACION . "', ISBN='" . $ISBN . "', DESCRIPCION='" . $DESCRIPCION . "' where id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            $status = "<div class='bp-card-info'><p class='btn btn-success'>Se ha actualizado el registro $id</p><br><br><a class='btn btn-link' href='/'>Volver al panel</a></div>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else {
            echo '
            <div class="bp-card-info card-body">
                <form name="form" method="post" action="">
                    <input style="float:right;" class="btn btn-danger" name="submit" type="submit" value="Actualizar" />
        
                        <table style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th><p><strong>TÍTULO <input class="form-control" type="text" name="titulo" placeholder="Escribe el título" required value="' . $row['TITULO'] . '" /></strong></hp></th>
                                    <th><input type="hidden" name="new" value="1" /></th>
                                    <th><input name="id" type="hidden" value="' . $row['ID'] . '" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p><strong>AUTOR <input class="form-control" type="text" name="autor" placeholder="Escribe el Autor" required value="' . $row["AUTOR"] . '" /></strong></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p><strong>ISBN</strong> <em><input class="form-control" type="text" name="isbn" placeholder="Escribe el ISBN" required value="' . $row["ISBN"] . '" /></em></p></td>
                                    <td><p><strong>UBICACIÓN</strong> <em><input class="form-control" type="text" name="ubicacion" placeholder="Escribe dónde se sitúa este libro" required value="' . $row["UBICACION"] . '" /></em></td>
                                    <td><p><strong>EJEMPLAR</strong> <em><input class="form-control" type="text" name="ejemplar" placeholder="Escribe el identificador de Ejemplar" required value="' . $row["EJEMPLAR"] . '" /> </em></td>
                                </tr>
                                <tr>
                                    <td><p><strong>EDITORIAL</strong> <em><input class="form-control" type="text" name="editorial" placeholder="Escribe la Editorial" required value="' . $row["EDITORIAL"] . '" /></em></p></td>
                                    <td><p><strong>AÑO DE PUBLICACIÓN</strong> <em><input class="form-control" type="text" name="anopub" placeholder="Escribe el Año de Publicación" required value="' . $row["ANOPUB"] . '" /></td>
                                    <td><p><strong></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <strong>SIPNÓSIS</strong>
                        <textarea class="form-control" style="width:100%; height:30%;"name="descripcion" placeholder="Escribe un resumen del libro">' . $row["DESCRIPCION"] . '</textarea>
                    </form>
                </div>';
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