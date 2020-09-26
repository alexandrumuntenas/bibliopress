<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>
        <?php echo "Biblioteca del " . $sname;?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/bp-content/themes/vexia/style.css">
        <script src="https://use.fontawesome.com/releases/v5.14.0/js/all.js" data-auto-replace-svg="nest"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <div class="wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a class="navbar-brand" href="/"><?php echo "Biblioteca del " . $sname;?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fas fa-star"></i> Inicio</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-search"></i> Búsqueda</a>
                    </li>
                    <?php if($loggedin == 0){
                        //Preparado para futuro sistema de Login
                        echo '<li class="nav-item">
                        <a class="nav-link" href="bp-login.php"><i class="fas fa-user"></i> Access</a>
                    </li>';}; ?>
                    <?php if($loggedin == 1){
                        //Preparado para futuro sistema de Login
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Log Out</a>
                    </li>';}; ?>
                    <?php if($loggedin == 1){
                        //Preparado para futuro sistema de Login
                        echo '<li class="nav-item active">
                        <a class="nav-link" href="/bp-admin/panel.php"><i class="fas fa-edit"></i> Panel</a>
                    </li>';}; ?>
                    </ul>
                </div>
            </nav>
            <div class="header">
                <h1 class="centered">Inicio</h1>
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
                    } else {
                    echo "0 resultados";
                    }
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
