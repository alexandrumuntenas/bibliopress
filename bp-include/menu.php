<?php require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
?>
<div class="d-flex" id="wrapper">
  <div class="bg-light border-right " id="sidebar-wrapper">
    <div class="sidebar-heading">Biblioteca</div>
    <div class="list-group list-group-flush">
      <a href="/" class="list-group-item list-group-item-action bg-light"><i class="fas fa-star"></i> Catálogo</a>
      <a class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#searchmodal" data-backdrop="false"><i class="fas fa-search"></i> Búsqueda</a>
      <?php if ($sessionlogged == 1) {
        if ($sessionclass == 1) {
          echo '
      <a href="/bp-admin/usuarios.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-book-reader"></i> Usuarios</a>
      <a href="/bp-admin/grupos.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i> Grupos</a>
      <a href="/bp-admin/prestamos.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-people-carry"></i> Préstamos</a>
      ';
        };
      }; ?>
      <?php if ($sessionlogged == 1) {
        echo '
      <a href="/bp-user/" class="list-group-item list-group-item-action bg-light"><i class="fas fa-id-card-alt"></i> Mi Perfil</a>';
      } else {
        echo '
      <a href="/bp-user/" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#loginmodal" data-backdrop="false"><i class="fas fa-sign-in-alt"></i> Acceder</a>';
      };
      ?>
    </div>
  </div>
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
          <div class"row">
            <div id="display"></div>
          </div>
        </div>
      </div>
    </div>
  </div>