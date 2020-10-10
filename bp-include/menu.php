<?php $sessionlog = $_COOKIE['loggedin'];
$sessionus = $_COOKIE['usuario']; 
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/">Biblioteca del ' . $sname. '</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">';
        if ($sessionlog == 1) {
            if ($sessionclass == 1){
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

if ($sessionlog == 1) {
    echo '<li class="nav-item">
    <a class="nav-link" href="/bp-user/"><i class="fas fa-user"></i> Área Personal de ' . $sessionus . '</a>
</li>';
} else {
    echo '<li class="nav-item">
    <a class="nav-link" href="/bp-user/"><i class="fas fa-user"></i> Hola, invitado</a>
</li>';
};
echo '
        </ul>
    </div>
</nav>';
