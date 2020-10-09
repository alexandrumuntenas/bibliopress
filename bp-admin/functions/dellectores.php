<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
$USUARIO = $_REQUEST['USUARIO'];
$query = "DELETE FROM `$bbddusuarios` WHERE `$bbddusuarios`.`USUARIO` = \'$USUARIO";
$result = mysqli_query($databaseconnection, $query);
?>
<!DOCTYPE html>
<html>
<?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.html';?>
    <body class="headerlogin">
        <header>
            <div class="wrapper">
            <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';?>
        </header>
    <div class='loginsection'>
        <?php echo "<p class='btn btn-danger'>Se ha eliminado el usuario $USUARIO</p><br><br><a class='btn btn-link' href='/bp-admin/lectores.php'>Volver al panel</a>"; ?>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
</body>

</html>