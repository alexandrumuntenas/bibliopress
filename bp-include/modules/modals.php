<?php

if (isset($_POST['submit'])) {
    $nombre = $_POST["element_1"];
    $insert = "INSERT INTO `$bbddgrupos` (`NOMBRE`) VALUES ('$nombre')";
    $databaseconnection->query($insert);
    echo mysqli_error($databaseconnection);
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
                                        <form id="form_1388" class="appnitro" method="post" action="functions/addusuario.php">
                                            <ul>

                                                <li id="li_1">
                                                    <label class="description" for="element_1">Nombre </label>
                                                    <div>
                                                        <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                </li>
                                                <li id="li_2">
                                                    <label class="description" for="element_2">Apellido </label>
                                                    <div>
                                                        <input id="element_2" name="element_2" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                </li>
                                                <li id="li_2">
                                                    <label class="description" for="element_5">Correo Electrónico </label>
                                                    <div>
                                                        <input id="element_5" name="element_5" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                                    </div>
                                                </li>
                                                <li id="li_3">
                                                    <label class="description" for="element_3">Grupo </label>
                                                    <div>
                                                        <select class="form-control form-control-sm" id="element_3" name="element_3">
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
                                                    <label class="description" for="element_4">Tipo de usuario</label>
                                                    <div>
                                                        <select class="form-control form-control-sm" id="element_4" name="element_4" required>
                                                            <option value="0">Lector</option>
                                                            <option value="1" disabled>Bibliotecario</option>
                                                            <option value="1">Administrador</option>
                                                        </select>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Añadir" />
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
                            <form method="post" action="functions/promote.php">
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
                            <button class="btn btn-primary" type="submit">Promocionar</button>
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
                                            <label class="description" for="element_1">Nombre del grupo</label>
                                            <div>
                                                <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Añadir" />
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
