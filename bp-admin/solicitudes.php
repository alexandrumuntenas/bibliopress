<?php require '../bp-include/head.php';
?>

<body>
    <div>
        <header>
            <div class="bp-header">
                <h2 class="bp-page-title"><?php if ($sessionlogged == 1) {
                                                if ($sessionclass == 1) { ?>
                            Gestionar Solicitudes
                        <?php } else { ?> 4 0 3 <?php }
                                            } else { ?> 4 0 3 <?php } ?></h2>
            </div>
        </header>
        <section class="bp-section">
            <div>
                <?php if ($sessionlogged == 1) {
                    if ($sessionclass == 1) {
                        if(isset($_GET['estado'])){
                            $status = mysqli_real_escape_string($databaseconnection, $_REQUEST['estado']);
                            $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                            $TotalReg       = $databaseconnection->query("SELECT * FROM $bbddsolicitudes WHERE `ESTADO` LIKE $status");
                            $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                            $consultavistas = "SELECT * FROM `$bbddsolicitudes` WHERE `ESTADO` LIKE $status
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                            $consulta = $databaseconnection->query($consultavistas);
                        } else {
                            $status = 0;
                            $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                            $TotalReg       = $databaseconnection->query("SELECT * FROM $bbddsolicitudes WHERE `ESTADO` LIKE $status");
                            $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                            $consultavistas = "SELECT * FROM `$bbddsolicitudes` WHERE `ESTADO` LIKE $status
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                            $consulta = $databaseconnection->query($consultavistas);
                        }
 ?>
                        <form class="form-inline" action="" method="GET">
                            Ver solicitudes &nbsp
                            </br>
                            <select class="form-control form-control-sm" name="estado" id="">
                                <option value="0">Pendientes</option>
                                <option value="1">Aprobadas</option>
                                <option value="2">Rechazadas</option>
                            </select>
                            <button class="btn btn-primary btn-sm" type="submit">Ver</button>
                        </form>
                        <div class="lectores">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tb-pres">
                                    <div class="row"></div>
                                    <thead class="thead-dark">

                                        <tr>
                                            <th>Título del Libro</th>
                                            <th>Autor</th>
                                            <th>Editorial</th>
                                            <th>ISBN</th>
                                            <th>Usuario Solicitante</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($consulta->num_rows > 0) {
                                            //datos de cada columna
                                            while ($solicitudrow = $consulta->fetch_assoc()) {
                                                $tomarnombresql = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios` WHERE `ID` LIKE '" . $solicitudrow["IDSOLICITANTE"] . "'");
                                                $tomarnombrerow = $tomarnombresql->fetch_assoc();
                                                echo '<tr>
                                <td><br>' . $solicitudrow["TITULO"] . '</td>
                                <td><br>' . $solicitudrow["AUTOR"] . '</td>
                                <td><br>' . $solicitudrow['EDITORIAL'] . '</td>
                                <td><br>' . $solicitudrow['ISBN'] . '</td>
                                <td><br>' . $tomarnombrerow['FULLNAME'] . '</td>
                                '; if($status == 0) {echo '<td><br><a style="color:green;" href="?estado='.$status.'&solicitar&accion=aprobar&id=' . $solicitudrow["ID"] . '">Aprobar</a>         <a style="color:red; margin-left:10px;" href="?estado=' . $status . '&solicitar&accion=rechazar&id=' . $solicitudrow["ID"] . '">Rechazar</a></td>';}
                        echo '</tr>';
                                            }
                                        } else { ?>
                                            <tr>
                                                <td>No hay solicitudes disponibles</td>
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
                        echo "<ul class='pagination pg-blue'><li class=\"page-item\"><a class='page-link' href=\"?estado=$status&pag=" . $DecrementNum . "\">&laquo;</a></li>";
                        $Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
                        $Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);
                        $Desde = ($Desde < 1) ? 1 : $Desde;
                        $Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
                        for ($i = $Desde; $i <= $Hasta; $i++) {
                            if ($i <= $TotalRegistro) {
                                if ($i == $compag) {
                                    echo "<li class=\"page-item active\"><a class='page-link' href=\"?estado=$status&pag=" . $i . "\">" . $i . "</a></li>";
                                } else {
                                    echo "<li class=\"page-item\"><a class='page-link' href=\"?estado=$status&pag=" . $i . "\">" . $i . "</a></li>";
                                }
                            }
                        }
                        echo "<li class=\"page-item\"><a class='page-link' href=\"?estado=$status&pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                    } else { ?>
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