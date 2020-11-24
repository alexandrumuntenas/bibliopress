<html>
<?php
require '../bp-config.php';
require '../bp-include/head.php';

if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err404">';
    }
} else {
    echo '<body class="err404">';
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '';
        echo '<header><div class="wrapper">';
        require '../bp-include/menu.php';
        echo '
                    <div class="bp-header">
                        <h2 class="bp-page-title">Gestionar Usuarios</h2>
                    </div>
                    </header>';
        echo '
                    <section class="bp-section">
                    </div>
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-user-plus"></i> Añadir nuevo usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form id="form_1388" class="appnitro"  method="post" action="functions/addusuario.php">				
                        <ul>
                            
                        <li id="li_1">
                        <label class="description" for="element_1">Nombre </label>
                        <div>
                            <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value=""/> 
                        </div> 
                        </li>		<li id="li_2">
                        <label class="description" for="element_2">Apellido </label>
                        <div>
                            <input id="element_2" name="element_2" class="form-control form-control-sm" type="text" maxlength="255" value=""/> 
                        </div> 
                        </li>		<li id="li_2">
                        <label class="description" for="element_5">Correo Electrónico </label>
                        <div>
                            <input id="element_5" name="element_5" class="form-control form-control-sm" type="text" maxlength="255" value=""/> 
                        </div> 
                        </li>
                        <li id="li_3">
                        <label class="description" for="element_3">Grupo </label>
                        <div>
                        <select class="form-control form-control-sm" id="element_3" name="element_3">
                            <option value="No asignado">Selecciona el grupo</option>';
                        if ($gruposql->num_rows > 0) {
                        while ($grupos = $gruposql->fetch_assoc()) {
                            echo '<option value="'.$grupos['NOMBRE']. '">' . $grupos['NOMBRE'] . '</option>';
                        }
                    } echo'
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
                    </div>
                    </div>';
        $resulta = mysqli_query($databaseconnection, "SELECT * FROM `$bbddusuarios`");
        $qty = mysqli_num_rows($resulta);
        echo '<p class="badge badge-success badge-pill">' . $qty . ' Registros</p>';
        echo '<div class="lectores">
        <button type="button" style="margin-bottom:10px;" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fas fa-user-plus"></i> Añadir nuevo registro
                    </button>
                    <table>
                        <thead>
                        <tr>
                            <th>Correo Electrónico</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Grupo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>';
        if ($lectorresultado->num_rows > 0) {
            //datos de cada columna
            while ($row = $lectorresultado->fetch_assoc()) {
                echo '<tr>
                            <td data-label="Usuario"><br>' . $row["USUARIO"] . '</td>
                            <td data-label="Nombre"><br>' . $row["NOMBRE"] . '</td>
                            <td data-label="Apellidos"><br>' . $row["APELLIDOS"] . '</td>
                            <td data-label="Grupo"><br>' . $row["CLASE"] . '</td>
                            <td data-label="Acciones disponibles"><br><a style="color:blue;"href="functions/editusuarios.php?USUARIO=' . $row["USUARIO"] . '">Editar</a>       <a style="color:red;" href="functions/delusuarios.php?USUARIO=' . $row["USUARIO"] . '">Eliminar</a></td>
                        </tr>';
            }
        }
        echo '
                        </tbody>
                     </table>
                     </div>
                </section>';
    } else {

        echo '<section class="error-container">
                    <span><span>4</span></span>
                    <span>0</span>
                    <span><span>4</span></span>
                  </section>
                  <center>
                    <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
                    <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
    }
} else {
    echo '<section class="error-container">
                <span><span>4</span></span>
                <span>0</span>
                <span><span>4</span></span>
              </section>
              <center>
              <h2 style="color:#FFF; margin-bottom:15px;">Parece que te has perdido</h2>
              <a class="btn btn-light" href="/">Llévame de vuelta</a></center>';
};
?>



<footer class="page-footer bg-primary">
    <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
    </div>
</footer>
</body>

</html>