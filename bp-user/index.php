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
                </div> <?php } else { ?> <p>No tienes permiso para acceder a esta página</p><?php } ?>
        </section>
        <footer class="page-footer bg-primary">
            <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
            </div>
        </footer>
</body>

</html>