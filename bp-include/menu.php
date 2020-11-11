<?php $sessionlog = $_COOKIE['loggedin'];
$sessionus = $_COOKIE['usuario'];
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/">Biblioteca</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">';
if ($sessionlog == 1) {
    if ($sessionclass == 1) {
        echo '<li class="nav-item">
                <a class="nav-link" href="/"><i class="fas fa-star"></i> Catálogo</span></a>
            </li><li class="nav-item">
            <a class="nav-link" href="/bp-admin/lectores.php"><i class="fas fa-book-reader"></i> Lectores</span></a>
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
            <a class="nav-link" href="/search.php"><i class="fas fa-search"></i> Búsqueda</a>
        </li>
        
';

echo '
        </ul>
    </div>';
if ($sessionlog == 1) {
    echo '<a class="nav-link" href="/bp-user/"><i class="fas fa-user"></i> Área Personal de ' . $sessionus . '</a>';
} else {
    echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginmodal" data-backdrop="false">
        Acceder
      </button>';
};
echo '
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acceder al sistema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="loginform" id="loginform" method="post" action="bp-user/logger.php">
      <div class="form-row align-items-center">
      <div class="col-sm-3 my-1">
        <label class="sr-only" for="inlineFormInputName">Usuario</label>
        <input type="text" class="form-control" id="inlineFormInputName" name="usuario" placeholder="Usuario">
      </div>
      <div class="col-sm-3 my-1">
        <label class="sr-only" for="inlineFormInputGroupUsername">Contraseña</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
          </svg></div>
          </div>
          <input type="password" class="form-control" id="inlineFormInputGroupUsername" name="contrasena" placeholder="Contraseña">           
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Conectarse</button>
      </div>
      </div>
    </div></form>
      </div>
    </div>
  </div>
</div>
</nav>';
