<?php require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';

echo '<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/">Biblioteca</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">';
if ($sessionlogged == 1) {
  if ($sessionclass == 1) {
    echo '<li class="nav-item">
                <a class="nav-link" href="/"><i class="fas fa-star"></i> Catálogo</span></a>
            </li><li class="nav-item">
            <a class="nav-link" href="/bp-admin/usuarios.php"><i class="fas fa-book-reader"></i> Usuarios</span></a>
        </li><li class="nav-item">
            <a class="nav-link" href="/bp-admin/grupos.php"><i class="fas fa-users"></i> Grupos</span></a>
        </li><li class="nav-item">
        <a class="nav-link" href="/bp-admin/prestamos.php"><i class="fas fa-people-carry"></i> Préstamos</span></a>
    </li>';
  } else {
    echo '<li class="nav-item">
            <a class="nav-link" href="/"><i class="fas fa-star"></i> Inicio</span></a>
        </li>';
  }
} else {
  echo '        <li class="nav-item">
            <a class="nav-link" href="/"><i class="fas fa-star"></i> Inicio</span></a>
        </li>';
};
echo '
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#searchmodal" data-backdrop="false"><i class="fas fa-search"></i> Búsqueda</a>
        </li>        
';
echo '
        </ul>
    </div>
    <ul class="nav navbar-nav navbar-right">
    <li><a class="nav-link" href="/bp-user/">Hola, '; if ($sessionlogged == 1) {echo $sessionus;}; echo '<img class="pull-right" style="margin-left:10px;  vertical-align: middle;  width: 25px;  height: 25px;  border-radius: 50%;" src="/bp-include/avatar.png"></a></li>
</ul>';
if ($sessionlogged == 0) {
  echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginmodal" data-backdrop="false">
          Acceder
        </button>';
};
echo '
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
  <div class="modal-dialog modal-login">
      <div class="modal-content">
        <form action="bp-user/logger.php" method="post">
          <div class="modal-header">				
            <h4 class="modal-title">Acceder</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">				
            <div class="form-group">
              <label>Usuario</label>
              <input type="email" class="form-control" required="required" name="usuario">
            </div>
            <div class="form-group">
              <div class="clearfix">
                <label>Contraseña</label>
                <button disabled><small>¿Contraseña Olvidada? (Función en Desarrollo)</small></a>
              </div>
              
              <input type="password" class="form-control" required="required" name="contrasena">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <label class="form-check-label"><input type="checkbox" checked disabled> Remember me (Función en Desarrollo)</label>
            <input type="submit" class="btn btn-primary" value="Login">
          </div>
        </form>
      </div>
    </div>  
    </div>
  </div>
</div>
<!-- Modal Búsqueda -->
<div class="modal fade" id="searchmodal" tabindex="-1" aria-labelledby="searchmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
      <input class="buscador-ajax" type="text" id="search" placeholder="Introduce el título del libro a buscar" />
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row"></div>
      <div class"row"><div id="display"></div></div>
      </div>
    </div>
  </div>
</div>
</nav>';
