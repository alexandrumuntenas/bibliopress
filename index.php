<?php
//Importación de datos
require 'bp-config.php';
$logger = $_COOKIE['loggedin'];
if ($logger == 0) {
    setcookie('loggedin', 0, time() + (3600), "/");
    setcookie('perm', 0, time() + (3600), "/");
}
?>
<html>
<title>
    <?php echo 'Biblioteca del ' . $sname; ?>
</title>
<?php require 'bp-include/head.php'; ?>

<body>

    <header>
        <div class="wrapper">
            <?php require 'bp-include/menu.php'; ?>

            <div class="bp-header">
                <h2 class="bp-page-title">Catálogo</h2>
            </div>
    </header>
    <section class="bp-section">
        <br>
        <br>
        <?php
        $result = mysqli_query($databaseconnection, "SELECT * FROM `bp_catalogo`");
        $qty = mysqli_num_rows($result);
        $qtya = $qty / $CantidadMostrar;
        $qtyp = round($qtya, 0, PHP_ROUND_HALF_UP);
        echo '<p class="badge badge-success">' . $qty . ' Registros</p>                 ';
        echo '<p class="badge badge-danger">' . $qtyp . ' Páginas totales</p>';
        if ($sessionlogged == 1) {
            if ($sessionclass == 1) {
                echo '
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group mr-2" role="group">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop">Añadir nuevo registro</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href=\'bp-admin/functions/abies.php\';" />Subir desde Abies</button>
                    </div>
                    <div class="btn-group mr-2" role="group">
                        <button type="button" class="btn btn-secondary" onclick="location.href=\'bp-admin/functions/imprimiretqlib.php\';">Imprimir etiquetas</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href=\'bp-admin/functions/imprimircat.php\';" />Imprimir catálogo</button>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2">
                        Búsqueda por Código de Barras
                    </button>
                </div>';
            }
        }
        echo '
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel">Añadir nuevo registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form_1388" class="appnitro" method="post" action="/bp-admin/functions/add.php">
                                <ul>

                                    <li id="li_1">
                                        <label class="description" for="element_1">Título del libro </label>
                                        <div>
                                            <input id="element_1" name="element_1" class="element text large" type="text" maxlength="255" value="" />
                                        </div>
                                    </li>
                                    <li id="li_2">
                                        <label class="description" for="element_2">Autor </label>
                                        <div>
                                            <input id="element_2" name="element_2" class="element text large" type="text" maxlength="255" value="" />
                                        </div>
                                    </li>
                                    <li id="li_3">
                                        <label class="description" for="element_3">ISBN </label>
                                        <div>
                                            <input id="element_3" name="element_3" class="element text large" type="text" maxlength="255" value="" />
                                        </div>
                                    </li>
                                    <li id="li_4">
                                        <label class="description" for="element_4">Editorial </label>
                                        <div>
                                            <input id="element_4" name="element_4" class="element text large" type="text" maxlength="255" value="" />
                                        </div>
                                    </li>
                                    <li id="li_5">
                                        <label class="description" for="element_5">Año de Publicación </label>
                                        <div>
                                            <input id="element_5" name="element_5" class="element text large" type="text" maxlength="255" value="" />
                                        </div>
                                    </li>
                                    <li id="li_6">
                                        <label class="description" for="element_6">Ejemplar </label>
                                        <div>
                                            <input id="element_6" name="element_6" class="element text large" type="text" maxlength="255" value="" />
                                        </div>
                                    </li>
                                    <li id="li_7">
                                        <label class="description" for="element_7">Ubicación </label>
                                        <div>
                                            <input id="element_7" name="element_7" class="element text large" type="text" maxlength="255" value="" />
                                        </div>
                                    </li>
                                    <li id="li_7">
                                        <label class="description" for="element_8">Descripción </label>
                                        <div>
                                            <input type="text" id="element_8" name="element_8" class="element text large" maxlength="512" value="" />
                                        </div>
                                    </li>
                                </ul>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Publicar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Escanear Código de Barras</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="scanner-container"></div>
                        <input type="button" id="btn" value="Activar Escáner o Detener Escáner" />

                        <script src="bp-include/quagga.js"></script>
';
        echo '   <script>
                            var _scannerIsRunning = false;

                            function startScanner() {
                                Quagga.init({
                                            inputStream: {
                                                name: "Live",
                                                type: "LiveStream",
                                                target: document.querySelector(\'#scanner-container\'),
                                                    constraints: {
                                                        width: 480,
                                                        height: 320,
                                                        facingMode: "environment"
                                                    },
                                                },
                                                decoder: {
                                                    readers: [
                                                        "code_128_reader",
                                                        "ean_reader",
                                                        "ean_8_reader",
                                                        "code_39_reader",
                                                        "code_39_vin_reader",
                                                        "codabar_reader",
                                                        "upc_reader",
                                                        "upc_e_reader",
                                                        "i2of5_reader"
                                                    ],
                                                    debug: {
                                                        showCanvas: true,
                                                        showPatches: true,
                                                        showFoundPatches: true,
                                                        showSkeleton: true,
                                                        showLabels: true,
                                                        showPatchLabels: true,
                                                        showRemainingPatchLabels: true,
                                                        boxFromPatches: {
                                                            showTransformed: true,
                                                            showTransformedBox: true,
                                                            showBB: true
                                                        }
                                                    }
                                                },

                                            },
                                            function(err) {
                                                if (err) {
                                                    console.log(err);
                                                    return
                                                }

                                                console.log("Initialization finished. Ready to start");
                                                Quagga.start();

                                                // Set flag to is running
                                                _scannerIsRunning = true;
                                            });

                                        Quagga.onProcessed(function(result) {
                                                var drawingCtx = Quagga.canvas.ctx.overlay,
                                                    drawingCanvas = Quagga.canvas.dom.overlay;

                                                if (result) {
                                                    if (result.boxes) {
                                                        drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                                                        result.boxes.filter(function(box) {
                                                            return box !== result.box;
                                                        }).forEach(function(box) {
                                                            Quagga.ImageDebug.drawPath(box, {
                                                                x: 0,
                                                                y: 1
                                                            }, drawingCtx, {
                                                                color: "green",
                                                                lineWidth: 2
                                                            });
                                                        });
                                                    }

                                                    if (result.box) {
                                                        Quagga.ImageDebug.drawPath(result.box, {
                                                            x: 0,
                                                            y: 1
                                                        }, drawingCtx, {
                                                            color: "#00F",
                                                            lineWidth: 2
                                                        });
                                                    }

                                                    if (result.codeResult && result.codeResult.code) {
                                                        Quagga.ImageDebug.drawPath(result.line, {
                                                                x: \'x\', y: \'y\' }, drawingCtx, { color: \'red\', lineWidth: 3 });
                                                            }
                                                        }
                                                    });


                                                Quagga.onDetected(function(result) {
                                                            console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
                                                            document.getElementById(\'escaner\').value=result.codeResult.code ; 
                                                                var audio = new Audio(\'bp-include/barcode.wav\');
                                                                    audio.play();
                                                                });
                                                        }



                                                        // Start/stop scanner
                                                        document.getElementById("btn").addEventListener("click", function() {
                                                            if (_scannerIsRunning) {
                                                                Quagga.stop();
                                                            } else {
                                                                startScanner();
                                                            }
                                                        }, false);
                        </script>

                        <br>
                        <br>
                        <form method="POST" action="view.php">
                            <input id="escaner" name="escaner" class="element text medium" type="text" maxlength="255" value="" />
                            <button type="submit" class="btn btn-primary">Ver</button>
                        </form>
                    </div>
                    <div class="modal-footer">

                        </form>
                    </div>
                </div>
            </div>
        </div> <div class="row">';
        if ($databaseconnection->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $databaseconnection->connect_errno . ") " . $databaseconnection->connect_error;
        } else {
            // Validado de la variable GET
            $compag         = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
            $TotalReg       = $databaseconnection->query("SELECT * FROM `bp_catalogo`");
            //Se divide la cantidad de registro de la BD con la cantidad a mostrar 
            $TotalRegistro  = ceil($TotalReg->num_rows / $CantidadMostrar);
            //Consulta SQL
            $consultavistas = "SELECT * FROM `bp_catalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
            $consulta = $databaseconnection->query($consultavistas);

            echo '';
            while ($row = $consulta->fetch_row()) {
                $long = 250;
                $desc = substr($row[12], 0, $long);
                echo '
                    <div class="modal fade" id="prestamo' . $row[10] . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5><strong>Realizar préstamo de ' . $row[6] . '</strong> (' . $row[1] . ')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">';
                        $query = "SELECT * FROM `bp_catalogo` WHERE `ID` = '" . $row[10] . "'";
                        $result = mysqli_query($databaseconnection, $query);
                        $row = mysqli_fetch_assoc($result);
                        $loggedin = $_COOKIE["loggedin"];
                        $fecha_actual = date('m/d/Y');
                                require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
                                $status = "";
                                if (isset($_POST['new']) && $_POST['new'] == 1) {
                                } else {
                                    echo '<section class="bp-section flex-column"><div class="row">
                                    <div class="bp-card card-body">
                                    <h5><strong>' . $row["TITULO"] . '</strong>';
                                    echo '</h5>
                                    <p><em>' . $row["AUTOR"] . '</em></p>
                                    <p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p>
                                    <p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</p></em>
                                    <p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></p>
                                    <p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</em></p>
                                    <p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p></div>';
                                    if ($row['DISPONIBILIDAD'] == 1) {
                                        echo '
                                    <div class="bp-card card-body">
                                    <h5><strong>Prestar libro al usuario</strong></h5>
                                    <form id="form_1388" class="appnitro"  method="post" action="prestar.php?id=' . $id . '">				
                                                <ul>
                                                    
                                                <li id="li_1">
                                                <label class="description" for="element_1">Nombre </label>
                                                <div>
                                                    <input id="element_1" name="element_1" class="element text large" type="text" maxlength="255" value=""/> 
                                                </div> 
                                                </li>		<li id="li_2">
                                                <label class="description" for="element_2">Apellido </label>
                                                <div>
                                                    <input id="element_2" name="element_2" class="element text large" type="text" maxlength="255" value=""/> 
                                                </div> 
                                                </li>
                                                <li id="li_3">
                                                <label class="description" for="element_3">Fecha de devolución </label>
                                                <div>';
                                        echo date("d-m-Y", strtotime($fecha_actual . "+ 15 days"));
                                        echo '
                                                </div> 
                                                </li>
                                                </ul>
                                                <div class="modal-footer">
                                                    <input id="saveForm" class="btn btn-success" type="submit" name="submit" value="Prestar" />
                                                </div>
                                                </form>	
                                    </div></section>';
                                    } else {
                                        $fnamechecksql = "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` = '" . $row['PRESTADOA'] . "'";
                                        $fnamedata = mysqli_query($databaseconnection, $fnamechecksql);
                                        $fnamecheck = mysqli_fetch_assoc($fnamedata);
                                        echo '<div class="bp-card card-body">
                                        <h5><strong>Gestionar Préstamo Activo</strong></h5>
                                        <table>
                                        <tbody>
                                        <tr>
                                        <th>
                                        Usuario
                                        </th>
                                        <td>
                                        '.$fnamecheck['FULLNAME'].'
                                        </td>
                                        </tr>
                                        <tr>
                                        <th>
                                        Fecha de Devolución
                                        </th>
                                        <td>
                                        '.$row['FECHADEV'].'
                                        </td>
                                        </tr>
                                        </tbody>
                                        </table>
                                        <div class="modal-footer">
                                                    <a class="btn btn-primary" href="prorroga.php?id=' . $row["ID"] . '">Aplazar devolución</a>    <a class="btn btn-danger" style="margin-left: 10px;" href="devolver.php?id=' . $row["ID"] . '">Devolver</a>
                                                </div>
                                        </section>';
                                    }}
                        echo '
                        <div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- Modal Viewer -->
                    <div class="modal fade" id="libro' . $row[10] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5><strong>' . $row[6] . '</strong> (' . $row[1] . ')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <p><strong>Sinópsis </strong></p>
                          ' . $row[12] . '
                            <br>
                            <br>
                            <p><em>' . $row["AUTOR"] . '</em></p>
                            <p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p>
                            <p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</p></em>
                            <p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></p>
                            <p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</em></p>
                            <p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p>
                          </div>
                          <div class="modal-footer">
                          ';
                if ($sessionlogged == 1) {
                    if ($sessionclass == 1) {
                        if ($row['DISPONIBILIDAD'] == 1) {
                            echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $row[10] . '">Préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $row[10] . '">Editar</a><a style="margin-left: 10px;color: red;" href="bp-admin/functions/delete.php?id=' . $id . '">Eliminar</a>';
                        } else {
                            echo '<a style="margin-left: 10px;color: green;" href="bp-admin/functions/prestamo.php?id=' . $row[10] . '">Gestionar préstamo</a><a style="margin-left: 10px;color: blue;" href="bp-admin/functions/edit.php?id=' . $row[10] . '">Editar</a><a style="margin-left: 10px;color: red;" href="bp-admin/functions/delete.php?id=' . $id . '">Eliminar</a>';
                        }
                    } else {
                        if ($row['DISPONIBILIDAD'] == 1) {
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

                echo '<div class="bp-card card-body">
                    <h5><strong>' . $row['TITULO'] . '</strong>                    </h5>';
                echo '
                    <p><em>' . $row['AUTOR'] . '</em></p>
                    <p>' . $desc . '...</p>';
                if ($row['DISPONIBILIDAD'] == 1) {
                    echo '<p class="badge badge-success">Disponibilidad ✓</p><br>';
                } else {
                    echo '<p class="badge badge-danger">Disponibilidad ✗</p><br>';
                }
                if ($sessionlogged == 1) {
                    if ($sessionclass == 1) {
                        echo '<button type="button" class="btn btn-light" data-toggle="modal" data-target="#libro' . $row['ID'] . '">Ver más</button><button style="margin-left:10px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#prestamo' . $row['ID'] . '">Préstamo</button>';
                    } else {
                        echo '<a class="btn btn-light" href="view.php?id=' . $row['ID'] . '">Ver más</a>';
                    }
                } else {
                    echo '<button type="button" class="btn btn-light" data-toggle="modal" data-target="#libro' . $row['ID'] . '">
                        Ver más
                      </button>';
                }
                echo '</div>';
            };
        ?>
            </div>
            <footer class="page-footer" style="overflow-x:scroll;margin-top: 50px;">
            <?php
            $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
            $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);
            echo "<ul class='pagination'><li class=\"page-item\"><a class='page-link' href=\"?pag=" . $DecrementNum . "\">&laquo;</a></li>";
            $Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
            $Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);
            $Desde = ($Desde < 1) ? 1 : $Desde;
            $Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
            for ($i = $Desde; $i <= $Hasta; $i++) {
                if ($i <= $TotalRegistro) {
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
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>