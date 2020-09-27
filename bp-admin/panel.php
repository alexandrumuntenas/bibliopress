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
                    <h5 class="modal-title" id="staticBackdropLabel">Añadir nuevo registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="form_1388" class="appnitro"  method="post" action="functions/add.php">				
                <ul>
                    
                <li id="li_1">
                <label class="description" for="element_1">Título del libro </label>
                <div>
                    <input id="element_1" name="element_1" class="element text large" type="text" maxlength="255" value=""/> 
                </div> 
                </li>		<li id="li_2">
                <label class="description" for="element_2">Autor </label>
                <div>
                    <input id="element_2" name="element_2" class="element text large" type="text" maxlength="255" value=""/> 
                </div> 
                </li>		<li id="li_3">
                <label class="description" for="element_3">ISBN </label>
                <div>
                    <input id="element_3" name="element_3" class="element text large" type="text" maxlength="255" value=""/> 
                </div> 
                </li>		<li id="li_4">
                <label class="description" for="element_4">Editorial </label>
                <div>
                    <input id="element_4" name="element_4" class="element text large" type="text" maxlength="255" value=""/> 
                </div> 
                </li>		<li id="li_5">
                <label class="description" for="element_5">Año de Publicación </label>
                <div>
                    <input id="element_5" name="element_5" class="element text large" type="text" maxlength="255" value=""/> 
                </div> 
                </li>		<li id="li_6">
                <label class="description" for="element_6">Ejemplar </label>
                <div>
                    <input id="element_6" name="element_6" class="element text large" type="text" maxlength="255" value=""/> 
                </div> 
                </li>		<li id="li_7">
                <label class="description" for="element_7">Ubicación </label>
                <div>
                    <input id="element_7" name="element_7" class="element text large" type="text" maxlength="255" value=""/> 
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
            $result = mysqli_query($databaseconnection, "SELECT * FROM $tableMySQL");
            $qty = mysqli_num_rows($result);
            echo '<p class="badge badge-success badge-pill">'. $qty . ' Registros</p>'
            ?>
            
            <table>
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Editorial</th>
                    <th>Año de Publicación</th>
                    <th>Ejemplar</th>
                    <th>Ubicación</th>
                    <th>Acciones disponibles</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if ($resultado->num_rows > 0) {
                    //datos de cada columna
                    while($row = $resultado->fetch_assoc()) {
                    echo '<tr>
                    <td>' . $row["TITULO"] . '</td>
                    <td>' . $row["AUTOR"] . '</td>
                    <td>' . $row["ISBN"] . '</td>
                    <td>' . $row["EDITORIAL"] . '</td>
                    <td>' . $row["ANOPUB"] . '</td>
                    <td>' . $row["EJEMPLAR"] . '</td>
                    <td>' . $row["UBICACION"] . '</td>
                    <td><a href="functions/edit.php?id=' . $row["ID"] . '">Editar</a><br><a href="functions/delete.php?id=' . $row["ID"] . '">Eliminar</a></td>
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
