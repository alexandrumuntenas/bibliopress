<?php require '../bp-include/head.php';
?>

<body>
    <header>
        <div class="bp-header">
            <h2 class="bp-page-title"><?php if ($sessionlogged == 1) {
                                            if ($sessionclass == 1) { ?>
                        Gestionar Usuarios
                    <?php } else { ?> 4 0 3 <?php }
                                        } else { ?> 4 0 3 <?php } ?></h2>
    </header>
    <section class="bp-section">
        <?php if ($sessionlogged == 1) {
            if ($sessionclass == 1) {
                $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                if (isset($_GET['grupo'])) {
                    $gr = $_GET['grupo'];
                    if ($gr != NULL) {
                        $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddusuarios` WHERE `CLASE` LIKE '$gr'");
                        $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                        $consultavistas = "SELECT * FROM `$bbddusuarios` WHERE `CLASE` LIKE '$gr'
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                        $consulta = $databaseconnection->query($consultavistas);
                    } else {
                        $TotalReg       = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios`");
                        $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                        $consultavistas = "SELECT * FROM `$bbddusuarios`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                        $consulta = mysqli_query($databaseconnection, $consultavistas);
                    }
                } else {
                    $TotalReg       = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios`");
                    $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                    $consultavistas = "SELECT * FROM `$bbddusuarios`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                    $consulta = mysqli_query($databaseconnection, $consultavistas);
                }

        ?>
                <form class="form-inline" action="" method="GET">
                    Búsqueda de usuarios por grupo > &nbsp
                    </br>
                    <select class="form-control form-control-sm" name="grupo" id="">
                        <option value="No asignado">No asignado</option>
                        <?php
                        mysqli_data_seek($grupoquery, 0);
                        if ($grupoquery->num_rows > 0) {
                            //datos de cada columna
                            while ($row = mysqli_fetch_assoc($grupoquery)) {
                                echo '<option value="' . $row['NOMBRE'] . '">' . $row['NOMBRE'] . '</option>';
                            }
                        } ?>
                    </select>
                    <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
                    <a href="/bp-admin/usuarios.php" class="btn btn-success btn-sm" type="submit">Limpiar Filtro</a>
                </form>
                <div class="lectores">
                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Correo Electrónico</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Grupo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($consulta->num_rows > 0) {
                                    //datos de cada columna
                                    while ($row = $consulta->fetch_assoc()) {
                                        echo '<tr>
                                            <td data-label="Usuario">' . $row["USUARIO"] . '</td>
                                            <td data-label="Nombre">' . $row["NOMBRE"] . '</td>
                                            <td data-label="Apellidos">' . $row["APELLIDOS"] . '</td>
                                            <td data-label="Grupo">' . $row["CLASE"] . '</td>
                                            <td data-label="Acciones disponibles"><a style="color:blue;" href="?edit=usuario&id=' . $row["ID"] . '">Editar</a>       <form method="POST" action=""><input type="hidden" name="usuariodel" value="' . $row['USUARIO'] . '" /><input name="delus" type="submit" value="Eliminar"/></form></td>
                                                </tr>';
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
                $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);
                echo "<ul class='pagination pg-blue'><li class=\"page-item\"><a class='page-link' href=\"?grupo=$gr&pag=" . $DecrementNum . "\">&laquo;</a></li>";
                $Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
                $Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);
                $Desde = ($Desde < 1) ? 1 : $Desde;
                $Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
                for ($i = $Desde; $i <= $Hasta; $i++) {
                    if ($i <= $TotalRegistro) {
                        if ($i == $compag) {
                            echo "<li class=\"page-item active\"><a class='page-link' href=\"?grupo=$gr&pag=" . $i . "\">" . $i . "</a></li>";
                        } else {
                            echo "<li class=\"page-item\"><a class='page-link' href=\"?grupo=$gr&pag=" . $i . "\">" . $i . "</a></li>";
                        }
                    }
                }
                echo "<li class=\"page-item\"><a class='page-link' href=\"?grupo=$gr&pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
            } else { ?>
                <p>No tienes permiso para acceder a esta página</p>
            <?php }
        } else { ?>
            <p>No tienes permiso para acceder a esta página</p>
        <?php } ?>
    </section>

    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>