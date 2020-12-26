<html>

<?php require 'bp-include/head.php';
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
                <h2 class="bp-page-title">Catálogo</h2>
            </div>
        </header>
        <section class="bp-section">
            <form class="form-inline" action="" method="GET">
                Búsqueda de usuarios por grupo > &nbsp
                </br>
                <select class="form-control form-control-sm" name="organizacion" id="">
                    <option value="card">Predeterminada</option>
                    <option value="card">Vista de tarjetas</option>
                    <option value="table">Vista de tabla</option>
                </select>
                &nbsp Cantidad de resultados por página > &nbsp
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
            <?php if (isset($_GET['organizacion'])) {
                if (mysqli_real_escape_string($databaseconnection, $_REQUEST['organizacion']) == 'card') {
                    $org = "card" ?> <center>
                        <div class="row d-flex justify-content-center"><?php } else {
                                                                        $org = "table" ?> <div class="lectores">
                                <input class="inputbusqueda" type="text" id="titulolibro" onkeyup="filtrocatalogo()" placeholder="Busca por título del libro..." title="Escribe el título del libro">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tb-pres">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Disponibilidad</th>
                                                <th>Título</th>
                                                <th>Autor</th>
                                                <th>ISBN</th>
                                                <th>Editorial</th>
                                                <th>Año de Publicación</th>
                                                <th>Ejemplar</th>
                                                <th>Ubicación</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php }
                                                                } else {
                                                                    $org = "card" ?><center>
                                            <div class="row d-flex justify-content-center"> <?php } ?>
                                            <?php
                                            $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                                            $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddcatalogo`");
                                            $TotalRegistro  = ceil($TotalReg->num_rows / $qtyresultado);
                                            $consultavistas = "SELECT * FROM `$bbddcatalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $qtyresultado) . " , " . $qtyresultado;
                                            $consulta = $databaseconnection->query($consultavistas);
                                            while ($row = $consulta->fetch_row()) {
                                                $long = 250;
                                                $desc = substr($row[12], 0, $long) . '...';
                                            ?>
                                                <div class="modal fade" id="libro-<?php echo $row[10]; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info modal-lg">
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
                                                                <p><strong>Sipnósis</strong><br><?php echo $row[12]; ?></p>
                                                                <p><strong>ISBN</strong> <?php echo $row[8]; ?></p>
                                                                <p><strong>Ubicación</strong> <?php echo $row[7]; ?> </p>
                                                                <p><strong>Ejemplar</strong> <?php echo $row[2]; ?></p>
                                                                <p><strong>Año de Publicación</strong> <?php echo $row[0]; ?></p>
                                                                <p><strong>Editorial</strong> <?php echo $row[3]; ?></p>
                                                                <h6>Comentarios</h6>
                                                                <?php if ($sessionlogged == 1) { ?>
                                                                    Has iniciado sesión como <strong><?php echo $sessionus; ?></strong>
                                                                <?php } else { ?>
                                                                    Inicia sesión para comentar! <a href="" style="color:blue" data-toggle="modal" data-target="#loginmodal" data-backdrop="false"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                                                                <?php } ?>
                                                                <div class="comentarios row">
                                                                    <?php if ($sessionlogged == 1) { ?>

                                                                        <div class="comentario">
                                                                            <form style="width:100%" class="md-form" method="post" action="">
                                                                                <input name="idlibro" value="<?php echo $row[10]; ?>" hidden />
                                                                                <input name="idusuario" value="<?php echo $sessionus; ?>" hidden />
                                                                                <div class="md-form">
                                                                                    <textarea id="form10" name="comentario" class="md-textarea form-control" rows="3" required></textarea>
                                                                                    <label for="form10">Comentario</label>
                                                                                </div>
                                                                                <input type="submit" name="publishcomment" class="btn btn-sm btn-primary" value="Añadir Comentario" />
                                                                            </form>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <?php $comentariosql = "SELECT * FROM $bbddcomentarios WHERE `idlibro` LIKE '$row[10]' ORDER BY id DESC LIMIT 6";
                                                                    $comentariosconsulta = mysqli_query($databaseconnection, $comentariosql);
                                                                    while ($comentariofila = mysqli_fetch_row($comentariosconsulta)) {
                                                                        $profilesql = "SELECT * FROM $bbddusuarios WHERE `USUARIO` LIKE '$comentariofila[3]'";
                                                                        $profilequery = mysqli_query($databaseconnection, $profilesql);
                                                                        $profileimage = mysqli_fetch_row($profilequery);
                                                                    ?>
                                                                        <div class="comentario">
                                                                            <img class="float-left" style="margin-right:10px; width: 50px;  height: 50px; " src="<?php echo $profileimage[8]; ?>">
                                                                            <p>
                                                                                <strong><?php echo $profileimage[3]; ?> dice...</strong></p>
                                                                            </p>
                                                                            <p>
                                                                                <?php echo $comentariofila[4]; ?>
                                                                            </p>
                                                                            <p>
                                                                                <?php if ($profileimage[1] == $sessionus) { ?> <form class="float-right" action="" method="post"><input name="delidlibro" type="text" value="<?php echo $row[10]; ?>" hidden /> <input name="usuariodemandante" type="text" value="<?php echo $sessionus; ?>" hidden /><input name="idcomentario" type="text" value="<?php echo $comentariofila[0]; ?>" hidden /> <input type="submit" name="delcomment" value="Eliminar" /></form><?php } ?>
                                                                            </p>
                                                                        </div>
                                                                    <?php
                                                                    } ?>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer"> <?php if ($sessionlogged == 1) {
                                                                                            if ($sessionclass == 1) { ?>
                                                                        <a style="margin-left: 10px;color: green;" href="/?edit=gprestamo&id=<?php echo $row[10]; ?>">G.Préstamo</a><a style="margin-left: 10px;color: blue;" href="?edit=book&id=<?php echo $row[10]; ?>">Editar</a>
                                                                        <a style="margin-left: 10px;color: red;" href="?delbk=<?php echo $row[10]; ?>">Eliminar</a>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                                                    <?php }
                                                                                        } else { ?>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if (isset($_GET['organizacion'])) {
                                                    if (mysqli_real_escape_string($databaseconnection, $_REQUEST['organizacion']) == 'card') { ?> <div class="card mb-4 text-left">
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
                                                                                        } else if ($row[13] == 3) {
                                                                                            echo '<span class="badge badge-danger">📥</span>';
                                                                                        } else {
                                                                                            echo '<span class="badge badge-danger">✕</span>';
                                                                                        } ?> <?php echo $row[6]; ?> </h4>
                                                                <p class="card-text"><?php echo $desc; ?></p>
                                                            </div>
                                                            <div class="card-footer text-muted text-center mt-4">
                                                                <a type="button" style="color:grey;" data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">Ver más</a><?php if ($sessionlogged == 1) {
                                                                                                                                                                                        if ($sessionclass == 1) { ?>
                                                                        <a style="margin-left: 10px;color: green;" href="/?edit=gprestamo&id=<?php echo $row[10]; ?>">G.Préstamo</a><a style="margin-left: 10px;color: blue;" href="?edit=book&id=<?php echo $row[10]; ?>">Editar</a>
                                                                        <a style="margin-left: 10px;color: red;" href="?delbk=<?php echo $row[10]; ?>">Eliminar</a>
                                                                    <?php }
                                                                                                                                                                                    } else { ?>

                                                                <?php } ?>
                                                            </div>
                                                        </div><?php } else { ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if ($row[13] == 1) {
                                                                    echo '<span class="badge badge-success">✓</span>';
                                                                } else if ($row[13] == 2) {
                                                                    echo '<span class="badge badge-warning">😷</span>';
                                                                } else if ($row[13] == 3) {
                                                                    echo '<span class="badge badge-danger">📥</span>';
                                                                } else {
                                                                    echo '<span class="badge badge-danger">✕</span>';
                                                                } ?>

                                                            <td><?php echo $row[6]; ?></td>
                                                            <td><?php echo $row[1]; ?></td>
                                                            <td><?php echo $row[8]; ?></td>
                                                            <td><?php echo $row[3]; ?></td>
                                                            <td><?php echo $row[0]; ?></td>
                                                            <td><?php echo $row[2]; ?></td>
                                                            <td><?php echo $row[7]; ?></td>
                                                            <td><a type="button" style="color:grey;" data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">Ver más</a><?php if ($sessionlogged == 1) {
                                                                                                                                                                                        if ($sessionclass == 1) { ?>
                                                                        <a style="margin-left: 10px;color: green;" href="/?edit=gprestamo&id=<?php echo $row[10]; ?>">G.Préstamo</a><a style="margin-left: 10px;color: blue;" href="?edit=book&id=<?php echo $row[10]; ?>">Editar</a>
                                                                        <a style="margin-left: 10px;color: red;" href="?delbk=<?php echo $row[10]; ?>">Eliminar</a>
                                                                    <?php }
                                                                                                                                                                                    } else { ?>

                                                                <?php } ?></td>
                                                        <?php }
                                                        } else { ?>
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
                                                                                        } else if ($row[13] == 3) {
                                                                                            echo '<span class="badge badge-danger">📥</span>';
                                                                                        } else {
                                                                                            echo '<span class="badge badge-danger">✕</span>';
                                                                                        } ?> <?php echo $row[6]; ?> </h4>
                                                                <p class="card-text"><?php echo $desc; ?></p>
                                                            </div>
                                                            <div class="card-footer text-muted text-center mt-4">
                                                                <a type="button" style="color:grey;" data-toggle="modal" data-target="#libro-<?php echo $row[10]; ?>">Ver más</a><?php if ($sessionlogged == 1) {
                                                                                                                                                                                        if ($sessionclass == 1) { ?>
                                                                        <a style="margin-left: 10px;color: green;" href="/?edit=gprestamo&id=<?php echo $row[10]; ?>">G.Préstamo</a><a style="margin-left: 10px;color: blue;" href="?edit=book&id=<?php echo $row[10]; ?>">Editar</a>
                                                                        <a style="margin-left: 10px;color: red;" href="?delbk=<?php echo $row[10]; ?>">Eliminar</a>
                                                                    <?php }
                                                                                                                                                                                    } else { ?>

                                                                <?php } ?>
                                                            </div>
                                                        </div> <?php }
                                                        } ?>
                                                <?php if (isset($_GET['organizacion'])) {
                                                    if (mysqli_real_escape_string($databaseconnection, $_REQUEST['organizacion']) == 'card') { ?> </div>
                                        </center><?php } else { ?> </tbody>
                                    </table>
                                </div>
                            </div><?php }
                                                } else { ?>
                        </div>
                    </center> <?php } ?>
                <?php $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
                $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);
                echo "<ul class='pagination pg-blue'><li class=\"page-item\"><a class='page-link' href=\"?organizacion=$org&resultados=$qtyresultado&pag=" . $DecrementNum . "\">&laquo;</a></li>";
                $Desde = $compag - (ceil($qtyresultado / 2) - 1);
                $Hasta = $compag + (ceil($qtyresultado / 2) - 1);
                $Desde = ($Desde < 1) ? 1 : $Desde;
                $Hasta = ($Hasta < $qtyresultado) ? $qtyresultado : $Hasta;
                for ($i = $Desde; $i <= $Hasta; $i++) {
                    if ($i <= $TotalRegistro) {
                        if ($i == $compag) {
                            echo "<li class=\"page-item active\"><a class='page-link' href=\"?organizacion=$org&resultados=$qtyresultado&pag=" . $i . "\">" . $i . "</a></li>";
                        } else {
                            echo "<li class=\"page-item\"><a class='page-link' href=\"?organizacion=$org&resultados=$qtyresultado&pag=" . $i . "\">" . $i . "</a></li>";
                        }
                    }
                }
                echo "<li class=\"page-item\"><a class='page-link' href=\"?organizacion=$org&resultados=$qtyresultado&pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                ?>
        </section>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bookpress</a>
        </div>
    </footer>
</body>

</html>