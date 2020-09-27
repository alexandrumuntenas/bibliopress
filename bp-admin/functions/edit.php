<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
$query = "SELECT * FROM `$tableMySQL` WHERE `ID` = '" . $id . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
$loggedin = $_COOKIE["loggedin"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.html';?>

<body class="headerlogin">
    <div class="form">
    <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.html';?>
        <?php
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
            $id = $_REQUEST['id'];
            $fecha = date("Y-m-d H:i:s"); //Fecha FECHA
            //Datos
            $ANOPUB = $_REQUEST["anopub"];
            $AUTOR = $_REQUEST["autor"];
            $EJEMPLAR = $_REQUEST["ejemplar"];
            $EDITORIAL = $_REQUEST["editorial"];
            $TITULO = $_REQUEST["titulo"];
            $UBICACIONs = $_REQUEST["ubicacion"];
            $ISBN = $_REQUEST["isbn"];

            $update = "UPDATE $tableMySQL set ANOPUB='" . $ANOPUB . "', AUTOR='" . $AUTOR . "', EJEMPLAR='" . $EJEMPLAR . "', EDITORIAL='" . $EDITORIAL . "', TITULO='" . $TITULO . "', UBICACION='" . $UBICACION . "', ISBN='" . $ISBN . "' where id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            $status = "<div class='loginsection'><p class='btn btn-success'>Se ha actualizado el registro $id</p><br><br><a class='btn btn-link' href='/bp-admin/panel.php'>Volver al panel</a></div>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else {
            echo '
            <div class="loginsection card-body">
                <form name="form" method="post" action="">
                    <input style="float:right;" class="btn btn-danger" name="submit" type="submit" value="Update" />
        
                        <table style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th><h5>Título <input type="text" name="titulo" placeholder="Escribe el título" required value="'. $row['TITULO'] . '" /></h5></th>
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
                    </form>
                </div>';
        }; ?>

        <div>
        </div>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
</body>

</html>