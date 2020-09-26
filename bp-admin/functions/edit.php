<?php
require $_SERVER['DOCUMENT_ROOT']. '/bp-config.php';
$id=$_REQUEST['id'];
$query = "SELECT * FROM `tabla` WHERE `ID` = '".$id."'"; 
$result = mysqli_query($databaseconnection, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo $row["TITULO"]; ?> < Editar
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
<div class="form">
<h1>Update Record</h1>
<?php echo '<div class="cardse card-body">
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
                                    <td><p><strong>Ubicación</strong> <em>' . $row["UBICACION"] . '</em></td>
                                    <td><p><strong>Ejemplar</strong> <em>' . $row["EJEMPLAR"] . ' </em></td>
                                </tr>
                                <tr>
                                    <td><p><strong>Editorial</strong> <em>' . $row["EDITORIAL"] . '</em></p></td>
                                    <td><p><strong>Año de Publicación</strong> <em>' . $row["ANOPUB"] . '</td>
                                    <td><p><strong></strong></td>
                                </tr>
                            </tbody>
                        </table> </div>';?>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$name =$_REQUEST['name'];
$age =$_REQUEST['age'];
$submittedby = $_SESSION["username"];
$update="update new_record set trn_date='".$trn_date."',
name='".$name."', age='".$age."',
submittedby='".$submittedby."' where id='".$id."'";
mysqli_query($databaseconnection, $update) or die(mysqli_error());
$status = "Record Updated Successfully. </br></br>
<a href='view.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
<p><input type="text" name="name" placeholder="Enter Name" 
required value="<?php echo $row['TITULO'];?>" /></p>
<p><input type="text" name="age" placeholder="Enter Age" 
required value="<?php echo $row['ANOPUB'];?>" /></p>
<p><input name="submit" type="submit" value="Update" /></p>
</form>
<?php } ?>
</div>
</div>
</body>
</html>