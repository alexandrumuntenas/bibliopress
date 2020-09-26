<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
$query = "SELECT * FROM `$tableMySQL` WHERE `ID` = '" . $id . "'";
$result = mysqli_query($databaseconnection, $query);
$row = mysqli_fetch_assoc($result);
$loggedin = $_COOKIE["loggedin"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?php echo $row["TITULO"]; ?> < Editar </title> <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

<body class="headerlogin">
    <div class="form">
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
                        <a class="nav-link" href="bp-login.php"><i class="fas fa-user"></i> Access</a>
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
        <?php echo ''; ?>
        <?php
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
            $id = $_REQUEST['id'];
            $trn_date = date("Y-m-d H:i:s");
            $name = $_REQUEST['name'];
            $age = $_REQUEST['age'];
            $submittedby = $_SESSION["username"];
            $update = "update new_record set trn_date='" . $trn_date . "',
name='" . $name . "', age='" . $age . "',
submittedby='" . $submittedby . "' where id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            $status = "Record Updated Successfully. </br></br>
<a href='view.php'>View Updated Record</a>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else {
            echo '
            <div class="loginsection card-body">
                <form name="form" method="post" action="">
                    <input style="float:right;" class="btn btn-danger" name="submit" type="submit" value="Update" />
        
                        <table style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th><h5>Título <input type="text" name="name" placeholder="Escribe el título" required value="'. $row['TITULO'] . '" /></h5></th>
                                    <th><input type="hidden" name="new" value="1" /></th>
                                    <th><input name="id" type="hidden" value="' . $row['ID'] . '" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p>Autor <em><input type="text" name="age" placeholder="Escribe el Autor" required value="' . $row["AUTOR"] . '" /></em></p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p><strong>ISBN</strong> <em><input type="text" name="age" placeholder="Escribe el ISBN" required value="' . $row["ISBN"] . '" /></em></p></td>
                                    <td><p><strong>Ubicación</strong> <em><input type="text" name="age" placeholder="Escribe dónde se sitúa este libro" required value="' . $row["UBICACION"] . '" /></em></td>
                                    <td><p><strong>Ejemplar</strong> <em><input type="text" name="age" placeholder="Escribe el identificador de Ejemplar" required value="' . $row["EJEMPLAR"] . '" /> </em></td>
                                </tr>
                                <tr>
                                    <td><p><strong>Editorial</strong> <em><input type="text" name="age" placeholder="Escribe la Editorial" required value="' . $row["EDITORIAL"] . '" /></em></p></td>
                                    <td><p><strong>Año de Publicación</strong> <em><input type="text" name="age" placeholder="Escribe el Año de Publicación" required value="' . $row["ANOPUB"] . '" /></td>
                                    <td><p><strong></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>';
        }; ?>

        <div>
        </div>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . $dformat . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
        </footer>
</body>

</html>