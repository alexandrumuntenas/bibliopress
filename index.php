<?php
define("FS_ROOT", realpath(dirname(__FILE__)));

require FS_ROOT . '/bp-include/head.php';

$requestedpage = mysqli_real_escape_string($databaseconnection, $_REQUEST['r']);
$pag = mysqli_real_escape_string($databaseconnection, $_REQUEST['pag']);

if ($pag == null) {
    $pag = 1;
}

if (isset($_GET['pag'])) {
    if (mysqli_real_escape_string($databaseconnection, $_REQUEST['pag']) == null) {
        $pir = 1;
    } else {
        $pir = mysqli_real_escape_string($databaseconnection, $_REQUEST['pag']);
    }
} else {
    $pir = 1;
}

if (isset($_GET['resultados'])) {
    if (mysqli_real_escape_string($databaseconnection, $_REQUEST['resultados']) == null) {
        $qtyresultado = $CantidadMostrar;
    } else if (mysqli_real_escape_string($databaseconnection, $_REQUEST['resultados']) == 'Personalizado') {
        $qtyresultado = mysqli_real_escape_string($databaseconnection, $_REQUEST['qtypersonalizada']);
    } else {
        $qtyresultado = mysqli_real_escape_string($databaseconnection, $_REQUEST['resultados']);
    }
} else {
    $qtyresultado = $CantidadMostrar;
}

if (isset($_GET['r'])) {
    switch ($requestedpage) {
            #Distintas páginas para distintos módulos
        case 'site/home':
            require FS_ROOT . '/bp-modules/landing.php';
            break;
        case 'site/catalogo':
            require FS_ROOT . '/bp-modules/catalogo.php';
            break;
        case 'site/user':
            require FS_ROOT . '/bp-modules/miarea.php';
            break;
        case 'site/user/log':
            require FS_ROOT . '/bp-modules/userlog.php';
            break;
        case 'site/admin/log':
            require FS_ROOT . '/bp-modules/sitelog.php';
            break;
        case 'site/admin/catalogo':
            require FS_ROOT . '/bp-modules/catalogo.php';
            break;
        case 'site/admin/prestamos':
            require FS_ROOT . '/bp-modules/prestamos.php';
            break;
        case 'site/admin/solicitudes':
            require FS_ROOT . '/bp-modules/solicitudes.php';
            break;
        case 'site/admin/usuarios':
            require FS_ROOT . '/bp-modules/usuarios.php';
            break;
        case 'site/admin/grupos':
            require FS_ROOT . '/bp-modules/grupos.php';
            break;
        case 'site/admin/config':
            require FS_ROOT . '/bp-modules/configuracion.php';
            break;
        default:
            require FS_ROOT . '/bp-include/404.php';
    } ?>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
<?php
} else {
    echo "<meta http-equiv='refresh' content='0;url=./?r=site/home' />";
}
