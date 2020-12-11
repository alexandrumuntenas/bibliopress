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
            <br>
            
            <br>
            <center>
                <div class="row d-flex justify-content-center">
                    <?php
                    if ($databaseconnection->connect_errno) {
                        echo "Fallo al conectar a MySQL: (" . $databaseconnection->connect_errno . ") " . $databaseconnection->connect_error;
                    } else {
                        // Validado de la variable GET
                        $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
                        $TotalReg       = $databaseconnection->query("SELECT * FROM `$bbddcatalogo`");
                        //Se divide la cantidad de registro de la BD con la cantidad a mostrar 
                        $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
                        //Consulta SQL
                        $consultavistas = "SELECT * FROM `$bbddcatalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
                        $consulta = $databaseconnection->query($consultavistas);

                        echo '';
                        while ($row = $consulta->fetch_row()) {
                            $long = 250;
                            $desc = substr($row[12], 0, $long);
                            echo '
                    
                    <!-- Modal -->
                    <div class="modal fade" id="libro' . $row[10] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable modal-notify modal-info">
                        <div class="modal-content text-justify">
                          <div class="modal-header">
                            <h5 class="heading lead"><strong>' . $row[6] . '</strong> (' . $row[1] . ')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <p><strong>Sinópsis </strong></p>
                          ' . $row[12] . '
                            <br>
                            <br>
                            <p><strong>ISBN</strong> <em>' . $row[8] . '</em></p>
                            <p><strong>Ubicación</strong> <em>' . $row[7] . '</p></em>
                            <p><strong>Ejemplar</strong> <em>' . $row[2] . ' </em></p>
                            <p><strong>Año de Publicación</strong> <em>' . $row[0] . '</em></p>
                            <p><strong>Editorial</strong> <em>' . $row[3] . '</em></p>
                          </div>
                          <div class="modal-footer">
                          ';
                            if ($sessionlogged == 1) {
                                if ($sessionclass == 1) {
                                    if ($row[13] == 1) {

                                        echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $row[10] . '">Préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $row[10] . '">Editar</a><form method="POST" action=""><input type="hidden" name="librodel" value="' . $row[10] . '" /><input name="delbk" type="submit" value="Eliminar"/></form>';
                                    } else {
                                        echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $row[10] . '">Gestionar préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $row[10] . '">Editar</a><form method="POST" action=""><input type="hidden" name="librodel" value="' . $row[10] . '" /><input name="delbk" type="submit" value="Eliminar"/></form>';
                                    }
                                } else {
                                    if ($row[13] == 1) {
                                        echo '<a style="margin-left: 10px;color: green;" href="bp-admin/acciones/solicitar.php?id=' . $row[10] . '">Solicitar</a>';
                                    } else {
                                        echo '<a style="margin-left: 10px;color: gray;" href="bp-admin/acciones/notify.php?id=' . $row[10] . '">Avísame cuando esté disponible</a>';
                                    }
                                    echo '';
                                }
                            }
                            echo '
                            
                          </div>
                        </div>
                      </div>
                    </div>';

                            echo '<div class="card text-left">

                        <!-- Card image -->
                        <div class="view overlay">
                          <img class="card-img-top" src="/bp-include/404.bg.jpg"
                            alt="Card image cap">
                          <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>
                      
                        <!-- Card content -->
                        <div class="card-body">
                      
                          <!-- Title -->
                          <h4 class="card-title">' . $row[6] . '</h4>
                          ';

                            echo '
                          <!-- Text -->
                          <p class="card-text">' . $desc . '...</p>
                          <!-- Button --> ';
                            if ($sessionlogged == 1) {
                                if ($sessionclass == 1) {
                                    echo '<a type="button" style="color:grey;" data-toggle="modal" data-target="#libro' . $row[10] . '">Ver más</a><a style="margin-left:10px; color:green;" href="bp-admin/functions/prestamo.php?id=' . $row[10] . '">Préstamo</a>';
                                } else {
                                    echo '<a class="btn btn-light" href="view.php?id=' . $row[10] . '">Ver más</a>';
                                }
                            } else {
                                echo '<button type="button" class="btn btn-light" data-toggle="modal" data-target="#libro' . $row[10] . '">
                        Ver más
                      </button>';
                            }
                            echo '</div></div>';
                        };
                    ?>
                </div>
                <footer class="page-footer" style="overflow-x:scroll;margin-top: 50px;">
                <?php
                        /*Sector de Paginacion */

                        //Operacion matematica para botón siguiente y atrás 
                        $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
                        $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);

                        echo "<ul class='pagination pg-blue'><li class=\"page-item\"><a class='page-link' href=\"?pag=" . $DecrementNum . "\">&laquo;</a></li>";
                        //Se resta y suma con el numero de pag actual con el cantidad de 
                        //números  a mostrar
                        $Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
                        $Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);

                        //Se valida
                        $Desde = ($Desde < 1) ? 1 : $Desde;
                        $Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
                        //Se muestra los números de paginas
                        for ($i = $Desde; $i <= $Hasta; $i++) {
                            //Se valida la paginacion total
                            //de registros
                            if ($i <= $TotalRegistro) {
                                //Validamos la pag activo
                                if ($i == $compag) {
                                    echo "<li class=\"page-item active\"><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                } else {
                                    echo "<li><a class='page-link' href=\"?pag=" . $i . "\">" . $i . "</a></li>";
                                }
                            }
                        }
                        echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=" . $IncrimentNum . "\">&raquo;</a></li></ul>";
                    }
                ?>
                </footer>
        </section>
    </div>
    </div>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>