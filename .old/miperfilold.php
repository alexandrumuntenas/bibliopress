<?php
//Importación de datos
require '../bp-config.php';
$querylector = "SELECT *  FROM `bp_usuarios` WHERE `USUARIO` LIKE '" . $sessionus . "'";
$qlectorre = mysqli_query($databaseconnection, $querylector);
$qlector = mysqli_fetch_assoc($qlectorre);
?>

<html>
<?php require '../bp-include/head.php'; ?>

<body>
    <header>

        <div class="wrapper">
            <?php require '../bp-include/menu.php'; ?>
            <?php if ($sessionlogged == 1) {
                echo '
            <div class="bp-header">
                <h2 class="bp-page-title">Área Personal</h2>
            </div>';
            } else {
                echo '
                <div class="bp-header">
                    <h2 class="bp-page-title">Iniciar Sesión</h2>
                </div>';
            }; ?>
    </header>
    <?php if ($sessionlogged == 1) {
        if ($sessionclass == 1) {
            echo '<section class="bp-section flex-column"><center>
            <div class="btn-group" role="group">
            <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
            <a href="miperfil.php" type="button" class="btn btn-secondary">Mi Perfil <i class="fas fa-id-card-alt"></i></a>
            <a href="logout.php" type="button" class="btn btn-danger">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
            </center><div class="row">
            <div class="bp-card card-body">
            <h5>Sobre Mí</h5>
                    <form id="form_1388"  method="post" action="/bp-admin/functions/actualizar.php">				
                        <ul>
                            
                        <li id="li_1">
                        <label class="description" for="element_1">Nombre </label>
                        <div>
                            <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value="" readonly/> 
                        </div> 
                        </li>		<li id="li_2">
                        <label class="description" for="element_2">Apellido </label>
                        <div>
                            <input id="element_2" name="element_2" class="form-control form-control-sm" type="text" maxlength="255" value="" readonly/> 
                        </div> 
                        </li>		<li id="li_2">
                        <label class="description" for="element_5">Correo Electrónico </label>
                        <div>
                            <input id="element_5" name="element_5" class="form-control form-control-sm" type="email" maxlength="255" value="'.$sessionus.'"/> 
                        </div> 
                        </li>
                        </ul>
                        </form>
            </div>
            <div class="bp-card card-body">
            <h5>Mi Avatar</h5><p>No te emociones, seguimos trabajando en ello</p></div>
            <div class="bp-card card-body">
            <h5>N</h5><p>No te emociones, seguimos trabajando en ello</p>
            </div></div></section>';
        } else {
            echo '<section class="bp-section flex-column"><center>
            <div class="btn-group" role="group">
            <a href="index.php" type="button" class="btn btn-primary">Inicio</a>
            <a href="miperfil.php" type="button" class="btn btn-secondary">Mi Perfil <i class="fas fa-id-card-alt"></i></a>
            <a href="logout.php" type="button" class="btn btn-danger">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
            </center><div class="row">
            <div class="bp-card card-body">
            <h5>Sobre Mí</h5>
                    <form id="form_1388"  method="post" action="/bp-admin/functions/actualizar.php">				
                        <ul>
                            
                        <li id="li_1">
                        <label class="description" for="element_1">Nombre </label>
                        <div>
                            <input id="element_1" name="element_1" class="form-control form-control-sm" type="text" maxlength="255" value="" readonly/> 
                        </div> 
                        </li>		<li id="li_2">
                        <label class="description" for="element_2">Apellido </label>
                        <div>
                            <input id="element_2" name="element_2" class="form-control form-control-sm" type="text" maxlength="255" value="" readonly/> 
                        </div> 
                        </li>		<li id="li_2">
                        <label class="description" for="element_5">Correo Electrónico </label>
                        <div>
                            <input id="element_5" name="element_5" class="form-control form-control-sm" type="email" maxlength="255" value="'.$sessionus.'"/> 
                        </div> 
                        </li>
                        </ul>
                        </form>
            </div>
            <div class="bp-card card-body">
            <h5>Mi Avatar</h5><p>No te emociones, seguimos trabajando en ello</p></div>
            <div class="bp-card card-body">
            <h5>N</h5><p>No te emociones, seguimos trabajando en ello</p>
            </div></div></section>';
        }
    } else {
        echo "<section class='bp-section'><div class='row'><div class='bp-card card-body'><form name='loginform' id='loginform' method='post' action='logger.php'>
        <div class='form-row align-items-center'>
        <div class='col-sm-3 my-1'>
          <label class='sr-only' for='inlineFormInputName'>Usuario</label>
          <input type='text' class='form-control' id='inlineFormInputName' name='usuario' placeholder='Usuario'>
        </div>
        <div class='col-sm-3 my-1'>
          <label class='sr-only' for='inlineFormInputGroupUsername'>Contraseña</label>
          <div class='input-group'>
            <div class='input-group-prepend'>
              <div class='input-group-text'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-key' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
              <path fill-rule='evenodd' d='M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z'/>
              <path d='M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z'/>
            </svg></div>
            </div>
            <input type='password' class='form-control' id='inlineFormInputGroupUsername' name='contrasena' placeholder='Contraseña'>           
          </div>
        </div>
        <button type='submit' class='btn btn-primary'>Conectarse</button>
        </div>
        </div>
      </div></form></div></div></section>";
    }
    ?>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>