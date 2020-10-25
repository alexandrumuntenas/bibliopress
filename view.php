<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
if (empty($_POST['escaner'])) {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM `$tableMySQL` WHERE `ID` = '" . $id . "'";
    $result = mysqli_query($databaseconnection, $query);
    $row = mysqli_fetch_assoc($result);  ?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $row["TITULO"]; ?> < Biblioteca</title> <meta charset="utf-8">
            <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php'; ?>

<body>
    <div class="bp-header">
        <h2 class="bp-page-title"><?php echo $row["TITULO"]; ?></h2>
    </div>
    <div class="">

        <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php'; ?>
        <?php
        echo '
            <div class="bp-viewer">
            <div class="col-sm">
            ';
        if ($row['DISPONIBILIDAD'] == 1) {
            echo '<h5 class="btn btn-success"><strong>' . $row["TITULO"] . '</strong></h5>';
        } else {
            echo '<h5 class="btn btn-danger"><strong>' . $row["TITULO"] . '</strong></h5>';
        }

        if ($sessionlogged == 1) {
            if ($sessionclass == 1) {
                if ($row['DISPONIBILIDAD'] == 1) {
                    echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $id . '">Préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $id . '">Editar</a><a style="margin-left: 10px;color: red;" href="bp-admin/functions/delete.php?id=' . $id . '">Eliminar</a>';
                } else {
                    echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $id . '">Gestionar préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $id . '">Editar</a><a style="margin-left: 10px;color: red;" href="bp-admin/functions/delete.php?id=' . $id . '">Eliminar</a>';
                }
                
            } else {
                if ($row['DISPONIBILIDAD'] == 1) {
                    echo '<a style="margin-left: 10px;color: green;" href="bp-admin/acciones/solicitar.php?id=' . $id . '">Solicitar</a>';
                } else {
                    echo '<a style="margin-left: 10px;color: gray;" href="bp-admin/acciones/notify.php?id=' . $id . '">Avísame cuando esté disponible</a>';
                }
                echo '';
            }
        }
        echo '
            <p><em>' . $row["AUTOR"] . '</em></p>
            <p>Sinópsis </p>
            <p><em>' . $row["DESCRIPCION"] . '</em></p>
            </div>
            <div class="col-sm">
            <p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p>
            <p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</p></em>
            <p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></p>
            <p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</em></p>
            <p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p>'; ?>
        <a class="btn btn-info" href="/">
            < Volver</a> </div> </div> </div> <footer class="page-footer bg-primary">
                <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress
        </a>
    </div>
    </footer>
</body>

</html>
<?php
} else { 
    $id = $_POST["escaner"];
    $query = "SELECT * FROM `$tableMySQL` WHERE `ID` = '" . $id . "'";
    $result = mysqli_query($databaseconnection, $query);
    $row = mysqli_fetch_assoc($result);  
    if (mysqli_num_rows($result)==0) { 
        ?>
<!DOCTYPE html>
<html>

<head>
    <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php'; ?>

<body>
    <div class="bp-header">
        <h2 class="bp-page-title">Visor</h2>
    </div>
    <div class="">

        <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php'; ?>
        <?php
        echo '
            <div class="bp-viewer">
            <center>
            <img src="/bp-include/x.png"/>
            </center>
            <div class="col-sm">
            <p>El visor no ha podido encontrar ningún registro en la base de datos con el identificador '.$id.'. Comprueba que se haya escaneado correctamente el identificador.
            </p>';
        ?>
        <a class="btn btn-info" href="/">
            < Volver</a> </div> </div> </div> <footer class="page-footer bg-primary">
                <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress
        </a>
    </div>
    </footer>
</body>
<?php
} else {?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $row["TITULO"]; ?> < Biblioteca</title> <meta charset="utf-8">
            <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php'; ?>

<body>
    <div class="bp-header">
        <h2 class="bp-page-title"><?php echo $row["TITULO"]; ?></h2>
    </div>
    <div class="">

        <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php'; ?>
        <?php
        echo '
            <div class="bp-viewer">
            <div class="col-sm">
            ';
        if ($row['DISPONIBILIDAD'] == 1) {
            echo '<h5 class="btn btn-success"><strong>' . $row["TITULO"] . '</strong></h5>';
        } else {
            echo '<h5 class="btn btn-danger"><strong>' . $row["TITULO"] . '</strong></h5>';
        }

        if ($sessionlogged == 1) {
            if ($sessionclass == 1) {
                if ($row['DISPONIBILIDAD'] == 1) {
                    echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $id . '">Préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $id . '">Editar</a><a style="margin-left: 10px;color: red;" href="bp-admin/functions/delete.php?id=' . $id . '">Eliminar</a>';
                } else {
                    echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $id . '">Gestionar préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $id . '">Editar</a><a style="margin-left: 10px;color: red;" href="bp-admin/functions/delete.php?id=' . $id . '">Eliminar</a>';
                }
                
            } else {
                if ($row['DISPONIBILIDAD'] == 1) {
                    echo '<a style="margin-left: 10px;color: green;" href="bp-admin/acciones/solicitar.php?id=' . $id . '">Solicitar</a>';
                } else {
                    echo '<a style="margin-left: 10px;color: gray;" href="bp-admin/acciones/notify.php?id=' . $id . '">Avísame cuando esté disponible</a>';
                }
                echo '';
            }
        }
        echo '
            <p><em>' . $row["AUTOR"] . '</em></p>
            <p>Sinópsis </p>
            <p><em>' . $row["DESCRIPCION"] . '</em></p>
            </div>
            <div class="col-sm">
            <p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p>
            <p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</p></em>
            <p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></p>
            <p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</em></p>
            <p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p>'; ?>
        <a class="btn btn-info" href="/">
            < Volver</a> </div> </div> </div> <footer class="page-footer bg-primary">
                <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress
        </a>
    </div>
    </footer>
</body>

</html>

<?php };}


?>