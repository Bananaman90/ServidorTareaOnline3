<main style="text-align:center" class="marco">
    <?php require 'includes/Conectado.php'; ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link disabled" href="IndexInicio.php"> Inicio <span class="sr-only"> (current) </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="IndexPagina.php"> Página 2 </a>
                </li>
            </ul>
        </div>

        <a class="navbar-brand" href="includes/Logout.php"> Cerrar sesión </a>
    </nav>

    <h1><i><b> Mi Sitio </b> - Inicio </i></h1>

    <h3> ¡Bienvenido 
        <?php // En ambos casos se muestra el nombre del usuario, con la diferencia de que este dato se recoge en base a si hay o no cookies. 
            if(isset($_COOKIE['abierta'])) { 
                echo "<b>".$_COOKIE['abierta']."</b>!" ; 
            } else { 
                echo "<b>".$_SESSION['usuario']."</b>!"; } 
        ?> </h3>
    <img class="alineadoTextoImagen" src="imagenes//user.png" width="100px"/>
</main><br>