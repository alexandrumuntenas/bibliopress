<?php require '../bp-include/head.php';
$querylector = "SELECT *  FROM `$bbddusuarios` WHERE `USUARIO` LIKE '" . $sessionus . "'";
$qlectorre = mysqli_query($databaseconnection, $querylector);
$qlector = mysqli_fetch_assoc($qlectorre);

if (isset($_POST['submit'])) {
    $celectronicoold = mysqli_real_escape_string($databaseconnection, $_POST['element_5']);
    $celectronico = mysqli_real_escape_string($databaseconnection, $_POST['element_6']);
    $PASSWDantiguo = mysqli_real_escape_string($databaseconnection, $_POST['element_7']);
    $PASSWDsolicitante = mysqli_real_escape_string($databaseconnection, $_POST['element_8']);
    $PASSWDtohasher = password_hash($PASSWDsolicitante, PASSWORD_BCRYPT);

    if ($celectronico != null) {
        $sqlquerycchange = "UPDATE `$bbddusuarios` SET `USUARIO` = '$celectronico' WHERE `$databaseconnection`.`USUARIO` = '$celectronicoold'; ";
        $databaseconnection->query($sqlquerycchange);
    }

    if ($PASSWDtohasher == password_verify($PASSWDantiguo, $qlector['PASSWD'])) {
        $sqlqueryPASSWDchange = "UPDATE `$bbddusuarios` SET `PASSWD` = '$PASSWDtohasher' WHERE `$databaseconnection`.`USUARIO` = '$celectronicoold'; ";
        $databaseconnection->query($sqlqueryPASSWDchange);
    }
}

?>
<html>

<body>
    <header>
        <div class="bp-header">
            <h2 class="bp-page-title">Mi Perfil</h2>
        </div>
    </header>
    <section class="bp-section">
        <?php if ($sessionlogged == 1) { ?>
            <center>
                <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
                <a href="miperfil.php" type="button" class="btn btn-secondary">Mi Perfil <i class="fas fa-id-card-alt"></i></a>
                <a href="?logout" type="button" class="btn btn-danger">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
            </center>
            <div class="row">
                <div class="bp-card card-body">
                    <h5>Sobre Mí</h5>
                        <div class="md-form">
                            <label class="description" for="element_1">Nombre </label>
                            <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value="<?php echo $qlector['NOMBRE']; ?>" readonly />
                        </div>
                        <div class="md-form">
                            <label class="description" for="element_2">Apellido </label>
                            <input id="element_2" name="element_2" class="form-control form-control-sm" type="text" maxlength="255" value="<?php echo $qlector['APELLIDOS']; ?>" readonly />
                        </div>
                        <div class="md-form">
                            <label class="description" for="element_2">Identificador</label>
                            <input id="element_2" name="element_2" class="form-control form-control-sm" type="text" maxlength="255" value="<?php echo $qlector['ID']; ?>" readonly />
                        </div>
                </div>
                <div class="bp-card card-body">
                    <h5>Mi Avatar</h5>
                    <p>No te emociones, seguimos trabajando en ello</p>
                </div>
                <div class="bp-card card-body">
                    <h5>Notificaciones</h5>
                    <p>No te emociones, seguimos trabajando en ello</p>
                </div>
            </div>
    </section> <?php } else { ?> <p>No tienes permiso para acceder a esta página</p><?php } ?>
<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>