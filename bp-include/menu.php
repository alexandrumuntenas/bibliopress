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
      <?php if ($sessionlogged == 1) { ?>
        <a class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="margin-right:10px;  vertical-align: middle;  width: 25px;  height: 25px;  border-radius: 50%;" src="/bp-include/avatar.png">Mi perfil</a>
        <div class="dropdown-menu dropdown-menu-right" style="margin-right: 15px;" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/bp-user/">Mi Área Personal</a>
          <a class="dropdown-item" href="/bp-user/miperfil.php">Mi Perfil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/bp-user/logout.php">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a>
        </div>
      <?php } else { ?>
        <a href="" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#loginmodal" data-backdrop="false"><i class="fas fa-sign-in-alt"></i> Acceder</a>
      <?php };
      ?>
    </div>
  </div>
  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom ">
      <button class="btn btn-outline-success waves-effect" id="menu-toggle"><i class="navbar-toggler-icon"></i></button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item dropdown">
          <li class="nav-item navbar-nav ml-auto">
          </li>
        </ul>
      </div>
    </nav>
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    <div class="fab-container">
      <div class="fab fab-icon-holder">
        <i class="fas fa-plus"></i>
      </div>

      <ul class="fab-options">
        <li>
          <span class="fab-label">Añadir nuevo libro</span>
          <div class="fab-icon-holder">
            <a type="link" data-toggle="modal" data-target="#addbook"><i class="fas fa-book-medical"></i></a>
          </div>
        </li>
        <li>
          <span class="fab-label">Añadir nuevo usuario</span>
          <div class="fab-icon-holder">
            <a type="link" data-toggle="modal" data-target="#adduser"><i class="fas fa-user-plus"></i></a>
          </div>
        </li>
        <li>
          <span class="fab-label">Añadir nuevo grupo</span>
          <div class="fab-icon-holder">
            <a type="link" data-toggle="modal" data-target="#addgroup"><i class="fas fa-users"></i></a>
          </div>
        </li>
        <li>
          <span class="fab-label">Subir desde Abies</span>
          <div class="fab-icon-holder">
            <a href="bp-admin/functions/abies.php"><i class="fas fa-upload"></i></a>
          </div>
        </li>
      </ul>
    </div>
    <?php require 'modules/modals.php'; ?>