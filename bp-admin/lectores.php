<?php
require '../bp-config.php';
?>
<html>
<?php require '../bp-include/head.html'; ?>
<?php
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<body>';
    } else {
        echo '<body class="err404">';
    }
} else {
    echo '<body class="err404">';
} ?>
<?php
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '';
        echo '<header><div class="wrapper">';
        require '../bp-include/menu.php';
        echo '
                    <div class="header">
                        <h2 class="centered">Gestionar Lectores</h2>
                    </div>
                    </header>';
        echo '
                    <section class="section">
                    <center>
                    <div class="btn-group" role="group">
                    <a href="index.php" type="button" class="btn btn-secondary">Inicio</a>
                    <div class="btn-group" role="groupF">
                        <a href="catalogo.php" class="btn btn-secondary">
                        Catálogo</a>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <button href="catalogo.php" class="dropdown-item">
                            Añadir nuevo registro</button>
                            <a href="functions/abies.php" class="dropdown-item">Subir desde Abies</a>
                        </div>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="lectores.php" id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Lectores</a>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop">
                            Añadir nuevo registro
                            </button></div>
                    </div>
                    </div>
                    </center>
                    <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel">Añadir nuevo lector</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form id="form_1388" class="appnitro"  method="post" action="functions/addlectores.php">				
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
                        <label class="description" for="element_3">Curso </label>
                        <div>
                            <input id="element_3" name="element_3" class="element text large" type="text" maxlength="255" value=""/> 
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
                    </div>';
        $resulta = mysqli_query($databaseconnection, "SELECT * FROM $bbddusuarios");
        $qty = mysqli_num_rows($resulta);
        echo '<p class="badge badge-success badge-pill">' . $qty . ' Registros</p>';
        echo '
                    <table>
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Clase</th>
                        </tr>
                        </thead>
                        <tbody>';
        if ($lectorresultado->num_rows > 0) {
            //datos de cada columna
            while ($row = $lectorresultado->fetch_assoc()) {
                echo '<tr>
                            <td>' . $row["USUARIO"] . '</td>
                            <td>' . $row["NOMBRE"] . '</td>
                            <td>' . $row["APELLIDOS"] . '</td>
                            <td>' . $row["CLASE"] . '</td>
                            <td><a href="functions/editlectores.php?USUARIO=' . $row["USUARIO"] . '">Editar</a>       <a style="color:red;" href="functions/dellectores.php?USUARIO=' . $row["USUARIO"] . '">Eliminar</a></td>
                        </tr>';
                echo '
                        </tbody>
                     </table>
                </section>';
            }
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