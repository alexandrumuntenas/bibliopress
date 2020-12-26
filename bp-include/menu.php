<div class="d-flex" id="wrapper">
  <div class="bg-light border-right " id="sidebar-wrapper">
    <div class="sidebar-fixed-top">
      <div class="sidebar-heading">Biblioteca</div>
      <div class="list-group list-group-flush">
        <a href="/" class="list-group-item list-group-item-action bg-light"><i class="fas fa-star"></i> <?php if($sessionclass == 1){echo 'Catálogo';} else{echo 'Inicio';} ?></a>
        <a class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#searchmodal" data-backdrop="false"><i class="fas fa-search"></i> Búsqueda</a>

        <?php 
        if ($sessionlogged == 1) {
          if ($sessionclass == 0){
            echo '<a class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#solicitar" data-backdrop="false"><i class="fas fa-paper-plane"></i> Solicitar libro</a>';  
          }
      if ($sessionclass == 1) {
            echo '
      <div class="sidebar-spacer"></div>
      <a href="/bp-admin/prestamos.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-people-carry"></i> Préstamos</a>
      <a href="/bp-admin/solicitudes.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-inbox"></i> Libros solicitados</a>
      <div class="sidebar-spacer"></div>
      <a href="/bp-admin/usuarios.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-book-reader"></i> Usuarios</a>
      <a href="/bp-admin/grupos.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i> Grupos</a>
      <div class="sidebar-spacer"></div>
      <a href="/bp-admin/configuracion.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-cogs"></i> Configuración</a>
      <div class="sidebar-spacer"></div>
      ';
          };
        }; ?>
        <?php if ($sessionlogged == 1) { ?>
          <a class="nav-link list-group-item list-group-item-action bg-light" href="/bp-user/"><img style="margin-right:10px;  vertical-align: middle;  width: 25px;  height: 25px;  border-radius: 50%;" src="<?php echo $sesavatarresultado['AVATAR']; ?>"> Mi área personal</a>
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
          </ul>
        </div> <?php }
            } ?>
    <div class="sdb-collapse"><button class="menu-collapser waves-effect" id="menu-toggle"><i id="iconsidebartoggle" class="fas fa-chevron-right"></i></button>
    </div>
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("#iconsidebartoggle").toggleClass("iconsidebartoggle-activated");
      });
    </script>