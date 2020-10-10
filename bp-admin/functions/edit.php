<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
$query = "SELECT * FROM `$tableMySQL` WHERE `ID` = '" . $id . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
$loggedin = $_COOKIE["loggedin"];
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

            $update = "UPDATE $tableMySQL set ANOPUB='" . $ANOPUB . "', AUTOR='" . $AUTOR . "', EJEMPLAR='" . $EJEMPLAR . "', EDITORIAL='" . $EDITORIAL . "', TITULO='" . $TITULO . "', UBICACION='" . $UBICACION . "', ISBN='" . $ISBN . "', DESCRIPCION='" . $DESCRIPCION . "' where id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            $status = "<div class='loginsection'><p class='btn btn-success'>Se ha actualizado el registro $id</p><br><br><a class='btn btn-link' href='/bp-admin/catalogo.php'>Volver al panel</a></div>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else {
            echo '
            <div class="loginsection card-body">
                <form name="form" method="post" action="">
                    <input style="float:right;" class="btn btn-danger" name="submit" type="submit" value="Update" />
        
                        <table style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th><h5>Título <input type="text" name="titulo" placeholder="Escribe el título" required value="' . $row['TITULO'] . '" /></h5></th>
                                    <th><input type="hidden" name="new" value="1" /></th>
                                    <th><input name="id" type="hidden" value="' . $row['ID'] . '" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p>Autor <em><input type="text" name="autor" placeholder="Escribe el Autor" required value="' . $row["AUTOR"] . '" /></em></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p><strong>ISBN</strong> <em><input type="text" name="isbn" placeholder="Escribe el ISBN" required value="' . $row["ISBN"] . '" /></em></p></td>
                                    <td><p><strong>Ubicación</strong> <em><input type="text" name="ubicacion" placeholder="Escribe dónde se sitúa este libro" required value="' . $row["UBICACION"] . '" /></em></td>
                                    <td><p><strong>Ejemplar</strong> <em><input type="text" name="ejemplar" placeholder="Escribe el identificador de Ejemplar" required value="' . $row["EJEMPLAR"] . '" /> </em></td>
                                </tr>
                                <tr>
                                    <td><p><strong>Editorial</strong> <em><input type="text" name="editorial" placeholder="Escribe la Editorial" required value="' . $row["EDITORIAL"] . '" /></em></p></td>
                                    <td><p><strong>Año de Publicación</strong> <em><input type="text" name="anopub" placeholder="Escribe el Año de Publicación" required value="' . $row["ANOPUB"] . '" /></td>
                                    <td><p><strong></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <strong>Descripción</strong>
                        <textarea style="width:100%; height:30%;"name="descripcion" placeholder="Escribe un resumen del libro">' . $row["DESCRIPCION"] . '</textarea>
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

<div>
</div>
</div>
<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>