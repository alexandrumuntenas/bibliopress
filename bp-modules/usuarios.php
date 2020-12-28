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
                    if ($gr == 'all') {
                        $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddusuarios`");
                        $TotalRegistro  = ceil($TotalReg->num_rows / $qtyresultado);
                        $consultavistas = "SELECT * FROM `$bbddusuarios`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $qtyresultado) . " , " . $qtyresultado;
                        $consulta = $databaseconnection->query($consultavistas);
                    } else if ($gr != NULL) {
                        $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddusuarios` WHERE `CLASE` LIKE '$gr'");
                        $TotalRegistro  = ceil($TotalReg->num_rows / $qtyresultado);
                        $consultavistas = "SELECT * FROM `$bbddusuarios` WHERE `CLASE` LIKE '$gr'
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $qtyresultado) . " , " . $qtyresultado;
                        $consulta = $databaseconnection->query($consultavistas);
                    } else {
                        $TotalReg       = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios`");
                        $TotalRegistro  = ceil($TotalReg->num_rows / $qtyresultado);
                        $consultavistas = "SELECT * FROM `$bbddusuarios`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $qtyresultado) . " , " . $qtyresultado;
                        $consulta = mysqli_query($databaseconnection, $consultavistas);
                    }
                } else {
                    $TotalReg       = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios`");
                    $TotalRegistro  = ceil($TotalReg->num_rows / $qtyresultado);
                    $consultavistas = "SELECT * FROM `$bbddusuarios`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $qtyresultado) . " , " . $qtyresultado;
                    $consulta = mysqli_query($databaseconnection, $consultavistas);
                }

        ?>
                <form class="form-inline" action="" method="GET">
                    <input name="r" value="<?php echo $requestedpage; ?>" hidden />
                    Búsqueda de usuarios por grupo > &nbsp
                    </br>
                    <select class="form-control form-control-sm" name="grupo" id="">
                        <option value="all" selected>Todos los grupos</option>
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
                    &nbsp Cantidad de resultados por página > &nbsp
                    <select class="form-control form-control-sm" name="resultados" onchange="filtropersonalizado(this)" id="">
                        <option value="9">Predeterminado</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                        <option value="Personalizado">Personalizado</option>
                    </select>

                    <div class="md-form" id="qtypersonalizada" style="display:none;">
                        &nbsp &nbsp &nbsp<input type="text" id="form1" name="qtypersonalizada" class="form-control">
                        <label for="form1">&nbsp &nbsp &nbsp Ver</label>
                    </div>
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
                                            <td data-label="Acciones disponibles"><a style="color:blue;" href="?r=' . $requestedpage . '&resultados='.$qtyresultado.'&pag=' . $pag . '&edit=usuario&id=' . $row["ID"] . '">Editar</a>       <form method="POST" action=""><input type="hidden" name="usuariodel" value="' . $row['USUARIO'] . '" /><input name="delus" type="submit" value="Eliminar"/></form></td>
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
</body>

</html>