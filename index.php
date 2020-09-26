<?php
include('bp-config.php');   
$bbdd = $databaseconnection;
$style = "dark";
$schoolname = "Colegio Las Nieves";
$year = date("Y");

$title = "Nunca seré tu héroe";

$loggedin = 0;

$sql = "SELECT TITULO, AUTOR, ISBN, EDITORIAL, UBICACION, ANOPUB, EJEMPLAR, DISPONIBILIDAD FROM tabla";
$result = $bbdd->query($sql);


?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>
        <?php echo "Biblioteca del " . $schoolname;?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/bp-include/style.css">
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
                <a class="navbar-brand" href="/"><?php echo "Biblioteca del " . $schoolname;?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fas fa-star"></i> Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-search"></i> Search</a>
                    </li>
                    
                    <?php if($loggedin == 0){
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Access</a>
                    </li>';}; ?>
                    <?php if($loggedin == 1){
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Log Out</a>
                    </li>';}; ?>
                    <?php if($loggedin == 1){
                        echo '<li class="nav-item">
                        <a class="nav-link" href="uploader.php"><i class="fas fa-upload"></i> Upload</a>
                    </li>';}; ?>
                    </ul>
                </div>
            </nav>
            <div class="header">
                <h1 class="centered">Home</h1>
            </div>
        </header>
        <section class="section">
            <div>
                <h2 class="stitle">Últimas novedades!</h2>
            </div>
            <?php 
                if ($result->num_rows > 0) {
                    //datos de cada columna
                    while($row = $result->fetch_assoc()) {
                        
                        if($row["DISPONIBILIDAD"] == 1){$stock = "    ✓✗";};
                        echo '<div class="cardse card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th><h5><strong>' . $row["TITULO"] . '</strong></h5></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p><em>' . $row["AUTOR"] . '</em></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p><strong>ISBN</strong> <em>' . $row["ISBN"] . '</em></p></td>
                                    <td><p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</td>
                                    <td><p><strong>Disponibilidad</strong>'. $stock .' <em></td>
                                </tr>
                                <tr>
                                    <td><p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p></td>
                                    <td><p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</td>
                                    <td><p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . '</td>
                                </tr>
                            </tbody>
                        </table> </div>';
                    }
                } else {
                    echo "0 results";
                }
                ?>  
        </section>
        <footer class="page-footer bg-primary">
            <?php
            
            ?>
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $year . " " . $schoolname; ?></a>
        </div>
        </footer>
    </body>
</html>