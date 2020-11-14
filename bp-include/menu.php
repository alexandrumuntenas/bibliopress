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
            <a class="nav-link" data-toggle="modal" data-target="#searchmodal" data-backdrop="false"><i class="fas fa-search"></i> Búsqueda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#gdpr" data-backdrop="false">GDPR</a>
        </li>
        
';
if ($sessionlogged == 1) {
  echo '<a class="nav-link" href="/bp-user/"><i class="fas fa-user"></i> Área Personal de ' . $sessionus . '</a>';
};
echo '
        </ul>
    </div>';
if ($sessionlogged == 0) {
  echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginmodal" data-backdrop="false">
          Acceder
        </button>';
};
echo '
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
<div class="modal fade" id="gdpr" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="gdpr" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gdpr">Política de Privacidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<p> En Biblioteca del '.$sname.', accesible desde '.$sitelink.', una de nuestras principales prioridades es la privacidad de nuestros visitantes. Este documento de Política de privacidad contiene tipos de información recopilada y registrada por Biblioteca del '.$sname.' y cómo la usamos. </p>

<p> Si tiene preguntas adicionales o necesita más información sobre nuestra Política de privacidad, no dude en contactarnos. Nuestra Política de privacidad se generó con la ayuda de <a href=\"https://www.gdprprivacynotice.com/\"> Generador de políticas de privacidad GDPR de GDPRPrivacyNotice.com </a> </p>

<h2> Reglamento general de protección de datos (GDPR) </h2>
<p> Somos un controlador de datos de su información. </p>

<p> La base legal de '.$sname.' para recopilar y utilizar la información personal descrita en esta Política de privacidad depende de la Información personal que recopilamos y del contexto específico en el que recopilamos la información: </p>
<ul>
    <li> '.$sname.' debe celebrar un contrato contigo </li>
    <li> Le ha dado permiso a '.$sname.' para hacerlo </li>
    <li> El procesamiento de su información personal responde a intereses legítimos de '.$sname.' </li>
    <li> '.$sname.' debe cumplir con la ley </li>
</ul>
  
<p> '.$sname.' conservará su información personal solo durante el tiempo que sea necesario para los fines establecidos en esta Política de privacidad. Retendremos y usaremos su información en la medida necesaria para cumplir con nuestras obligaciones legales, resolver disputas y hacer cumplir nuestras políticas. </p>

<p> Si es residente del Espacio Económico Europeo (EEE), tiene ciertos derechos de protección de datos. Si desea que se le informe qué información personal tenemos sobre usted y si desea que se elimine de nuestros sistemas, comuníquese con nosotros. </p>
<p> En determinadas circunstancias, tiene los siguientes derechos de protección de datos: </p>
<ul>
    <li> El derecho a acceder, actualizar o eliminar la información que tenemos sobre usted. </li>
    <li> El derecho de rectificación. </li>
    <li> El derecho a oponerse. </li>
    <li> El derecho de restricción. </li>
    <li> El derecho a la portabilidad de datos </li>
    <li> El derecho a retirar el consentimiento </li>
</ul>

<h2> Archivos de registro </h2>

<p> La Biblioteca del '.$sname.' sigue un procedimiento estándar de uso de archivos de registro. Estos archivos registran a los visitantes cuando visitan sitios web. Todas las empresas de alojamiento hacen esto y forman parte del análisis de los servicios de alojamiento. La información recopilada por los archivos de registro incluye direcciones de protocolo de Internet (IP), tipo de navegador, proveedor de servicios de Internet (ISP), sello de fecha y hora, páginas de referencia / salida y posiblemente el número de clics. Estos no están vinculados a ninguna información que sea de identificación personal. El propósito de la información es analizar tendencias, administrar el sitio, rastrear el movimiento de los usuarios en el sitio web y recopilar información demográfica. </p>

<h2> Cookies y balizas web </h2>

<p> Como cualquier otro sitio web, Biblioteca del '.$sname.' utiliza \'cookies\'. Estas cookies se utilizan para almacenar información, incluidas las preferencias de los visitantes y las páginas del sitio web que el visitante accedió o visitó. La información se utiliza para optimizar la experiencia de los usuarios al personalizar el contenido de nuestra página web según el tipo de navegador de los visitantes y / u otra información. </p>

<p> Para obtener más información general sobre las cookies, lea <a href=\"https://www.cookieconsent.com/what-are-cookies/\">"Qué son las cookies" </a>. </p>



<h2> Políticas de privacidad </h2>

<P> Puede consultar esta lista para encontrar la Política de Privacidad de cada uno de los socios publicitarios de Biblioteca del '.$sname.'. </p>

<p> Los servidores de anuncios de terceros o las redes de anuncios utilizan tecnologías como cookies, JavaScript o Web Beacons que se utilizan en sus respectivos anuncios y enlaces que aparecen en Biblioteca del '.$sname.', que se envían directamente al navegador de los usuarios. Reciben automáticamente su dirección IP cuando esto ocurre. Estas tecnologías se utilizan para medir la eficacia de sus campañas publicitarias y / o para personalizar el contenido publicitario que ve en los sitios web que visita. </p>

<p> Tenga en cuenta que Biblioteca del '.$sname.' no tiene acceso ni control sobre estas cookies que utilizan anunciantes de terceros. </p>

<h2> Políticas de privacidad de terceros </h2>

<p> La Política de privacidad de Biblioteca del '.$sname.' no se aplica a otros anunciantes o sitios web. Por lo tanto, le recomendamos que consulte las respectivas Políticas de privacidad de estos servidores de anuncios de terceros para obtener información más detallada. Puede incluir sus prácticas e instrucciones sobre cómo excluirse de determinadas opciones. </p>

<p> Puede optar por desactivar las cookies a través de las opciones de su navegador individual. Para conocer información más detallada sobre la administración de cookies con navegadores web específicos, se puede encontrar en los respectivos sitios web de los navegadores. </p>

<h2> Información para niños </h2>

<p> Otra parte de nuestra prioridad es agregar protección para los niños mientras usan Internet. Alentamos a los padres y tutores a observar, participar y / o monitorear y guiar su actividad en línea. </p>

<p> Biblioteca del '.$sname.' no recopila a sabiendas ninguna información de identificación personal de niños menores de 13 años. Si cree que su hijo proporciona este tipo de información en nuestro sitio web, le recomendamos encarecidamente que se comunique con nosotros de inmediato y haremos todo lo posible para eliminar de inmediato dicha información de nuestros registros. </p>

<h2> Política de privacidad en línea únicamente </h2>

<p> Nuestra Política de privacidad se aplica solo a nuestras actividades en línea y es válida para los visitantes de nuestro sitio web con respecto a la información que compartieron y / o recopilaron en Biblioteca del '.$sname.'. Esta política no se aplica a ninguna información recopilada fuera de línea o a través de canales que no sean este sitio web. </p>

<h2> Consentimiento </h2>

<p> Al utilizar nuestro sitio web, usted acepta nuestra Política de privacidad y sus términos. </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
</nav>';
