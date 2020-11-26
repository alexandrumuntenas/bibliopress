<?php require '../bp-config.php';
?>
<html>
<title>
    <?php echo 'Gestionar Grupos > Biblioteca del ' . $sname; ?>
</title>
<?php

require '../bp-include/head.php';

if (isset($_POST['submit'])) {
    $nombre = $_POST["element_1"];
    $insert = "INSERT INTO `$bbddgrupos` (`NOMBRE`) VALUES ('$nombre')";
    $databaseconnection->query($insert);
    echo mysqli_error($databaseconnection);
}
if ($sessionlogged == 1) {
    if ($sessionclass == 1) {
?>

        <body>
            <?php require '../bp-include/menu.php'; ?>
            <div>
                <header>
                    <div class="bp-header">
                        <h2 class="bp-page-title">Gestionar Grupos</h2>
                    </div>
                </header>
                <section class="bp-section">
                    <?php echo '
            <div class="modal fade" id="promotemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Promocionar curso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="functions/promote.php">
                                <select class="form-control form-control-sm" id="inicial" name="inicial">
                                    <option value="No asignado">Selecciona el grupo</option>';
                    if ($gruposql->num_rows > 0) {
                        //datos de cada columna
                        while ($row = $gruposql->fetch_assoc()) {
                            echo '<option value="' . $row['NOMBRE'] . '">' . $row['NOMBRE'] . '</option>';
                        }
                    }
                    mysqli_data_seek($gruposql, 0);
                    echo
                        '
                                </select>
                                <p>a</p>
                                <select class="form-control form-control-sm" id="final" name="final">
                                    <option value="No asignado">Selecciona el grupo</option>';
                    if ($gruposql->num_rows > 0) {
                        //datos de cada columna
                        while ($row = $gruposql->fetch_assoc()) {
                            echo '<option value="' . $row['NOMBRE'] . '">' . $row['NOMBRE'] . '</option>';
                        }
                    }
                    echo '
                                </select>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Promocionar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="staticBackdropLabel">Añadir nuevo grupo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form_1388" class="appnitro" method="post" action="">
                                    <ul>

                                        <li id="li_1">
                                            <label class="description" for="element_1">Nombre del grupo</label>
                                            <div>
                                                <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value="" />
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Añadir" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            '; ?>
                    <button type="button" style="margin-bottom:10px;" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Añadir nuevo registro
                    </button>
                    <button type="button" style="margin-bottom:10px;" class="btn btn-success" data-toggle="modal" data-target="#promotemodal">
                        Promocionar
                    </button>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            mysqli_data_seek($gruposql, 0);
                            if ($gruposql->num_rows > 0) {
                                //datos de cada columna
                                while ($gr = $gruposql->fetch_assoc()) {
                                    echo '<tr>
                        <td data-label="Nombre"><br>' . $gr["NOMBRE"] . '</td>
                        <td data-label="Usuarios"><br><button type="button" class="btn btn-light" disabled />Ver usuarios</button></td>
                        <td data-label="Acciones disponibles"><br><a style="color:red;" href="functions/delgrupo.php?GRUPO=' . $gr["ID"] . '">Eliminar</a></td>
                        </tr>';
                                }
                            }; ?>
                        </tbody>
                    </table>
                </section>
            </div>
            </div>
        <?php } else { ?>

            <body class="err403">
                <section class="error-container">
                    <span><span>4</span></span>
                    <span>0</span>
                    <span><span>3</span></span>
                </section>
                <center>
                    <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                    <a class="btn btn-light" href="/">Llévame de vuelta</a>
                </center>
            <?php };
    } else { ?>

            <body class="err403">
                <section class="error-container">
                    <span><span>4</span></span>
                    <span>0</span>
                    <span><span>3</span></span>
                </section>
                <center>
                    <h2 style="color:#FFF; margin-bottom:15px;">No tienes permiso para acceder a esta página... :/</h2>
                    <a class="btn btn-light" href="/">Llévame de vuelta</a>
                </center>
            <?php } ?>
            <footer class="page-footer bg-primary">
                <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
                </div>
            </footer>
            </body>

</html>