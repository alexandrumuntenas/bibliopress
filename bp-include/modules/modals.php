<?php

if (isset($_POST['publishgroup'])) {
    $nombre = mysqli_real_escape_string($databaseconnection, $_POST["nombregrupo"]);
    $insert = "INSERT INTO `$bbddgrupos` (`NOMBRE`) VALUES ('$nombre')";
    $databaseconnection->query($insert);
    echo mysqli_error($databaseconnection);
    echo '<div id="snackbar" class="show"><i class="fas fa-check"></i> Se ha añadido el grupo correctamente</div>';
}

elseif (isset($_POST['publishbook'])) {
    $titulo = mysqli_real_escape_string($databaseconnection, $_POST["titulo"]);
    $autor = mysqli_real_escape_string($databaseconnection, $_POST["autor"]);
    $ISBN = mysqli_real_escape_string($databaseconnection, $_POST["ISBN"]);
    $editorial = mysqli_real_escape_string($databaseconnection, $_POST["editorial"]);
    $anopub = mysqli_real_escape_string($databaseconnection, $_POST["anopub"]);
    $ejemplar = mysqli_real_escape_string($databaseconnection, $_POST["ejemplar"]);
    $ubicacion = mysqli_real_escape_string($databaseconnection, $_POST["ubicacion"]);
    $descripcion = mysqli_real_escape_string($databaseconnection, $_POST["descripcion"]);
    $insert = "INSERT INTO `$bbddcatalogo`(ANOPUB, AUTOR, EJEMPLAR, EDITORIAL,TITULO, UBICACION, ISBN, DESCRIPCION) VALUES ('$anopub','$autor','$ejemplar','$editorial','$titulo','$ubicacion','$ISBN','$descripcion')";
    $databaseconnection->query($insert);
    echo '<div id="snackbar" class="show"><i class="fas fa-check"></i> Se ha añadido el libro correctamente</div>';
} 

elseif (isset($_POST['publishuser'])) {
    $nombre = mysqli_real_escape_string($databaseconnection, $_POST["nombreusuario"]);
    $apellido = mysqli_real_escape_string($databaseconnection, $_POST["apellidousuario"]);
    $curso = mysqli_real_escape_string($databaseconnection, $_POST["grupousuario"]);
    $permiso = mysqli_real_escape_string($databaseconnection, $_POST["permisousuario"]);
    $celectronico = mysqli_real_escape_string($databaseconnection, $_POST["correousuario"]);
    $random = rand();
    $pin = password_hash($random, PASSWORD_BCRYPT);
    $FNAME = "$nombre $apellido";
    $insert = "INSERT INTO `$bbddusuarios` (`USUARIO`,`FULLNAME`,`NOMBRE`,`APELLIDOS`,`CLASE`, `PIN`,`PERM`) VALUES ('$celectronico','$FNAME','$nombre','$apellido','$curso', '$pin', '$permiso')";
    $databaseconnection->query($insert);
    #mail('bibliopress@localhost.com','Accede a tu nueva cuenta de la biblioteca del $sname',"¡Hola! El administrador ha creado una cuenta para ti, para que puedas acceder a la biblioteca del $sname desde la comodidad de tu casa. Podrás gestionar tus préstamos activos, hacer listas de lecturas, ponerte una foto de perfil chula... \n Para acceder a tu perfil de la biblioteca, solo tienes que entrar en <a href=\"$sitelink\">$sitelink</a> y luego darle a <em>Acceder</em>. \n\nDatos de Acceso\nUsuario: $celectronico\nContraseña: $random",'bibliopress@localhost.com');
    echo '<div id="snackbar" class="show"><i class="fas fa-check"></i> Se ha añadido el usuario correctamente</div>';
} 

elseif(isset($_POST['promocioncurso'])){
    $cursoinicial = mysqli_real_escape_string($databaseconnection, $_POST["inicial"]);
    $cursofinal =     mysqli_real_escape_string($databaseconnection, $_POST["final"]);
    $insert = "UPDATE `$bbddusuarios` SET `CLASE` = REPLACE(`CLASE`, '$cursoinicial', '$cursofinal') WHERE `CLASE` LIKE '$cursoinicial' COLLATE utf8mb4_bin";
    $databaseconnection->query($insert);
    echo '<div id="snackbar" class="show"><i class="fas fa-check"></i> Se ha realizado la promoción de grupo correctamente</div>';
}

echo '<div class="modal fade" id="addbook" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addbook" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="addbook"><i class="fas fa-book-medical"></i> Añadir nuevo libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <div class="modal-body">
                    <form id="form_1388" class="appnitro" method="post" action="">
                        <ul>

                            <li id="li_1">
                                <label class="description" for="titulo">Título del libro </label>
                                <div>
                                    <input id="titulo" name="titulo" class="element text large" type="text" maxlength="255" value="" />
                                </div>
                            </li>
                            <li id="li_2">
                                <label class="description" for="autor">Autor </label>
                                <div>
                                    <input id="autor" name="autor" class="element text large" type="text" maxlength="255" value="" />
                                </div>
                            </li>
                            <li id="li_3">
                                <label class="description" for="ISBN">ISBN </label>
                                <div>
                                    <input id="ISBN" name="ISBN" class="element text large" type="text" maxlength="255" value="" />
                                </div>
                            </li>
                            <li id="li_4">
                                <label class="description" for="editorial">Editorial </label>
                                <div>
                                    <input id="editorial" name="editorial" class="element text large" type="text" maxlength="255" value="" />
                                </div>
                            </li>
                            <li id="li_5">
                                <label class="description" for="anopub">Año de Publicación </label>
                                <div>
                                    <input id="anopub" name="anopub" class="element text large" type="text" maxlength="255" value="" />
                                </div>
                            </li>
                            <li id="li_6">
                                <label class="description" for="ejemplar">Ejemplar </label>
                                <div>
                                    <input id="ejemplar" name="ejemplar" class="element text large" type="text" maxlength="255" value="" />
                                </div>
                            </li>
                            <li id="li_7">
                                <label class="description" for="ubicacion">Ubicación </label>
                                <div>
                                    <input id="ubicacion" name="ubicacion" class="element text large" type="text" maxlength="255" value="" />
                                </div>
                            </li>
                            <li id="li_7">
                                <label class="description" for="descripcion">Descripción </label>
                                <div>
                                    <input type="text" id="descripcion" name="descripcion" class="element text large" maxlength="512" value="" />
                                </div>
                            </li>
                        </ul>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input id="saveForm" class="btn btn-primary" type="submit" name="publishbook" value="Publicar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>';

echo '<div class="modal fade" id="adduser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="adduser" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title" id="adduser"><i class="fas fa-user-plus"></i> Añadir nuevo usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form_1388" class="appnitro" method="post" action="">
                                            <ul>

                                                <li id="li_1">
                                                    <label class="description" for="nombreusuario">Nombre </label>
                                                    <div>
                                                        <input id="nombreusuario" name="nombreusuario" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                </li>
                                                <li id="li_2">
                                                    <label class="description" for="apellidousuario">Apellido </label>
                                                    <div>
                                                        <input id="apellidousuario" name="apellidousuario" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                </li>
                                                <li id="li_2">
                                                    <label class="description" for="correousuario">Correo Electrónico </label>
                                                    <div>
                                                        <input id="correousuario" name="correousuario" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                </li>
                                                <li id="li_3">
                                                    <label class="description" for="grupousuario">Grupo </label>
                                                    <div>
                                                        <select class="form-control form-control-sm" id="grupousuario" name="grupousuario">
                                                            <option value="No asignado">Selecciona el grupo</option>';

                                                            if ($gruposql->num_rows > 0) {
                                                                while ($grupos = $gruposql->fetch_assoc()) {
                                                                    echo '<option value="' . $grupos['NOMBRE'] . '">' . $grupos['NOMBRE'] . '</option>';
                                                                }
                                                            }
                                                            echo '
                                                        </select>
                                                    </div>
                                                </li>
                                                <li>
                                                    <label class="description" for="permisousuario">Tipo de usuario</label>
                                                    <div>
                                                        <select class="form-control form-control-sm" id="permisousuario" name="permisousuario" required>
                                                            <option value="0">Lector</option>
                                                            <option value="1" disabled>Bibliotecario</option>
                                                            <option value="1">Administrador</option>
                                                        </select>
                                                    </div>
                                                </li>
                                            </ul>
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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="promogrupo">Promocionar curso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <select class="form-control form-control-sm" id="inicial" name="inicial">
                                    <option value="No asignado">Selecciona el grupo</option>';
                                mysqli_data_seek($gruposql, 0);

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
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="addgroup">Añadir nuevo grupo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form_1388" class="appnitro" method="post" action="">
                                    <ul>

                                        <li id="li_1">
                                            <label class="description" for="nombregrupo">Nombre del grupo</label>
                                            <div>
                                                <input id="nombregrupo" name="nombregrupo" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                            </div>
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

echo '<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
    <div class="modal-dialog modal-login">
      <div class="modal-content">
        <form action="bp-user/logger.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Acceder</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Usuario</label>
              <input type="email" class="form-control" required="required" name="usuario">
            </div>
            <div class="form-group">
              <div class="clearfix">
                <label>Contraseña</label>
                <button disabled><small>¿Contraseña Olvidada? (Función en Desarrollo)</small></a>
              </div>

              <input type="password" class="form-control" required="required" name="contrasena">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <label class="form-check-label"><input type="checkbox" checked disabled> Remember me (Función en Desarrollo)</label>
            <input type="submit" class="btn btn-primary" value="Login">
          </div>
        </form>
      </div>
    </div>
  </div>';

echo '
  <div class="modal fade" id="searchmodal" tabindex="-1" aria-labelledby="searchmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
