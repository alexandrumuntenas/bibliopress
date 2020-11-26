<?php require '../bp-config.php';
$querylector = "SELECT *  FROM `$bbddusuarios` WHERE `USUARIO` LIKE '" . $sessionus . "'";
$qlectorre = mysqli_query($databaseconnection, $querylector);
$qlector = mysqli_fetch_assoc($qlectorre);
?>
<html>
<title>
    <?php echo 'Biblioteca del ' . $sname; ?>
</title>
<?php require '../bp-include/head.php'; ?>

<body>
    <?php require '../bp-include/menu.php'; ?>
    <div>
        <header>
            <div class="bp-header">
                <h2 class="bp-page-title">Mi Perfil</h2>
            </div>
        </header>
        <section class="bp-section">
            <div>
                <center>
                    <div class="btn-group" role="group">
                        <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
                        <a href="miperfil.php" type="button" class="btn btn-secondary">Mi Perfil <i class="fas fa-id-card-alt"></i></a>
                        <a href="logout.php" type="button" class="btn btn-danger">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
                </center>
                <div class="row">
                    <div class="bp-card card-body">
                        <h5>Sobre Mí</h5>
                        <form id="form_1388" method="post" action="/bp-admin/functions/actualizar.php">
                            <ul>

                                <li id="li_1">
                                    <label class="description" for="element_1">Nombre </label>
                                    <div>
                                        <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value="<?php echo $qlector['NOMBRE']; ?>" readonly />
                                    </div>
                                </li>
                                <li id="li_2">
                                    <label class="description" for="element_2">Apellido </label>
                                    <div>
                                        <input id="element_2" name="element_2" class="form-control form-control-sm" type="text" maxlength="255" value="<?php echo $qlector['APELLIDOS']; ?>" readonly />
                                    </div>
                                </li>
                                <li id="li_2">
                                    <label class="description" for="element_5">Correo Electrónico </label>
                                    <div>
                                        <input id="element_5" name="element_5" class="form-control form-control-sm" type="email" maxlength="255" value="<?php echo $sessionus; ?>" />
                                    </div>
                                </li>
                            </ul>
                        </form>
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
            </div>
        </section>
    </div>
    </div>
</div>
</div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>