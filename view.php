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
    <title><?php echo $row["TITULO"]; ?> < Biblioteca</title>
    <meta charset="utf-8">
    <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.html';?>

<body class="headerlogin">
            <div class="header">
                <h2 class="centered"><?php echo $row["TITULO"]; ?></h2>
            </div>
    <div class="">
        
    <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.html';?>
        <?php
            echo '
            <div class="viewer">
            <div class="col-sm">
            <h5><strong>' . $row["TITULO"] . '</strong></h5>
            <p><em>' . $row["AUTOR"] . '</em></p>
            <p>Sinópsis </p>
            <p><em>' . $row["DESCRIPCION"] . '</em></p>
            </div>
            <div class="col-sm">
            <p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p>
            <p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</p></em>
            <p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></p>
            <p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</em></p>
            <p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p>';?>
        <a class="btn btn-info" href="<?=$_SERVER["HTTP_REFERER"]?>">< Volver</a>
        </div></div></div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
</body>

</html>