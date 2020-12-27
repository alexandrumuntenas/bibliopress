<?php
$prestamosql = "SELECT * FROM $bbddcatalogo WHERE `DISPONIBILIDAD` LIKE 0 OR `DISPONIBILIDAD` LIKE 3";
$prestamoquery = mysqli_query($databaseconnection, $prestamosql);
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
    } else {
        $qtyresultado = mysqli_real_escape_string($databaseconnection, $_REQUEST['resultados']);
    }
} else {
    $qtyresultado = $CantidadMostrar;
}
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
            <form class="form-inline" action="" method="GET">
                <input name="r" value="<?php echo $requestedpage; ?>" hidden />
                Cantidad de resultados por página > &nbsp
                <select class="form-control form-control-sm" name="resultados" id="">
                    <option value="9">Predeterminado</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="250">250</option>
                    <option value="500">500</option>
                </select>
                <input name="pag" value="<?php echo $pir; ?>" hidden /><button class="btn btn-primary btn-sm" type="submit">Actualizar</button>
            </form>
            <?php if ($sessionlogged == 1) {
                if ($sessionclass == 1) {
                    $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                    $TotalReg       = $databaseconnection->query("SELECT * FROM $bbddcatalogo WHERE `DISPONIBILIDAD` LIKE 0 OR `DISPONIBILIDAD` LIKE 3");
                    $TotalRegistro  = ceil($TotalReg->num_rows / $qtyresultado);
                    $consultavistas = "SELECT * FROM `$bbddcatalogo` WHERE `DISPONIBILIDAD` LIKE 0 OR WHERE `DISPONIBILIDAD` LIKE 3 
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $qtyresultado) . " , " . $qtyresultado;
                    $consulta = $databaseconnection->query($consultavistas);
            ?>
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
                                <td data-label="Título del libro">' . $prestamorow["TITULO"] . '</td>
                                <td data-label="Fecha de devolución">' . $prestamorow["FECHADEV"] . '</td>
                                <td data-label="Título prestado al usuario ">' . $tomarnombrerow['FULLNAME'] . '</td>
                                <td data-label="Acciones disponibles"><a style="color:blue;" href="?r=' . $requestedpage . '&pag='.$pag.'&prorroga=' . $prestamorow["ID"] . '">Aplazar devolución</a>    <a style="color:green;" href="?r=' . $requestedpage . '&pag=' . $pag . '&devolver=' . $prestamorow["ID"] . '">Devolver</a></td>
                        </tr>';
                                        }
                                    } else { ?>
                                        <tr>
                                            <td>No hay préstamos activos</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
                    $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);
                    echo "<ul class='pagination pg-blue'><li class=\"page-item\"><a class='page-link' href=\"?r=$requestedpage&resultados=$qtyresultado&pag=" . $DecrementNum . "\">&laquo;</a></li>";
                    $Desde = $compag - (ceil($qtyresultado / 2) - 1);
                    $Hasta = $compag + (ceil($qtyresultado / 2) - 1);
                    $Desde = ($Desde < 1) ? 1 : $Desde;
                    $Hasta = ($Hasta < $qtyresultado) ? $qtyresultado : $Hasta;
                    for ($i = $Desde; $i <= $Hasta; $i++) {
                        if ($i <= $TotalRegistro) {
                            if ($i == $compag) {
                                echo "<li class=\"page-item active\"><a class='page-link' href=\"?r=$requestedpage&resultados=$qtyresultado&pag=" . $i . "\">" . $i . "</a></li>";
                            } else {
                                echo "<li class=\"page-item\"><a class='page-link' href=\"?r=$requestedpage&resultados=$qtyresultado&pag=" . $i . "\">" . $i . "</a></li>";
                            }
                        }
                    }
                    echo "<li class=\"page-item\"><a class='page-link' href=\"?r=$requestedpage&resultados=$qtyresultado&pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                } else { ?>
                    <p>No tienes permiso para acceder a esta página</p>
                <?php }
            } else { ?>
                <p>No tienes permiso para acceder a esta página</p>
            <?php } ?>
        </section>
    </div>

</body>

</html>