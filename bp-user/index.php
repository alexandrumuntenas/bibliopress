<?php ?>
<html>
<title>
    <?php echo 'Biblioteca del ' . $sname; ?>
</title>
<?php
require '../bp-include/head.php';
$practivos = "SELECT * FROM `$bbddcatalogo` WHERE `PRESTADOA` = '" . $sessionus . "' AND `DISPONIBILIDAD` = 0 LIMIT 5";
$prquery = mysqli_query($databaseconnection, $practivos);
$prpte = "SELECT * FROM `$bbddcatalogo` WHERE `PRESTADOA` = '" . $sessionus . "' AND `DISPONIBILIDAD` = 3 LIMIT 5";
$prptequery = mysqli_query($databaseconnection, $prpte);
$querylector = "SELECT *  FROM `bp_usuarios` WHERE `USUARIO` LIKE '" . $sessionus . "'";
$qlectorre = mysqli_query($databaseconnection, $querylector);
$qlector = mysqli_fetch_assoc($qlectorre);
?>

<body>
    <div>
        <header>
            <div class="bp-header">
                <h2 class="bp-page-title">Mi Área Personal</h2>
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
                        <h5>Préstamos Activos</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <?php
                                    if ($prquery->num_rows > 0) {
                                        while ($practrow = $prquery->fetch_assoc()) {
                                            echo '<tr>
                                        <td>' . $practrow["TITULO"] . '</td>

                                    </tr>';
                                        }
                                    } else {
                                        echo "<tr><td>No tienes préstamos activos</td></tr>";
                                    }
                                    ?>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bp-card card-body">
                        <h5>Préstamos a devolver</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <?php
                                    if ($prptequery->num_rows > 0) {
                                        while ($prpterow = $prptequery->fetch_assoc()) {
                                            echo '<tr>
                                        <td>' . $prpterow["TITULO"] . '</td>

                                    </tr>';
                                        }
                                    } else {
                                        echo "<tr><td>No tienes préstamos pendiente de devolución</td></tr>";
                                    }
                                    ?>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bp-card card-body">
                        <h5>Tus Últimas Lecturas</h5>
                        <p>No te emociones, seguimos trabajando en ello</p>
                    </div>
                </div> <?php } else { ?> <p>No tienes permiso para acceder a esta página</p><?php } ?>
        </section>
        <footer class="page-footer bg-primary">
            <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
            </div>
        </footer>
</body>

</html>