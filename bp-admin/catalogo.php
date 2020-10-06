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
            <center>
            <div class="btn-group" role="group">
            <a href="index.php" type="button" class="btn btn-secondary">Inicio</a>
            <div class="btn-group" role="group">
                <a href="catalogo.php" id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Catálogo</a>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop">
                    Añadir nuevo registro
                    </button>
                    <a href="functions/abies.php" class="dropdown-item">Subir desde Abies</a>
                </div>
            </div>
            <a href="lectores.php" type="button" class="btn btn-secondary">Lectores</a>
            </div>
            </center>
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
                <li id="li_7">
                <label class="description" for="element_8">Descripción </label>
                <div>
                    <input type="text" id="element_8" name="element_8" class="element text large" maxlength="512" value=""/>
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
            <div class="row">
            <?php
            if ($databaseconnection->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $databaseconnection->connect_errno . ") " . $databaseconnection->connect_error;
            }else{
                                // Validado de la variable GET
                    $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
                $TotalReg       =$databaseconnection->query("SELECT * FROM `bp_catalogo`");
                //Se divide la cantidad de registro de la BD con la cantidad a mostrar 
                $TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
                //Consulta SQL
                $consultavistas ="SELECT * FROM `bp_catalogo`
                                    ORDER BY
                                    id ASC
                                    LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
                $consulta=$databaseconnection->query($consultavistas);
    
                    echo '';
                while ($row=$consulta->fetch_row()) {
                    $long = 250;
                    $desc = substr($row[12], 0, $long);
                    echo '<div class="cardse card-body">
                    <h5><strong>' . $row[6] . '</strong></h5>
                    <p><em>' . $row[1] . '</em></p>
                    <p>' . $desc . '</p>
                    <a style="color: blue; margin-right:5px;" href="functions/edit.php?id=' . $row[10] . '">Editar</a>                          <a style="color: red;" href="functions/delete.php?id=' . $row[10] . '">Eliminar</a>
                    </div>';
                };
                ?>
            </div>
            <footer class="page-footer" style="margin-top: 50px;">
        <?php
                /*Sector de Paginacion */
                
                //Operacion matematica para botón siguiente y atrás 
                $IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
                $DecrementNum =(($compag -1))<1?1:($compag -1);
            
                echo "<ul class='pagination'><li class=\"page-item\"><a class='page-link' href=\"?pag=".$DecrementNum."\">&laquo;</a></li>";
                //Se resta y suma con el numero de pag actual con el cantidad de 
                //números  a mostrar
                $Desde=$compag-(ceil($CantidadMostrar/2)-1);
                $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
                
                //Se valida
                $Desde=($Desde<1)?1: $Desde;
                $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
                //Se muestra los números de paginas
                for($i=$Desde; $i<=$Hasta;$i++){
                    //Se valida la paginacion total
                    //de registros
                    if($i<=$TotalRegistro){
                        //Validamos la pag activo
                    if($i==$compag){
                    echo "<li class=\"page-item active\"><a class='page-link' href=\"?pag=".$i."\">".$i."</a></li>";
                    }else {
                        echo "<li><a class='page-link' href=\"?pag=".$i."\">".$i."</a></li>";
                    }     		
                    }
                }
                echo "<li class=\"page-item\"><a class='page-link' href=\"?pag=".$IncrimentNum."\">&raquo;</a></li></ul>";
            
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
