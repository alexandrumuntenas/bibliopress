<?php require '../bp-include/head.php';
$prestamosql = "SELECT * FROM $bbddcatalogo WHERE `DISPONIBILIDAD` LIKE 0";
$prestamoquery = mysqli_query($databaseconnection, $prestamosql);
?>

<body>
    <div>
        <header>
            <div class="bp-header">
                <h2 class="bp-page-title"><?php if ($sessionlogged == 1) {
                                                if ($sessionclass == 1) { ?>
                            Gestionar Préstamos
                        <?php } else { ?> 4 0 3 <?php }
                                            } else { ?> 4 0 3 <?php } ?></h2>
            </div>
        </header>
        <section class="bp-section">
            <div>
                <?php if ($sessionlogged == 1) {
                    if ($sessionclass == 1) { ?>
                        <input class="inputbusqueda" type="text" id="titulolibro" onkeyup="ttlibro()" placeholder="Busca por título del libro..." title="Escribe el título del libro">
                        <div class="lectores">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tb-pres">
                                    <div class="row"></div>
                                    <thead class="thead-dark">

                                        <tr>
                                            <th>Título del Libro</th>
                                            <th>Fecha de devolución</th>
                                            <th>Usuario</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($prestamoquery->num_rows > 0) {
                                            //datos de cada columna
                                            while ($prestamorow = $prestamoquery->fetch_assoc()) {
                                                $tomarnombresql = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` LIKE '" . $prestamorow["PRESTADOA"] . "'");
                                                $tomarnombrerow = $tomarnombresql->fetch_assoc();
                                                echo '<tr>
                                <td data-label="Título del libro"><br>' . $prestamorow["TITULO"] . '</td>
                                <td data-label="Fecha de devolución"><br>' . $prestamorow["FECHADEV"] . '</td>
                                <td data-label="Título prestado al usuario "><br>' . $tomarnombrerow['FULLNAME'] . '</td>
                                <td data-label="Acciones disponibles"><br><a style="color:blue;" href="functions/prorroga.php?id=' . $prestamorow["ID"] . '">Aplazar devolución</a>    <a style="color:green;" href="functions/devolver.php?id=' . $prestamorow["ID"] . '">Devolver</a></td>
                        </tr>';
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } else { ?>
                        <p>No tienes permiso para acceder a esta página</p>
                    <?php }
                } else { ?>
                    <p>No tienes permiso para acceder a esta página</p>
                <?php } ?>
            </div>
        </section>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>