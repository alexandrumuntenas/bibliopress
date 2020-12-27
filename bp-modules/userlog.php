<?php if (isset($_GET['pag'])) {
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
} ?>

<body>
    <div>
        <header>
            <div class="bp-header">
                <h2 class="bp-page-title"><?php if ($sessionlogged == 1) {
                                                if ($sessionclass == 1) { ?>
                            Registros
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
                if ($sessionclass == 1) { ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                                $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddlog` WHERE `USUARIO` LIKE '$sessionus'");
                                $TotalRegistro  = ceil($TotalReg->num_rows / $qtyresultado);
                                $consultavistas = "SELECT * FROM `$bbddlog` WHERE `USUARIO` LIKE '$sessionus'
                                    ORDER BY
                                    id DESC
                                    LIMIT " . (($compag - 1) * $qtyresultado) . " , " . $qtyresultado;
                                $consulta = $databaseconnection->query($consultavistas);
                                if ($consulta->num_rows > 0) {
                                    //datos de cada columna
                                    while ($gr = $consulta->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $gr['FECHA']; ?></td>
                                            <td><?php echo $gr['TTY']; ?></td>
                                            <td><?php echo $gr['IP']; ?></td>
                                        </tr>
                                <?php }
                                }; ?>
                            </tbody>
                        </table>
                        <?php
                        $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
                        $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);
                        echo "<ul class='pagination pg-blue'><li class=\"page-item\"><a class='page-link' href=\"?pag=" . $DecrementNum . "\">&laquo;</a></li>";
                        $Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
                        $Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);
                        $Desde = ($Desde < 1) ? 1 : $Desde;
                        $Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
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
                        ?>
                    <?php } else { ?>
                        <p>No tienes permiso para acceder a esta página</p>
                    <?php }
            } else { ?>
                    <p>No tienes permiso para acceder a esta página</p>
                <?php } ?>
                    </div>
        </section>
    </div>
</body>

</html>