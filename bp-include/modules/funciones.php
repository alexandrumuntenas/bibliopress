<?php
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        if (isset($_POST['publishgroup'])) {
            $nombre = mysqli_real_escape_string($databaseconnection, $_POST["nombregrupo"]);
            $insert = "INSERT INTO `$bbddgrupos` (`NOMBRE`) VALUES ('$nombre')";
            $databaseconnection->query($insert);
            echo mysqli_error($databaseconnection);
            echo '<div id="snackbar" class="show"> Se ha añadido el grupo correctamente</div>';
        }
        if (isset($_POST['publishbook'])) {
            $titulo = mysqli_real_escape_string($databaseconnection, $_POST["titulo"]);
            $autor = mysqli_real_escape_string($databaseconnection, $_POST["autor"]);
            $ISBN = mysqli_real_escape_string($databaseconnection, $_POST["ISBN"]);
            $editorial = mysqli_real_escape_string($databaseconnection, $_POST["editorial"]);
            $fechacompleta = mysqli_real_escape_string($databaseconnection, $_POST["anopub"]);
            $anopub = substr($fechacompleta, 0, 4);

            $ejemplar = mysqli_real_escape_string($databaseconnection, $_POST["ejemplar"]);
            $ubicacion = mysqli_real_escape_string($databaseconnection, $_POST["ubicacion"]);
            $descripcion = mysqli_real_escape_string($databaseconnection, $_POST["descripcion"]);
            $portada = mysqli_real_escape_string($databaseconnection, $_POST["portada"]);
            if ($portada == null) {
                $insert = "INSERT INTO `$bbddcatalogo`(ANOPUB, AUTOR, EJEMPLAR, EDITORIAL,TITULO, UBICACION, ISBN, DESCRIPCION) VALUES ('$anopub','$autor','$ejemplar','$editorial','$titulo','$ubicacion','$ISBN','$descripcion')";
                $databaseconnection->query($insert);
            } else {
                $insert = "INSERT INTO `$bbddcatalogo`(ANOPUB, AUTOR, EJEMPLAR, EDITORIAL,TITULO, UBICACION, ISBN, DESCRIPCION, PORTADA) VALUES ('$anopub','$autor','$ejemplar','$editorial','$titulo','$ubicacion','$ISBN','$descripcion','$portada')";
                $databaseconnection->query($insert);
            }
            if (mysqli_error($databaseconnection)) {
                echo '<div id="snackbar" class="show"> La base de datos ha notificado el siguiente error:</br>' . mysqli_error($databaseconnection) . '</div>';
            } else {
                echo '<div id="snackbar" class="show"> Se ha añadido el libro correctamente</div>';
            }
        }

        if (isset($_POST['publishuser'])) {
            $nombre = mysqli_real_escape_string($databaseconnection, $_POST["nombreusuario"]);
            $apellido = mysqli_real_escape_string($databaseconnection, $_POST["apellidousuario"]);
            $curso = mysqli_real_escape_string($databaseconnection, $_POST["grupousuario"]);
            $permiso = mysqli_real_escape_string($databaseconnection, $_POST["permisousuario"]);
            $celectronico = mysqli_real_escape_string($databaseconnection, $_POST["correousuario"]);
            $random = rand();
            $PASSWD = password_hash($random, PASSWORD_BCRYPT);
            $FNAME = "$nombre $apellido";
            $avatar = "https://i2.wp.com/ui-avatars.com/api/" . $nombre . "/128?ssl=1";
            $insert = "INSERT INTO `$bbddusuarios` (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PASSWD`,`PERM`, `AVATAR`) VALUES ('$celectronico','$FNAME','$nombre','$apellido','$curso', '$PASSWD', '$permiso', '$avatar')";
            $databaseconnection->query($insert);
            $dominio = $_SERVER['HTTP_HOST'];
            mail("$celectronico",'Accede a tu nueva cuenta de la biblioteca del $sname',"¡Hola! El administrador ha creado una cuenta para ti, para que puedas acceder a la biblioteca del $sname desde cualquier parte del mundo! Podrás hacer un seguimiento de tus préstamos, ponerte una foto de perfil chula, decir tu opinión sobre un libro, solicitar libros... \n Para acceder a tu perfil de la biblioteca, solo tienes que entrar en <a href=\"$sitelink\">$sitelink</a> y luego darle a <em>Acceder</em>. \n\nDatos de Acceso\nUsuario: $celectronico\nContraseña: $random", "From: bibliopress@$dominio");
            echo '<div id="snackbar" class="show"> Se ha añadido el usuario correctamente</div>';
        }
        if (isset($_POST['promocioncurso'])) {
            $cursoinicial = mysqli_real_escape_string($databaseconnection, $_POST["inicial"]);
            $cursofinal =     mysqli_real_escape_string($databaseconnection, $_POST["final"]);
            $insert = "UPDATE `$bbddusuarios` SET `CLASE` = REPLACE(`CLASE`, '$cursoinicial', '$cursofinal') WHERE `CLASE` LIKE '$cursoinicial' COLLATE utf8mb4_bin";
            $databaseconnection->query($insert);
            echo '<div id="snackbar" class="show"> Se ha realizado la promoción de grupo correctamente</div>';
        }
        if (isset($_POST['abiesupload'])) {
            if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
            }
            ini_set("auto_detect_line_endings", true);
            $handle = fopen($_FILES['filename']['tmp_name'], "r");
            $fila = -5;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $fila++;
                if ($fila > 0) {
                    $data[0] = $databaseconnection->real_escape_string($data[0]);
                    $data[1] = $databaseconnection->real_escape_string($data[1]);
                    $data[3] = $databaseconnection->real_escape_string($data[3]);
                    $data[9] = $databaseconnection->real_escape_string($data[9]);
                    $data[18] = $databaseconnection->real_escape_string($data[18]);
                    $data[32] = $databaseconnection->real_escape_string($data[32]);
                    $data[43] = $databaseconnection->real_escape_string($data[43]);
                    $data[45] = $databaseconnection->real_escape_string($data[45]);
                    $data[47] = $databaseconnection->real_escape_string($data[47]);
                    $data[49] = $databaseconnection->real_escape_string($data[49]);
                    $import = "INSERT INTO `$bbddcatalogo` (ANOPUB,AUTOR,EJEMPLAR,EDITORIAL,CIUDAD, SIGNATURA,TIPOEJEMPLAR,TITULO,UBICACION,ISBN) values('$data[0]','$data[1]','$data[3]','$data[9]','$data[32]','$data[43]','$data[45]','$data[47]','$data[49]','$data[18]')";
                    $rs = mysqli_query($databaseconnection, $import);
                    echo mysqli_error($databaseconnection);
                }
            }
            fclose($handle);
            echo "<div id=\"snackbar\" class=\"show\"><i class=\"fas fa-upload\"></i> Se han procesado <b>$fila ejemplares</b>. Importación Finalizada</div>";
        }
        if (isset($_POST['delgr'])) {
            $GRUPO = mysqli_real_escape_string($databaseconnection, $_POST['grupodel']);
            $query = "DELETE FROM `$bbddgrupos` WHERE `ID` = '" . $GRUPO . "' ";
            $result = mysqli_query($databaseconnection, $query);
            echo '<div id="snackbar" class="show">Se ha eliminado el grupo correctamente</div>';
        }
        if (isset($_POST['delus'])) {
            $USUARIO = mysqli_real_escape_string($databaseconnection, $_POST['usuariodel']);
            #$devolucionlibros = "UPDATE FROM `$bbddcatalogo` WHERE ";
            $query = "DELETE FROM `$bbddusuarios` WHERE `USUARIO` = '" . $USUARIO . "' ";
            $result = mysqli_query($databaseconnection, $query);
            echo '<div id="snackbar" class="show">Se ha eliminado el usuario correctamente</div>';
        }
        if (isset($_GET['delbk'])) {
            $id = mysqli_real_escape_string($databaseconnection, $_REQUEST['delbk']);
            $query = "DELETE FROM `$bbddcatalogo` WHERE id='$id'";
            $result = mysqli_query($databaseconnection, $query);
            echo '<div id="snackbar" class="show">Se ha eliminado el libro correctamente</div>';
        }
        if (isset($_GET['edit'])) {
            if ($_REQUEST['edit'] == 'book') {
                $id = $_REQUEST['id'];
                $editsql = "SELECT *  FROM $bbddcatalogo WHERE ID = " . $id;
                $editquery = $databaseconnection->query($editsql);
                $editresult = mysqli_fetch_assoc($editquery);
?>
                <div class="modal fade" id="editor-<?php echo $id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addbook" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-success">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title heading lead" id="addbook"><i class="fas fa-pen" style="color:#FFF"></i> Editar Libro <em><?php echo $editresult['TITULO']; ?></em></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="md-form" action="" method="POST">
                                    <div class="md-form">
                                        <input type="text" name="titulo" id="form1" class="form-control" value="<?php echo $editresult['TITULO']; ?>" required>
                                        <label for="form1">Título del libro</label>
                                    </div>

                                    <div class="md-form">
                                        <input type="text" name="autor" id="form1" class="form-control" value="<?php echo $editresult['AUTOR']; ?>" required>
                                        <label for="form1">Autor</label>
                                    </div>

                                    <div class="md-form">
                                        <input type="text" name="isbn" id="form1" class="form-control" value="<?php echo $editresult['ISBN']; ?>" required>
                                        <label for="form1">ISBN</label>
                                    </div>

                                    <div class="md-form">
                                        <input type="text" name="editorial" id="form1" class="form-control" value="<?php echo $editresult['EDITORIAL']; ?>" required>
                                        <label for="form1">Editorial</label>
                                    </div>

                                    <div class="md-form">
                                        <input type="text" name="anopub" id="form1" class="form-control" value="<?php echo $editresult['ANOPUB']; ?>" required>
                                        <label for="form1">Año de Publicación</label>
                                    </div>

                                    <div class="md-form">
                                        <input type="text" name="ejemplar" id="form1" class="form-control" value="<?php echo $editresult['EJEMPLAR']; ?>" required>
                                        <label for="form1">Ejemplar</label>
                                    </div>

                                    <div class="md-form">
                                        <input type="text" name="ubicacion" id="form1" class="form-control" value="<?php echo $editresult['UBICACION']; ?>" required>
                                        <label for="form1">Ubicación</label>
                                    </div>
                                    <div class="md-form">
                                        <textarea id="form7" name="descripcion" class="md-textarea form-control" rows="3" required><?php echo $editresult['DESCRIPCION']; ?></textarea>
                                        <label for="form7">Descripción</label>
                                    </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-outline-success btn-rounded btn-block z-depth-0 my-4 waves-effect" name="editbook" type="submit">Actualizar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(window).on('load', function() {
                        $('#editor-<?php echo $id; ?>').modal('show');
                    });
                </script>
            <?php
            } else if ($_REQUEST['edit'] == 'usuario') {
                $userrequest = $_REQUEST['id'];
                $getoldsql = "SELECT *  FROM $bbddusuarios WHERE `ID` LIKE '$userrequest'";
                $getoldquery = mysqli_query($databaseconnection, $getoldsql);
                $getoldresult = mysqli_fetch_assoc($getoldquery); ?>
                <div class="modal fade" id="editor-usuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addbook" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-success">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title heading lead" id="addbook"><i class="fas fa-user-edit" style="color:#FFF;"></i> Editar lector "<em><?php echo $getoldresult['NOMBRE']; ?></em>"</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="md-form" action="" method="POST">
                                    <div class="md-form">
                                        <div class="md-form">
                                            <input type="text" name="nombre" id="form1" class="form-control" value="<?php echo $getoldresult['NOMBRE']; ?>" required>
                                            <label for="form1">Nombre</label>
                                        </div>

                                        <div class="md-form">
                                            <input type="text" name="apellidos" id="form1" class="form-control" value="<?php echo $getoldresult['APELLIDOS']; ?>" required>
                                            <label for="form1">Apellidos</label>
                                        </div>

                                        <div class="md-form">
                                            <input type="text" name="celectronico" id="form1" class="form-control" value="<?php echo $getoldresult['USUARIO']; ?>" required>
                                            <label for="form1">Correo Electrónico</label>
                                        </div>
                                        <select selected="<?php echo $getoldresult['USUARIO']; ?>" class="form-control form-control-sm" id="grupo" name="grupo">
                                            <option value="No asignado"> No Asignado</option>';
                                            <?php
                                            while ($grupos = $grupoquery->fetch_assoc()) {
                                                echo '<option value="' . $grupos['NOMBRE'] . '">' . $grupos['NOMBRE'] . '</option>';
                                            } ?>
                                        </select>
                                        <img style="margin-right:10px;  vertical-align: middle;  width: 55px;  height: 55px;  border-radius: 50%;" src="<?php echo $getoldresult['AVATAR']; ?>"> </a>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" name="edituser" type="submit">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(window).on('load', function() {
                        $('#editor-usuario').modal('show');
                    });
                </script>
            <?php
            } else if ($_REQUEST['edit'] == 'gprestamo') {
                $id = $_REQUEST['id'];
                $prestamosql = "SELECT * FROM `$bbddcatalogo` WHERE `ID` LIKE '" . $id . "'";
                $prestamoquery = mysqli_query($databaseconnection, $prestamosql);
                $prestamoresultado = mysqli_fetch_assoc($prestamoquery);
                $fecha_actual = date('m/d/Y'); ?>
                <div class="modal fade" id="prestar-<?php echo $id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="prestamo" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-success">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title heading lead" id="prestamo">
                                    <?php if ($prestamoresultado['DISPONIBILIDAD'] == 1) { ?>
                                        Realizar préstamo de <em><?php echo $prestamoresultado["TITULO"]; ?></em><?php } else { ?> Gestionar préstamo de <em><?php echo $prestamoresultado["TITULO"]; ?></em><?php } ?> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php if ($prestamoresultado['DISPONIBILIDAD'] == 1) { ?>
                                <form method="post" action="">

                                    <div class="modal-body">
                                        <div class="md-form">
                                            <label class="description" for="element_1">Id del usuario </label>
                                            <input id="element_1" name="prestar_uid" class="form-control mb-4" type="text" maxlength="255" value="" />
                                        </div>
                                        <div>
                                            <p>Fecha de devolución</p>
                                            <input class="form-control mb-4" value="<?php echo date("d-m-Y", strtotime($fecha_actual . "+ 15 days")); ?>" disabled />
                                        </div>
                                       </div>
                                    <input type="text" name="identificador" value="<?php echo $id; ?>" hidden/>
                                    <div class="modal-footer">
                                        <input id="saveForm" class="btn btn-success" type="submit" name="prestar" value="Prestar" />
                                    </div>
                                </form>
                            <?php } else if ($prestamoresultado['DISPONIBILIDAD'] == 2) { ?>
                                <div class="modal-body">
                                    <p>Libro no disponible para préstamo. Este libro se encuentra en confinamiento hasta <?php echo $prestamoresultado['FECHADEV']; ?></p>
                                </div>
                            <?php } else {
                                $fnamechecksql = "SELECT * FROM `$bbddusuarios` WHERE `USUARIO` = '" . $prestamoresultado['PRESTADOA'] . "'";
                                $fnamedata = mysqli_query($databaseconnection, $fnamechecksql);
                                $fnamecheck = mysqli_fetch_assoc($fnamedata);
                            ?>
                                <div class="modal-body">
                                    <div class="md-form">
                                        <label class="description" for="element_1">Usuario </label>
                                        <input id="element_1" name="prestar_nombre" class="form-control mb-4" type="text" maxlength="255" value="<?php echo $fnamecheck['FULLNAME']; ?>" readonly />
                                    </div>
                                    <div>
                                        <p>Fecha de devolución</p>
                                        <input class="form-control mb-4" value="<?php echo $prestamoresultado['FECHADEV'] ?>" disabled />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="/?prorroga=<?php echo $id ?>" class="btn btn-success">Prorroga</a>
                                    <a href="/?devolver=<?php echo $id ?>" class="btn btn-danger">Devolver</a> </div> <?php } ?>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(window).on('load', function() {
                        $('#prestar-<?php echo $id; ?>').modal('show');
                    });
                </script>
            <?php
            }
        }

        if (isset($_POST['editbook'])) {
            $id = $_REQUEST['id'];
            $ANOPUB = mysqli_real_escape_string($databaseconnection, $_POST["anopub"]);
            $AUTOR = mysqli_real_escape_string($databaseconnection, $_POST["autor"]);
            $EJEMPLAR = mysqli_real_escape_string($databaseconnection, $_POST["ejemplar"]);
            $EDITORIAL = mysqli_real_escape_string($databaseconnection, $_POST["editorial"]);
            $TITULO = mysqli_real_escape_string($databaseconnection, $_POST["titulo"]);
            $UBICACION = mysqli_real_escape_string($databaseconnection, $_POST["ubicacion"]);
            $ISBN = mysqli_real_escape_string($databaseconnection, $_POST["isbn"]);
            $DESCRIPCION = mysqli_real_escape_string($databaseconnection, $_POST["descripcion"]);

            $update = "UPDATE `$bbddcatalogo` set ANOPUB='" . $ANOPUB . "', AUTOR='" . $AUTOR . "', EJEMPLAR='" . $EJEMPLAR . "', EDITORIAL='" . $EDITORIAL . "', TITULO='" . $TITULO . "', UBICACION='" . $UBICACION . "', ISBN='" . $ISBN . "', DESCRIPCION='" . $DESCRIPCION . "' where id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            echo "<meta http-equiv='refresh' content='0;url=/' />";
        }

        if (isset($_POST['edituser'])) {
            $usuario = $_POST['celectronico'];
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $grupo = $_POST["grupo"];
            $newdatasql = "UPDATE `$bbddusuarios` set `USUARIO` = '" . $usuario . "', `NOMBRE`='" . $nombre . "', `APELLIDOS`='" . $apellidos . "', `CLASE`='" . $grupo . "' where `ID`='" . $userrequest . "'";
            mysqli_query($databaseconnection, $newdatasql);
            echo "<meta http-equiv='refresh' content='0;url=/bp-admin/usuarios.php' />";
        }

        if (isset($_GET['view'])) {
            $id = $_REQUEST['view'];
            $viewsql = "SELECT * FROM `$bbddcatalogo` WHERE `ID` = '" . $id . "'";
            $viewquery = mysqli_query($databaseconnection, $viewsql);
            $viewresult = mysqli_fetch_row($viewquery); ?>
            <div class="modal fade" id="view-<?php echo $id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title heading lead" id="staticBackdropLabel">
                                <?php echo $viewresult[6]; ?> de <em><?php echo $viewresult[1]; ?>
                                </em></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Sipnósis</strong><br><?php echo $viewresult[12]; ?></p>
                            <p><strong>ISBN</strong> <?php echo $viewresult[8]; ?></p>
                            <p><strong>Ubicación</strong> <?php echo $viewresult[7]; ?> </p>
                            <p><strong>Ejemplar</strong> <?php echo $viewresult[2]; ?></p>
                            <p><strong>Año de Publicación</strong> <?php echo $viewresult[0]; ?></p>
                            <p><strong>Editorial</strong> <?php echo $viewresult[3]; ?></p>
                            <center>
                                <h6>Comentarios</h6>
                                Has iniciado sesión como <strong><?php echo $sessionus; ?></strong>
                            </center>
                            <div class="comentarios row">
                                <div class="comentario">
                                    <form style="width:100%" class="md-form" method="post" action="">
                                        <input name="idlibro" value="<?php echo $viewresult[10]; ?>" hidden />
                                        <input name="idusuario" value="<?php echo $sessionus; ?>" hidden />
                                        <div class="md-form">
                                            <textarea id="form10" name="comentario" class="md-textarea form-control" rows="3" required><?php echo $editresult['DESCRIPCION']; ?></textarea>
                                            <label for="form10">Comentario</label>
                                        </div>
                                        <input type="submit" name="publishcomment" class="btn btn-sm btn-primary" value="Añadir Comentario" />
                                    </form>
                                </div>
                                <?php $comentariosql = "SELECT * FROM $bbddcomentarios WHERE `idlibro` LIKE '$viewresult[10]' LIMIT 6";
                                $comentariosconsulta = mysqli_query($databaseconnection, $comentariosql);
                                while ($comentariofila = mysqli_fetch_row($comentariosconsulta)) {
                                    $profilesql = "SELECT * FROM $bbddusuarios WHERE `USUARIO` LIKE '$comentariofila[3]'";
                                    $profilequery = mysqli_query($databaseconnection, $profilesql);
                                    $profileimage = mysqli_fetch_row($profilequery);
                                ?>
                                    <div class="comentario">
                                        <img class="float-left" style="margin-right:10px; width: 50px;  height: 50px; " src="<?php echo $profileimage[8]; ?>">
                                        <p>
                                            <?php echo $comentariofila[4]; ?>
                                        </p>
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </div>

                        <div class="modal-footer"><?php if ($sessionlogged == 1) {
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
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#view-<?php echo $id; ?>').modal('show');
                });
            </script>
        <?php
        }

        if (isset($_POST['prestar'])) {
            $id = $_POST['identificador'];
            $uid = $_REQUEST["prestar_uid"];
            $fnamechecksql = "SELECT * FROM `$bbddusuarios` WHERE `ID` LIKE '" . $uid . "'";
            $fnamedata = mysqli_query($databaseconnection, $fnamechecksql);
            $fnamecheck = mysqli_fetch_assoc($fnamedata);
            $usuariocompleto = $fnamecheck['USUARIO'];
            $query = "SELECT * FROM `$bbddcatalogo` WHERE `ID` = '" . $id . "'";
            $result = mysqli_query($databaseconnection, $query);
            $row = mysqli_fetch_assoc($result);
            $comprobadorsql = "SELECT * FROM `$bbddcatalogo` WHERE `PRESTADOA` = '" . $usuariocompleto . "'";
            $comprobadordata = mysqli_query($databaseconnection, $comprobadorsql);
            $cantidadprestada = mysqli_num_rows($comprobadordata);
            if ($cantidadprestada >= 5) {
                echo '<div id="snackbar" class="show"> Error! Parece que este usuario tiene más de 5 préstamos activos</div>';
            } else {
                if ($fnamecheck['ID'] == $uid) {
                    $sql = "UPDATE `$bbddcatalogo` SET `DISPONIBILIDAD` = '0', `PRESTADOA` = '" . $fnamecheck['USUARIO'] . "', `FECHADEV` = '" . $timestamp . "' WHERE `$bbddcatalogo`.`ID` = " . $id;
                    $databaseconnection->query($sql);
                }
                echo '<div id="snackbar" class="show"> Se ha realizado el préstamo correctamente</div>';
                echo "<meta http-equiv='refresh' content='0;url=/' />";
            }
        }

        if (isset($_GET['devolver'])) {
            $id = $_REQUEST['devolver'];
            $fechanueva = date("Y-m-d", strtotime($fecha_actual . "+ 15 days"));
            $update = "UPDATE `$bbddcatalogo` SET DISPONIBILIDAD='2', FECHADEV='$fechanueva', PRESTADOA=NULL WHERE id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            if (mysqli_error($databaseconnection)) {
                echo '<div id="snackbar" class="show"> La base de datos ha notificado el siguiente error:</br>' . mysqli_error($databaseconnection) . '</div>';
            } else {
                echo '<div id="snackbar" class="show"> Se ha realizado la devolución correctamente. Comienza el período de confinamiento</div>';
            }
        }

        if (isset($_GET['prorroga'])) {
            $id = $_REQUEST['prorroga'];
            $fechanueva = date("Y-m-d", strtotime($fecha_actual . "+ 15 days"));
            $update = "UPDATE `$bbddcatalogo` SET FECHADEV='$fechanueva' WHERE id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            if (mysqli_error($databaseconnection)) {
                echo '<div id="snackbar" class="show"> La base de datos ha notificado el siguiente error:</br>' . mysqli_error($databaseconnection) . '</div>';
            } else {
                echo '<div id="snackbar" class="show"> Se ha realizado la prórroga correctamente</div>';
            }
        } ?><div class="modal fade" id="addbook" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addbook" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title heading lead" id="addbook"><i style="color:#FFF;" class="fas fa-book-medical"></i> Añadir nuevo libro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_1388" class="modal-body md-form" method="post" action="">


                        <p>✨ Ahora puedes añadir libros más rápido! Solo escanea con el lector de código de barras el código de barras del libro que desees añadir. Utilizando la tecnología de Google y un poco de magia, completarás la información del libro en segundos. <mark>Ten en cuenta de que esta tecnología no es precisa al 100%, pero generalmente si dará buenos resultados.</mark></p>
                        <div id="gapisresult"></div>
                        <div class="md-form">
                            <input id="titulo" name="titulo" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="titulo">Título del libro</label>
                        </div>
                        <div class="md-form">
                            <input id="autor" name="autor" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="autor">Autor</label>
                        </div>
                        <div class="md-form">
                            <input id="ISBN" name="ISBN" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="ISBN">ISBN</label>
                            <a class="btn btn-info btn-sm" onclick="gbooks()">Completar con Google Books</a>
                        </div>
                        <div class="md-form">
                            <input id="editorial" name="editorial" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="editorial">Editorial</label>
                        </div>
                        <div class="md-form">
                            <input id="anopub" name="anopub" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="anopub">Año de Publicación</label>
                        </div>
                        <div class="md-form">
                            <input id="ejemplar" name="ejemplar" class="form-control form-control-sm" type="text" maxlength="8" value="" required />
                            <label for="ejemplar">Ejemplar</label>
                        </div>
                        <div class="md-form">
                            <input id="ubicacion" name="ubicacion" class="form-control form-control-sm" type="text" maxlength="12" value="" required />
                            <label for="ubicación">Ubicación</label>
                        </div>
                        <div class="md-form">
                            <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control" maxlength="512" value="" required></textarea>
                            <label for="descripcion">Descripción</label>
                        </div>
                        <div class="md-form">
                            <input id="portada" name="portada" type="text" value="" hidden />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger sm" data-dismiss="modal">Cancelar</button>
                            <input id="saveForm" class="btn btn-primary sm" type="submit" name="publishbook" value="Publicar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adduser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="adduser" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title heading lead" id="adduser"><i class="fas fa-user-plus" style="color: #FFF;"></i></a> Añadir nuevo usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_1388" class="appnitro" method="post" action="">
                            <div class="md-form">
                                <p>Nombre</p>
                                <input id="nombreusuario" name="nombreusuario" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            </div>
                            <div class="md-form">
                                <p>Apellidos</p>
                                <input id="apellidousuario" name="apellidousuario" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            </div>
                            <div class="md-form">
                                <p>Correo Electrónico</p>
                                <input id="correousuario" name="correousuario" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            </div>
                            <div class="md-form">
                                <p>Grupo</p>
                                <select class="form-control form-control-sm" id="grupousuario" name="grupousuario" required>
                                    <option value="No asignado">Selecciona el grupo</option>
                                    <?php mysqli_data_seek($grupoquery, 0);
                                    if ($grupoquery->num_rows > 0) {
                                        while ($grupos = $grupoquery->fetch_assoc()) {
                                            echo '<option value="' . $grupos['NOMBRE'] . '">' . $grupos['NOMBRE'] . '</option>';
                                        }
                                    }
                                    mysqli_data_seek($grupoquery, 0); ?>
                                </select>
                            </div>
                            <div class="md-form">
                                <p>Tipo de Usuario</p>
                                <select class="form-control form-control-sm" id="permisousuario" name="permisousuario" required>
                                    <option value="0">Lector</option>
                                    <option value="1" disabled>Bibliotecario</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <input id="saveForm" class="btn btn-primary" type="submit" name="publishuser" value="Añadir" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="promogrupo" tabindex="-1" aria-labelledby="promogrupo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title heading lead" id="promogrupo">Promocionar curso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <select class="form-control form-control-sm" id="inicial" name="inicial">
                                <option value="No asignado">Selecciona el grupo</option>
                                <?php
                                if ($grupoquery->num_rows > 0) {
                                    //datos de cada columna
                                    while ($row = mysqli_fetch_assoc($grupoquery)) {
                                        echo '<option value="' . $row['NOMBRE'] . '">' . $row['NOMBRE'] . '</option>';
                                    }
                                }
                                mysqli_data_seek($grupoquery, 0); ?>
                            </select>
                            <p>a</p>
                            <select class="form-control form-control-sm" id="final" name="final">
                                <option value="No asignado">Selecciona el grupo</option>
                                <?php while ($row = mysqli_fetch_assoc($grupoquery)) {
                                    echo '<option value="' . $row['NOMBRE'] . '">' . $row['NOMBRE'] . '</option>';
                                } ?>
                            </select>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="promocioncurso">Promocionar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addgroup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addgroup" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title heading lead" id="addgroup"><i class="fas fa-users" style="color:#FFF;"></i></a> Añadir nuevo grupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="md-form" method="post" action="">
                            <ul>

                                <li id="li_1">
                                    <label class="description" for="nombregrupo">Nombre del grupo</label>
                                    <input id="nombregrupo" name="nombregrupo" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                                </li>
                            </ul>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <input id="saveForm" class="btn btn-primary" type="submit" name="publishgroup" value="Añadir" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="subirabies" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="subirabies" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title heading lead" id="subirabies"><i class="fas fa-upload" style="color:#FFF"></i> Subir desde Abies</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" action="" method="post" accept=".txt">Nombre de archivo *.TXT a subir:<br /><br /><input size="50" type="file" name="filename">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <input id="saveForm" class="btn btn-primary" type="submit" name="abiesupload" value="Subir" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="subirusuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="subirusuarios" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title heading lead" id="subirusuarios"><i class="fas fa-upload" style="color:#FFF"></i> Subir usuarios desde CSV (No disponible)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" action="" method="post">Nombre de archivo *.CSV a subir:<br /><br /><input size="50" type="file" name="file">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <input id="saveForm" class="btn btn-primary" type="submit" name="userupload" value="Subir" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="subirgrupos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="subirgrupos" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title heading lead" id="subirgrupos"><i class="fas fa-upload" style="color:#FFF"></i> Subir grupos desde CSV (No disponible)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" action="" method="post">Nombre de archivo *.CSV a subir:<br /><br /><input size="50" type="file" name="file">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <input id="saveForm" class="btn btn-primary" type="submit" name="groupupload" value="Subir" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <?php
            }
            if (isset($_POST['publishcomment'])) {
                $comentario = mysqli_real_escape_string($databaseconnection, $_POST['comentario']);
                $idlibro = mysqli_real_escape_string($databaseconnection, $_POST['idlibro']);
                $idusuario = mysqli_real_escape_string($databaseconnection, $_POST['idusuario']);
                if ($idusuario == $sessionus) {
                    $publishcommentsql = "INSERT INTO `$bbddcomentarios` (`id`, `idlibro`, `idpadre`, `usuario`, `contenido`, `fecha`) VALUES (NULL, '$idlibro', '-1', '$idusuario', '$comentario', CURRENT_DATE)";
                    $publishcommentquery = mysqli_query($databaseconnection, $publishcommentsql);
                    if (mysqli_error($databaseconnection)) {
                        echo '<div id="snackbar" class="show"> La base de datos ha notificado el siguiente error:</br>' . mysqli_error($databaseconnection) . '</div>';
                        echo "<script type='text/javascript'>
                    $(window).on('load', function() {
                        $('#libro-$idlibro').modal('show');
                    });
                </script>";
                    } else {
                        echo '<div id="snackbar" class="show"> Se ha publicado correctamente tu comentario!</div>';
                        echo "<script type='text/javascript'>
                    $(window).on('load', function() {
                        $('#libro-$idlibro').modal('show');
                    });
                </script>";
                    }
                } else {
                    echo '<div id="snackbar" class="show"> Buen intento >:C</div>';
                    echo "<script type='text/javascript'>
                    $(window).on('load', function() {
                        $('#libro-$idlibro').modal('show');
                    });
                </script>";
                }
            }
            if (isset($_POST['delcomment'])) {
                $idcomentario = mysqli_real_escape_String($databaseconnection, $_POST['idcomentario']);
                $usuariodemandante = mysqli_real_escape_string($databaseconnection, $_POST['usuariodemandante']);
                $delidlibro = mysqli_real_escape_string($databaseconnection, $_POST['delidlibro']);
                if ($usuariodemandante == $sessionus) {
                    $delcommentsql = "DELETE FROM `$bbddcomentarios` WHERE `$bbddcomentarios`.`id` = $idcomentario";
                    $delcommentquery = mysqli_query($databaseconnection, $delcommentsql);
                    echo '<div id="snackbar" class="show"> Se ha eliminado el comentario correctamente</div>';
                    echo "<script type='text/javascript'>
                    $(window).on('load', function() {
                        $('#libro-$delidlibro').modal('show');
                    });
                </script>";
                } else {
                    echo '<div id="snackbar" class="show"> Buen intento >:C</div>';
                    echo "<script type='text/javascript'>
                    $(window).on('load', function() {
                        $('#libro-$delidlibro').modal('show');
                    });
                </script>";
                }
            }

            if (isset($_GET['logout'])) {
                if ($sessionlogged == 1) {
                    $phpsessid = mysqli_real_escape_string($databaseconnection, $_COOKIE['PHPSESSID']);
                    $logoutsql = "DELETE FROM `$bbddsesiones` WHERE `$bbddsesiones`.`PHPSESSID` = '$phpsessid'";
                    $logoutquery = $databaseconnection->query($logoutsql);
                    echo "<meta http-equiv='refresh' content='0;url=/' />";
                    session_destroy();
                    session_write_close();
                    setcookie(session_name(), '', 0, '/');
                    session_start();
                } else {
                    echo '<div id="snackbar" class="show"> Se ha producido un error</div>';
                };
            } ?>
    <div class="modal fade" id="solicitar" tabindex="-1" aria-labelledby="solicitar" aria-hidden="true" style="background-color: rgba(0,0,0,.30)">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title heading lead"><i class="fas fa-paper-plane" style="color:#FFF"></i> Solicitar libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="md-form" action="" method="POST">
                        <div class="md-form">
                            <input id="titulo" name="soltitulo" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="titulo">Título del libro</label>
                        </div>
                        <div class="md-form">
                            <input id="autor" name="solautor" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="autor">Autor</label>
                        </div>
                        <div class="md-form">
                            <input id="ISBN" name="solISBN" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="ISBN">ISBN</label>
                        </div>
                        <div class="md-form">
                            <input id="editorial" name="soleditorial" class="form-control form-control-sm" type="text" maxlength="255" value="" required />
                            <label for="editorial">Editorial</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input id="saveForm" class="btn btn-primary" type="submit" name="solicitar" value="solicitar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_POST['solicitar'])) {
        $titulo = mysqli_real_escape_string($databaseconnection, $_POST['soltitulo']);
        $autor = mysqli_real_escape_string($databaseconnection, $_POST['solautor']);
        $ISBN = mysqli_real_escape_string($databaseconnection, $_POST['solISBN']);
        $editorial = mysqli_real_escape_string($databaseconnection, $_POST['soleditorial']);
        $solicitarsql = "INSERT INTO `$bbddsolicitudes` (`ID`, `ISBN`, `TITULO`, `AUTOR`, `EDITORIAL`, `IDSOLICITANTE`) VALUES (NULL, '$ISBN', '$titulo', '$autor', '$editorial', '$usuariodata[0]')";
        $solicitarquery = mysqli_query($databaseconnection, $solicitarsql);
        if (mysqli_error($databaseconnection)) {
            echo '<div id="snackbar" class="show"> La base de datos ha notificado el siguiente error:</br>' . mysqli_error($databaseconnection) . '</div>';
        } else {
            echo '<div id="snackbar" class="show"> Se ha enviado la solicitud correctamente. Puedes realizar un seguimiento de este en tu área personal!</div>';
        }
    }

    if (isset($_GET['solicitar'])) {
        $identificador = mysqli_real_escape_string($databaseconnection,$_REQUEST['id']);
        if (mysqli_real_escape_string($databaseconnection, $_REQUEST['accion']) == 'aprobar') {
            $aprobarsql = "UPDATE `$bbddsolicitudes` SET `ESTADO` = '1' WHERE `ID` = $identificador";
            $aprobarquery = mysqli_query($databaseconnection,$aprobarsql);
            if (mysqli_error($databaseconnection)) {
                echo '<div id="snackbar" class="show"> La base de datos ha notificado el siguiente error:</br>' . mysqli_error($databaseconnection) . '</div>';
            } else {
                echo '<div id="snackbar" class="show"> Se ha aprobado la solicitud correctamente</div>';
            }
        } else if (mysqli_real_escape_string($databaseconnection, $_REQUEST['accion']) == 'rechazar') {
            $aprobarsql = "UPDATE `$bbddsolicitudes` SET `ESTADO` = '2' WHERE `ID` = $identificador";
            $aprobarquery = mysqli_query($databaseconnection, $aprobarsql);
            if (mysqli_error($databaseconnection)) {
                echo '<div id="snackbar" class="show"> La base de datos ha notificado el siguiente error:</br>' . mysqli_error($databaseconnection) . '</div>';
            } else {
                echo '<div id="snackbar" class="show"> Se ha rechazado la solicitud correctamente</div>';
            }
        }
    }
}
if ($sessionlogged == null) {
    if (isset($_POST['login'])) {
        $usuario = mysqli_real_escape_string($databaseconnection, $_POST["usuario"]);
        $contrasena = mysqli_real_escape_string($databaseconnection, $_POST["contrasena"]);
        $rmf = mysqli_real_escape_string($databaseconnection, $_POST['rmf']);
        if ($usuario != null) {
            $loginsql = "SELECT * FROM `$bbddusuarios` WHERE `usuario` LIKE '" . $usuario . "'";
            $loginquery = $databaseconnection->query($loginsql);
            $loginresultado = mysqli_fetch_assoc($loginquery);
            if (password_verify($contrasena, $loginresultado['PASSWD'])) {
                if($rmf == null){
                $iniciarsesionsql = "INSERT INTO `$bbddsesiones` (`PHPSESSID`, `IP`, `user_agent`, `USUARIO`, `LOGGEDIN`, `PERM`) VALUES ('$phpsessid', '$ip_address', '$uagent', '$usuario', '1', '" . $loginresultado['PERM'] . "');";
                $loginresult = $databaseconnection->query($iniciarsesionsql); } else {
                    $iniciarsesionsql = "INSERT INTO `$bbddsesiones` (`PHPSESSID`, `IP`, `user_agent`, `USUARIO`, `LOGGEDIN`, `PERM`, `REMEMBERMEFOREVER`) VALUES ('$phpsessid', '$ip_address', '$uagent', '$usuario', '1', '" . $loginresultado['PERM'] . "', '1');";
                    $loginresult = $databaseconnection->query($iniciarsesionsql); }
                if ($loginresult == true) {
                    echo "<meta http-equiv='refresh' content='0;url=/' />";
                } else {
                    echo '<div id="snackbar" class="show"> Se ha producido un error. La base de datos ha reportado '
                        . mysqli_error($databaseconnection) . '</div>';
                }
            } else {

                echo '<div id="snackbar" class="show"> Usuario o contraseña incorrecta</div>';
            }
        };
    } ?><div style="z-index:9999" class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title heading lead"><i class="fas fa-sign-in-alt" style="color:#FFF;"></i> Acceder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="md-form">
                            <label>Usuario</label>
                            <input type="email" class="form-control" required="required" name="usuario">
                        </div>
                        <div class="md-form">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" required="required" name="contrasena">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <label class="form-check-label"><input type="checkbox" value="1" name="rmf">Recuérdame para siempre</label>
                        <input type="submit" class="btn btn-primary" name="login" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div> <?php
        } ?>
<div class="modal fade" id="searchmodal" tabindex="-1" aria-labelledby="searchmodal" aria-hidden="true" style="background-color: rgba(0,0,0,.30)">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
        <div class="modal-content">
            <div class="modal-header">
                <input class="buscador-ajax" type="text" id="search" placeholder="Introduce el título del libro a buscar" />
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row"></div>
                <div class"row">
                    <div id="display"></div>
                </div>
            </div>
        </div>
    </div>
</div>