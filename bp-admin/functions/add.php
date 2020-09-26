<?php
//Importación de datos
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
$loggedin = $_COOKIE["loggedin"];

//Tomar datos de formulario añadir registro desde panel.php
$titulo = $_REQUEST["element_1"];
$autor = $_REQUEST["element_2"];
$ISBN = $_REQUEST["element_3"];
$editorial = $_REQUEST["element_4"];
$anopub = $_REQUEST["element_5"];
$ejemplar = $_REQUEST["element_6"];
$ubicacion = $_REQUEST["element_7"];
$disponibilidad = "En desarrollo!";

//Utilizado durante las pruebas
/*$titulo = "Hola";
$autor = "SM";
$ISBN = "181818";
$editorial = "SM";
$anopub = "1919";
$ejemplar = "1191";
$ubicacion = "13";*/

$insert = "INSERT INTO `tabla`(`ANOPUB`, `AUTOR`, `EJEMPLAR`, `EDITORIAL`,`TITULO`, `UBICACION`, `ISBN`) VALUES ('$anopub','$autor','$ejemplar','$editorial','$titulo','$ubicacion','$ISBN')";
$databaseconnection->query($insert);

//Futura interfaz de información
?>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fas fa-star"></i> Inicio</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-search"></i> Búsqueda</a>
                    </li>
                    <?php if($loggedin == 0){
                        //Preparado para futuro sistema de Login
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Access</a>
                    </li>';}; ?>
                    <?php if($loggedin == 1){
                        //Preparado para futuro sistema de Login
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Log Out</a>
                    </li>';}; ?>
                    <?php if($loggedin == 1){
                        //Preparado para futuro sistema de Login
                        echo '<li class="nav-item">
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
                <h2 class="stitle">Se ha añadido correctamente el registro</h2>
            </div>
            <div class="cardse card-body">
                       <?php echo "<table>
                            <thead>
                                <tr>
                                    <th><h5><strong>' . $titulo . '</strong></h5></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p><em>' . $autor . '</em></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p><strong>ISBN</strong> <em>' . $ISBN . '</em></p></td>
                                    <td><p><strong>Ubicación</strong> <em>' . $ubicacion . '</td>
                                    <td><p><strong>Disponibilidad</strong>'. $disponibilidad .' <em></td>
                                </tr>
                                <tr>
                                    <td><p><strong>Editorial</strong> <em>' . $editorial . '</em></p></td>
                                    <td><p><strong>Año de Publicación</strong> <em>' . $anopub . '</td>
                                    <td><p><strong>Ejemplar</strong> <em>' . $ejemplar . '</td>
                                </tr>
                            </tbody>
                        </table> </div>"; ?>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/bp-admin/panel.php">Volver</a>
                            <input type = "button" class="btn btn-success" value = "Imprimir página" onclick = "window.print()" />
                        </div>
            
        </section>
        <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bookpress</a>
        </div>
        </footer>
    </body>
</html>
