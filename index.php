<?php require 'bp-config.php';
?>
<html>
<title>
    <?php echo 'Biblioteca del ' . $sname; ?>
</title>
<?php require 'bp-include/head.php'; ?>

<body>
    <?php require 'bp-include/menu.php'; ?>
    <div>
        <header>
            <div class="bp-header">
                <h2 class="bp-page-title">Catálogo</h2>
            </div>
        </header>
        <section class="bp-section">
            <center>
                <div class="row d-flex justify-content-center">
                    <?php

                    if ($sessionlogged == 1) {
                        if ($sessionclass == 1) {
                            $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                            $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddcatalogo`");
                            $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                            $consultavistas = "SELECT * FROM `$bbddcatalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                            $consulta = $databaseconnection->query($consultavistas);
                            while ($row = $consulta->fetch_row()) {
                                $long = 250;
                                $desc = substr($row[12], 0, $long) . '...';
                    ?>
                                <div class="modal fade" id="libro-<?php echo $row[10]; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title heading lead" id="staticBackdropLabel">
                                                    <?php echo $row[6]; ?> de <em><?php echo $row[1]; ?>
                                                    </em></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?php echo $row[12]; ?></p>
                                                <p><strong>ISBN</strong> <?php echo $row[8]; ?></p>
                                                <p><strong>Ubicación</strong> <?php echo $row[7]; ?> </p>
                                                <p><strong>Ejemplar</strong> <?php echo $row[2]; ?></p>
                                                <p><strong>Año de Publicación</strong> <?php echo $row[0]; ?></p>
                                                <p><strong>Editorial</strong> <?php echo $row[3]; ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=<?php echo $row[10]; ?>">Gestionar préstamo</a><a style="margin-left: 10px;color: blue;" href="?edit=book&id=<?php echo $row[10]; ?>">Editar</a>
                                                <form method="POST" action=""><input type="hidden" name="librodel" value="<?php echo $row[10]; ?>" /><input name="delbk" type="submit" value="Eliminar" /></form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4 text-left">
                                    <div class="view overlay" style="height:175px; width:auto; ">
                                        <img class="card-img-top" stlye="object-fit: cover;" src="<?php echo $row[16]; ?>" alt="Card image cap">
                                        <a data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"> <?php if ($row[13] == 1) {
                                                                    echo '<span class="badge badge-success">✓</span>';
                                                                } else if ($row[13] == 2) {
                                                                    echo '<span class="badge badge-warning">😷</span>';
                                                                } else {
                                                                    echo '<span class="badge badge-danger">✕</span>';
                                                                } ?> <?php echo $row[6]; ?> </h4>
                                        <p class="card-text"><?php echo $desc; ?></p>
                                    </div>
                                    <div class="card-footer text-muted text-center mt-4">
                                        <a type="button" style="color:grey;" data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">Ver más</a><a style="margin-left:10px; color:green;" href="bp-admin/functions/prestamo.php?id=<?php echo $row[10]; ?>">Préstamo</a>
                                    </div>
                                </div>
                            <?php } ?>
                </div>
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
                                        echo "<li class=\"page-item active\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                    } else {
                                        echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                    }
                                }
                            }
                            echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                        } else {
                            $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                            $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddcatalogo`");
                            $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                            $consultavistas = "SELECT * FROM `$bbddcatalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                            $consulta = $databaseconnection->query($consultavistas);

                            echo '';
                            while ($row = $consulta->fetch_row()) {
                                $long = 250;
                                $desc = substr($row[12], 0, $long) . '...';
                ?>
                    <div class="modal fade" id="libro-<?php echo $row[10]; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title heading lead" id="staticBackdropLabel"><?php echo $row[6]; ?> de <em><?php echo $row[1]; ?></em></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo $row[12]; ?></p>
                                    <p><strong>ISBN</strong> <?php echo $row[8]; ?></p>
                                    <p><strong>Ubicación</strong> <?php echo $row[7]; ?> </p>
                                    <p><strong>Ejemplar</strong> <?php echo $row[2]; ?></p>
                                    <p><strong>Año de Publicación</strong> <?php echo $row[0]; ?></p>
                                    <p><strong>Editorial</strong> <?php echo $row[3]; ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 text-left">
                        <div class="view overlay" style="height:175px; width:auto; ">
                            <img class="card-img-top" stlye="object-fit: cover;" src="<?php echo $row[16]; ?>" alt="Card image cap">
                            <a data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"> <?php if ($row[13] == 1) {
                                                        echo '<span class="badge badge-success">✓</span>';
                                                    } else if ($row[13] == 2) {
                                                        echo '<span class="badge badge-warning">😷</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">✕</span>';
                                                    } ?> <?php echo $row[6]; ?> </h4>
                            <p class="card-text"><?php echo $desc; ?></p>
                        </div>
                        <div class="card-footer text-muted text-center mt-4">
                            <a type="button" style="color:grey;" data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">Ver más</a>
                        </div>
                    </div>
                <?php } ?>
    </div>
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
                                        echo "<li class=\"page-item active\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                    } else {
                                        echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                    }
                                }
                            }
                            echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                        }
                    } else {
                        $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                        $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddcatalogo`");
                        $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                        $consultavistas = "SELECT * FROM `$bbddcatalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                        $consulta = $databaseconnection->query($consultavistas);

                        echo '';
                        while ($row = $consulta->fetch_row()) {
                            $long = 250;
                            $desc = substr($row[12], 0, $long) . '...';
    ?>
    <div class="modal fade" id="libro-<?php echo $row[10]; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title heading lead" id="staticBackdropLabel"><?php echo $row[6]; ?> de <em><?php echo $row[1]; ?></em></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $row[12]; ?></p>
                    <p><strong>ISBN</strong> <?php echo $row[8]; ?></p>
                    <p><strong>Ubicación</strong> <?php echo $row[7]; ?> </p>
                    <p><strong>Ejemplar</strong> <?php echo $row[2]; ?></p>
                    <p><strong>Año de Publicación</strong> <?php echo $row[0]; ?></p>
                    <p><strong>Editorial</strong> <?php echo $row[3]; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4 text-left">
        <div class="view overlay" style="height:175px; width:auto; ">
            <img class="card-img-top" stlye="object-fit: cover;" src="<?php echo $row[16]; ?>" alt="Card image cap">
            <a data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <div class="card-body">
            <h4 class="card-title"> <?php if ($row[13] == 1) {
                                        echo '<span class="badge badge-success">✓</span>';
                                    } else if ($row[13] == 2) {
                                        echo '<span class="badge badge-warning">😷</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">✕</span>';
                                    } ?> <?php echo $row[6]; ?> </h4>
            <p class="card-text"><?php echo $desc; ?></p>
        </div>
        <div class="card-footer text-muted text-center mt-4">
            <a type="button" style="color:grey;" data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">Ver más</a>
        </div>
    </div>
<?php } ?>
</div>
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
                                    echo "<li class=\"page-item active\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                } else {
                                    echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                }
                            }
                        }
                        echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                    }

?>
</section>
</body>

</html>