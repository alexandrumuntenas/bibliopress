<?php require $_SERVER['DOCUMENT_ROOT'] . '/bp-config.php';
?>
<div class="d-flex" id="wrapper">
  <div class="bg-light border-right " id="sidebar-wrapper">
    <div class="sidebar-fixed-top">
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
          <a class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img style="margin-right:10px;  vertical-align: middle;  width: 25px;  height: 25px;  border-radius: 50%;" src="<?php echo $usuarioresultado['AVATAR']; ?>"> Mi Perfil</a>
          <div class="dropdown-menu dropdown-menu-right" style="margin-right: 15px;" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/bp-user/">Mi Área Personal</a>
            <a class="dropdown-item" href="/bp-user/miperfil.php">Mi Perfil</a>
          </div>
        <?php } else { ?>
          <a href="" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#loginmodal" data-backdrop="false"><i class="fas fa-sign-in-alt"></i> Acceder</a>
        <?php };
        ?>
      </div>
    </div>
  </div>
  <div id="page-content-wrapper">
    <?php if ($sessionlogged == 1) {
      if ($sessionclass == 1) { ?>
        <div class="fab-container">
          <div class="fab fab-icon-holder">
            <i class="fas fa-plus"></i>
          </div>
          <ul class="fab-options">
            <li>
              <span class="fab-label">Añadir nuevo libro (Beta)</span>
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
              <span class="fab-label">Subir libros desde Abies</span>
              <div class="fab-icon-holder">
                <a type="link" data-toggle="modal" data-target="#subirabies"><i class="fas fa-upload"></i></a>
              </div>
            </li>
            <li>
              <span class="fab-label">Subir usuarios desde CSV</span>
              <div class="fab-icon-holder">
                <a type="link" data-toggle="modal" data-target="#subirusuarios"><i class="fas fa-upload"></i></a>
              </div>
            </li>
            <li>
              <span class="fab-label">Subir grupos desde CSV</span>
              <div class="fab-icon-holder">
                <a type="link" data-toggle="modal" data-target="#subirgrupos"><i class="fas fa-upload"></i></a>
              </div>
            </li>
          </ul>
        </div> <?php }
            } ?>
    <div class="sdb-collapse"><button class="menu-collapser waves-effect" id="menu-toggle"><i class="fas fa-chevron-right"></i></button>
    </div>
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    <?php require 'modules/modals.php'; ?>