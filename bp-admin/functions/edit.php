<!DOCTYPE html>
<html>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
$id = $_REQUEST['id'];
$editsql = "SELECT *  FROM $bbddcatalogo WHERE ID = " . $id;
$editquery = $databaseconnection->query($editsql);
$editresult = mysqli_fetch_assoc($editquery);
require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/head.php';
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
        echo '<div class="form">';
        require $_SERVER["DOCUMENT_ROOT"] . '/bp-include/menu.php';
        $status = "";
        if (isset($_POST['edit'])) {
            $id = $_REQUEST['id'];
            $ANOPUB = mysqli_real_escape_string($databaseconnection, $_POST["anopub"]);
            $AUTOR = mysqli_real_escape_string($databaseconnection, $_POST["autor"]);
            $EJEMPLAR = mysqli_real_escape_string($databaseconnection, $_POST["ejemplar"]);
            $EDITORIAL = mysqli_real_escape_string($databaseconnection, $_POST["editorial"]);
            $TITULO = mysqli_real_escape_string($databaseconnection, $_POST["titulo"]);
            $UBICACION = mysqli_real_escape_string($databaseconnection, $_POST["ubicacion"]);
            $ISBN = mysqli_real_escape_string($databaseconnection, $_POST["isbn"]);
            $DESCRIPCION = mysqli_real_escape_string($databaseconnection, $_POST["descripcion"]);

            $update = "UPDATE `$bbddcatalogo` set ANOPUB='" . $ANOPUB . "', AUTOR='" . $AUTOR . "', EJEMPLAR='" . $EJEMPLAR . "', EDITORIAL='" . $EDITORIAL . "', TITULO='" . $TITULO . "', UBICACION='" . $UBICACION . "', ISBN='" . $ISBN . "', DESCRIPCION='" . $DESCRIPCION . "' where id='" . $id . "'";
            mysqli_query($databaseconnection, $update);
            $status = "<div class='bp-card-info'><p class='btn btn-success'>Se ha actualizado el registro $id</p><br><br><a class='btn btn-link' href='/'>Volver al panel</a></div>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else { ?>
            <section class="bp-section">
                <div class="row d-flex justify-content">
                    <h2 class="editor">Editar libro <?php echo $editresult['TITULO']; ?></h2>
                </div>
                <form class="md-form" action="" method="POST">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <div class="md-form">
                                    <input type="text" name="titulo" id="form1" class="form-control" value="<?php echo $editresult['TITULO']; ?>" required>
                                    <label for="form1">Título del libro</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="autor" id="form1" class="form-control" value="<?php echo $editresult['AUTOR']; ?>" required>
                                    <label for="form1">Autor</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="isbn" id="form1" class="form-control" value="<?php echo $editresult['ISBN']; ?>" required>
                                    <label for="form1">ISBN</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="editorial" id="form1" class="form-control" value="<?php echo $editresult['EDITORIAL']; ?>" required>
                                    <label for="form1">Editorial</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="anopub" id="form1" class="form-control" value="<?php echo $editresult['ANOPUB']; ?>" required>
                                    <label for="form1">Año de Publicación</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="ejemplar" id="form1" class="form-control" value="<?php echo $editresult['EJEMPLAR']; ?>" required>
                                    <label for="form1">Ejemplar</label>
                                </div>

                                <div class="md-form">
                                    <input type="text" name="ubicacion" id="form1" class="form-control" value="<?php echo $editresult['UBICACION']; ?>" required>
                                    <label for="form1">Ubicación</label>
                                </div>
                            </div>
                            <div class="col-sm">

                                <div class="md-form">
                                    <textarea id="form7" name="descripcion" class="md-textarea form-control" rows="3" required><?php echo $editresult['DESCRIPCION']; ?></textarea>
                                    <label for="form7">Descripción</label>
                                </div>
                            </div>

                            <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" name="edit" type="submit">Save</button>

                </form>
            </section>
<?php   }
    } else {
        echo "<meta http-equiv='refresh' content='0;url=/' />";
    }
} else {
    echo "<meta http-equiv='refresh' content='0;url=/' />";
};
?>

<div>
</div>
</div>
</body>

</html>