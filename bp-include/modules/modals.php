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
            $insert = "INSERT INTO `$bbddusuarios` (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PASSWD`,`PERM`) VALUES ('$celectronico','$FNAME','$nombre','$apellido','$curso', '$PASSWD', '$permiso')";
            $databaseconnection->query($insert);
            #mail('bibliopress@localhost.com','Accede a tu nueva cuenta de la biblioteca del $sname',"¡Hola! El administrador ha creado una cuenta para ti, para que puedas acceder a la biblioteca del $sname desde la comodidad de tu casa. Podrás gestionar tus préstamos activos, hacer listas de lecturas, ponerte una foto de perfil chula... \n Para acceder a tu perfil de la biblioteca, solo tienes que entrar en <a href=\"$sitelink\">$sitelink</a> y luego darle a <em>Acceder</em>. \n\nDatos de Acceso\nUsuario: $celectronico\nContraseña: $random",'bibliopress@localhost.com');
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
        if (isset($_POST['delbk'])) {
            $id = mysqli_real_escape_string($databaseconnection, $_POST['librodel']);
            $query = "DELETE FROM `$bbddcatalogo` WHERE id='$id'";
            $result = mysqli_query($databaseconnection, $query);
            echo '<div id="snackbar" class="show">Se ha eliminado el libro correctamente</div>';
        }
        if (isset($_POST['userupload'])) {
            print_r($_FILES);
            if ($_FILES['file']['name']) {
                $filename = explode(".", S_FILES['file']['name']);
                if ($filename[1] == 'csv') {
                    $handle = fopen($_FILES['files']['tmp_name'], "r");
                    while ($data = fgetcsv($handle)) {
                        $iteml = mysqli_real_escape_string($databaseconnection, $data[0]);
                        $item2 = mysqli_real_escape_string($databaseconnection, $data[1]);
                        $item3 = mysqli_real_escape_string($databaseconnection, $data[2]);
                        $item4 = mysqli_real_escape_string($databaseconnection, $data[3]);
                        $item5 = mysqli_real_escape_string($databaseconnection, $data[4]);
                        $item6 = rand();
                        $item7 = mysqli_real_escape_string($databaseconnection, $data[6]);
                        $insert = "INSERT INTO `$bbddusuarios` (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PASSWD`,`PERM`) VALUES ('$iteml','$item2','$item3','$item4','$item5', '$item6', '$item7')";
                        $databaseconnection->query($insert);
                    }
                    fclose($handle);
                    echo '<div id="snackbar" class="show"> Se han importado los datos correctamente</div>';
                }
            }
        }

        echo '<div class="modal fade" id="addbook" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addbook" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title heading lead" id="addbook">Añadir nuevo libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <div class="modal-body">
                    <form id="form_1388" class="md-form" method="post" action="">
                    <p>✨ Ahora puedes añadir libros más rápido! Solo escanea con el lector de código de barras el código de barras del libro que desees añadir. Utilizando la tecnología de Google y un poco de magia, completarás la información del libro en segundos. <mark>Ten en cuenta de que esta tecnología no es precisa al 100%, pero generalmente si dará buenos resultados.</mark></p>
                                <div id="gapisresult"></div>
                                <div class="md-form">
                                    <input id="titulo" name="titulo" class="form-control form-control-sm" type="text" maxlength="255" value="" required/>
                                    <label for="form1">Título del libro</label>
                                </div>
                                <div class="md-form">
                                    <input id="autor" name="autor" class="form-control form-control-sm" type="text" maxlength="255" value="" required/>
                                    <label for="form1">Autor</label>
                                </div>
                                <div class="md-form">
                                        <input id="ISBN" name="ISBN" class="form-control form-control-sm" type="text" maxlength="255" value="" required/>
                                        <label for="form1">ISBN</label>
                                        <a class="btn btn-info btn-sm" onclick="gbooks()">Completar con Google Books</a>
                                </div>
                                <div class="md-form">
                                    <input id="editorial" name="editorial" class="form-control form-control-sm" type="text" maxlength="255" value="" required/>
                                    <label for="form1">Editorial</label>
                                </div>
                                <div class="md-form">
                                    <input id="anopub" name="anopub" class="form-control form-control-sm" type="text" maxlength="255" value="" required/>
                                    <label for="form1">Año de Publicación</label>
                                </div>
                                <div class="md-form">
                                    <input id="ejemplar" name="ejemplar" class="form-control form-control-sm" type="text" maxlength="8" value="" required/>
                                    <label for="form1">Ejemplar</label>
                                </div>
                                <div class="md-form">
                                    <input id="ubicacion" name="ubicacion" class="form-control form-control-sm" type="text" maxlength="12" value="" required/>
                                    <label for="form1">Ubicación</label>
                                </div>
                                <div class="md-form"> 
                                    <textarea type="text" id="descripcion" name="descripcion" class="md-textarea form-control" maxlength="512" value="" required></textarea>
                                    <label for="descripcion">Descripción</label>
                                </div>
                                <div class="md-form">
                                    <input id="portada" name="portada" type="text" value="" hidden/>
                                </div>
                            </li>
                        </ul></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger sm" data-dismiss="modal">Cancelar</button>
                            <input id="saveForm" class="btn btn-primary sm" type="submit" name="publishbook" value="Publicar" />
                        </div>
                    </form>
            </div>
        </div>
    </div>';

        echo '<div class="modal fade" id="adduser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="adduser" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title heading lead" id="adduser">Añadir nuevo usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form_1388" class="appnitro" method="post" action="">
                                                    <div class="md-form">
                                                    <p>Nombre</p>
                                                        <input id="nombreusuario" name="nombreusuario" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                    <div class="md-form">
                                                    <p>Apellidos</p>
                                                        <input id="apellidousuario" name="apellidousuario" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                    <div class="md-form">
                                                    <p>Correo Electrónico</p>
                                                        <input id="correousuario" name="correousuario" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                    <div class="md-form">
                                                    <p>Grupo</p>
                                                        <select class="form-control form-control-sm" id="grupousuario" name="grupousuario">
                                                            <option value="No asignado">Selecciona el grupo</option>';

        if ($gruposql->num_rows > 0) {
            while ($grupos = $gruposql->fetch_assoc()) {
                echo '<option value="' . $grupos['NOMBRE'] . '">' . $grupos['NOMBRE'] . '</option>';
            }
        }
        mysqli_data_seek($gruposql, 0);
        echo '
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
                        </div>';

        echo '
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
                                    <option value="No asignado">Selecciona el grupo</option>';

        if ($gruposql->num_rows > 0) {
            //datos de cada columna
            while ($row = $gruposql->fetch_assoc()) {
                echo '<option value="' . $row['NOMBRE'] . '">' . $row['NOMBRE'] . '</option>';
            }
        }
        mysqli_data_seek($gruposql, 0);
        echo
            '
                                </select>
                                <p>a</p>
                                <select class="form-control form-control-sm" id="final" name="final">
                                    <option value="No asignado">Selecciona el grupo</option>';
        if ($gruposql->num_rows > 0) {
            //datos de cada columna
            while ($row = $gruposql->fetch_assoc()) {
                echo '<option value="' . $row['NOMBRE'] . '">' . $row['NOMBRE'] . '</option>';
            }
        }
        echo '
                                </select>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" name="promocioncurso">Promocionar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>';

        echo '<div class="modal fade" id="addgroup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addgroup" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title heading lead" id="addgroup">Añadir nuevo grupo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="md-form" method="post" action="">
                                    <ul>

                                        <li id="li_1">
                                            <label class="description" for="nombregrupo">Nombre del grupo</label>
                                                <input id="nombregrupo" name="nombregrupo" class="form-control form-control-sm" type="text" maxlength="255" value="" />
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
                </div>';

        echo '<div class="modal fade" id="subirabies" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="subirabies" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title heading lead" id="subirabies">Subir desde Abies</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form enctype="multipart/form-data" action="" method="post" accept=".txt">Nombre de archivo *.TXT a subir:<br /><br /><input size="50" type="file" name="filename">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <input id="saveForm" class="btn btn-primary" type="submit" name="abiesupload" value="Subir"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';

        echo '<div class="modal fade" id="subirusuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="subirusuarios" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title heading lead" id="subirusuarios">Subir usuarios desde CSV (Working)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form enctype="multipart/form-data" action="" method="post">Nombre de archivo *.CSV a subir:<br /><br /><input size="50" type="file" name="file">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <input id="saveForm" class="btn btn-primary" type="submit" name="userupload" value="Subir"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';

        echo '<div class="modal fade" id="subirgrupos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="subirgrupos" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title heading lead" id="subirgrupos">Subir grupos desde CSV</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form enctype="multipart/form-data" action="" method="post">Nombre de archivo *.CSV a subir:<br /><br /><input size="50" type="file" name="file">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <input id="saveForm" class="btn btn-primary" type="submit" name="groupupload" value="Subir"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
    }
    if (isset($_POST['logout'])) {
        if ($sessionlogged == 1) {
            $phpsessid = session_id();
            $logoutsql = "DELETE FROM `$bbddsesiones` WHERE `$bbddsesiones`.`PHPSESSID` = '$phpsessid'";
            $logoutquery = $databaseconnection->query($logoutsql);
            echo mysqli_error($databaseconnection) . "<meta http-equiv='refresh' content='0;url=/' />";
            session_destroy();
            session_write_close();
            setcookie(session_name(), '', 0, '/');
            session_start();
        } else {
            echo '<div id="snackbar" class="show"> Se ha producido un error</div>';
        };
    }
}
if ($sessionlogged == null) {
    if (isset($_POST['login'])) {
        $usuario = mysqli_real_escape_string($databaseconnection, $_POST["usuario"]);
        $contrasena = mysqli_real_escape_string($databaseconnection, $_POST["contrasena"]);
        if ($usuario != null) {
            $loginsql = "SELECT * FROM `$bbddusuarios` WHERE `usuario` LIKE '" . $usuario . "'";
            $loginquery = $databaseconnection->query($loginsql);
            $loginresultado = mysqli_fetch_assoc($loginquery);
            if (password_verify($contrasena, $loginresultado['PASSWD'])) {
                $iniciarsesionsql = "INSERT INTO `$bbddsesiones` (`PHPSESSID`, `USUARIO`, `LOGGEDIN`, `PERM`) VALUES ('$phpsessid', '$usuario', '1', '" . $loginresultado['PERM'] . "');";
                $loginresult = $databaseconnection->query($iniciarsesionsql);
                if ($loginresult == true) {
                    echo "<meta http-equiv='refresh' content='0;url=/' />";
                } else {
                    echo '<div id="snackbar" class="show"> Se ha producido un error</div>';
                }
            } else {
                echo mysqli_error($databaseconnection);
                echo '<div id="snackbar" class="show"> Usuario o contraseña incorrecta</div>';
            }
        };
    }

    echo '<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-notify modal-info">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">
            <h5 class="modal-title heading lead">Acceder</h5>
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
            <label class="form-check-label"><input type="checkbox" checked disabled> Remember me (Función en Desarrollo)</label>
            <input type="submit" class="btn btn-primary" name="login" value="Login">
          </div>
        </form>
      </div>
    </div>
  </div>';
}

echo '
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
  </div>';
