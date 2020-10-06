<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];
$sdid = $_REQUEST['sdid'];
$query = "DELETE FROM `bp_estudiantes` WHERE `bp_estudiantes`.`SDID` = $sdid";
$result = mysqli_query($databaseconnection, $query);
?>
<!DOCTYPE html>
<html>
<?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.html';?>
    <body class="headerlogin">
        <header>
            <div class="wrapper">
            <?php require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.html';?>
        </header>
    <div class='loginsection'>
        <?php echo "<p class='btn btn-danger'>Se ha eliminado el estudiante $sdid</p><br><br><a class='btn btn-link' href='/bp-admin/lectores.php'>Volver al panel</a>"; ?>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
</body>

</html>