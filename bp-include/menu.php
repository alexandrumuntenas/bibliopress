<?php $sessionlog = $_COOKIE['loggedin']; echo '<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/">Biblioteca</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/"><i class="fas fa-star"></i> Inicio</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/search.php"><i class="fas fa-search"></i> Búsqueda</a>
        </li>
';?>

<?php

if($sessionlog == 1){
    echo '<li class="nav-item">
    <a class="nav-link" href="/bp-admin/"><i class="fas fa-user"></i> Área Personal</a>
</li>';
}
else {
    echo '<li class="nav-item">
    <a class="nav-link" href="/bp-admin/"><i class="fas fa-user"></i> Acceso</a>
</li>';  
};
echo '
        </ul>
    </div>
</nav>'; ?>