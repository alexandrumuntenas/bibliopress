<?php
//Importación de datos
require '../bp-config.php';

?>
<html>
    <?php require '../bp-include/head.html';?>
    <body>
        <header>
            <div class="wrapper">
            <?php require '../bp-include/menu.html';?>

            <div class="header">
                <h2 class="centered">Dashboard</h2>
            </div>
        </header>
        <section class="section">
            <div>
                <h2 class="stitle">Registros</h2>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            Añadir nuevo registro
            </button>
            <a href="functions/abies.php" class="btn btn-secondary">Subir desde Abies</a>
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
            </div>
            <?php
            $resulta = mysqli_query($databaseconnection, "SELECT * FROM bp_estudiantes");
            $qty = mysqli_num_rows($resulta);
            echo '<p class="badge badge-success badge-pill">'. $qty . ' Registros</p>'
            ?>
            
            <table>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de Alta</th>
                    <th>Clase</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if ($lectorresultado->num_rows > 0) {
                    //datos de cada columna
                    while($row = $lectorresultado->fetch_assoc()) {
                    echo '<tr>
                    <td>' . $row["NOMBRE"] . '</td>
                    <td>' . $row["APELLIDOS"] . '</td>
                    <td>' . $row["FECHA_ALTA"] . '</td>
                    <td>' . $row["CLASE"] . '</td>
                    <td><a href="functions/editlectores.php?sdid=' . $row["SDID"] . '">Editar</a>       <a style="color:red;" href="functions/dellectores.php?sdid=' . $row["SDID"] . '">Eliminar</a></td>
                </tr>';}
                    };
                ?>
                </tbody>
             </table>
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
    </body>
</html>
