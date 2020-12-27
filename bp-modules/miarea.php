<?php
$practivos = "SELECT * FROM `$bbddcatalogo` WHERE `PRESTADOA` = '" . $sessionus . "' AND `DISPONIBILIDAD` = 0 LIMIT 5";
$prquery = mysqli_query($databaseconnection, $practivos);
$prpte = "SELECT * FROM `$bbddcatalogo` WHERE `PRESTADOA` = '" . $sessionus . "' AND `DISPONIBILIDAD` = 3 LIMIT 5";
$prptequery = mysqli_query($databaseconnection, $prpte);
$querylector = "SELECT *  FROM `$bbddusuarios` WHERE `USUARIO` LIKE '" . $sessionus . "'";
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
                    <div class="bp-card card-body" style="filter:blur(10px)">
                        <h5>Tus Últimas Lecturas</h5>
                        <p>No te emociones, seguimos trabajando en ello</p>
                    </div>
                    <div class="w-100"></div>
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
                        <h5>Cambiar contraseña</h5>
                        <form class="md-form" method="post" action="">
                            <div class="md-form">
                                <label class="description" for="element_2">Contaseña Actual</label>
                                <input id="element_2" name="antiguacontrasena" class="form-control form-control-sm" type="password" maxlength="255" />
                            </div>
                            <div class="md-form">
                                <label class="description" for="element_2">Contreseña Nueva</label>
                                <input id="element_2" name="contrasenanueva" class="form-control form-control-sm" type="password" maxlength="255" />
                            </div>
                            <div class="md-form">
                                <label class="description" for="element_2">Volver a escribir contraseña nueva</label>
                                <input id="element_2" name="contrasenanuevaverificado" class="form-control form-control-sm" type="password" maxlength="255" />
                            </div>
                            <input id="element_2" name="cmailusuario" class="form-control form-control-sm" type="text" maxlength="255" value="<?php echo $sessionus; ?>" hidden />
                            <input type="submit" class="btn btn-primary btn-sm" name="actualizarpwd" value="Actualizar Contraseña" />
                        </form>
                    </div>
                    <div class="bp-card card-body">
                        <h5>Mi avatar</h5>
                        <center>
                            <img style="margin-right:10px;  vertical-align: middle;  width: 128px;  height: 128px;  border-radius: 50%;" src="<?php echo $sesavatarresultado['AVATAR']; ?>">
                        </center>
                        </br>
                        <p>Seguimos trabajando para que puedas subir tu propia foto de perfil!</p>
                    </div>
                    <div class="bp-card card-body" style="filter:blur(10px)">
                        <h5>Notificaciones</h5>
                    </div>
                </div><?php } else { ?> <p>No tienes permiso para acceder a esta página</p><?php } ?>
        </section>
</body>

</html>