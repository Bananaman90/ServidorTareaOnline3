<main style="text-align:center" class="marco">
    <?php require 'includes/Conexion.php'; ?>

    <h1><i><b> Login de usuario </b></i></h1>

    <form action="IndexLogin.php" method="post" enctype="multipart/form-data">
        Usuario: 
        <br><input type="text" name="usuario" 
        value="<?php // Si hay cookies almacenadas, se mostrarán los datos recogidos en este y el resto de campos.
                    if(isset($_COOKIE['usuario'])) { 
                        echo $_COOKIE['usuario']; } ?>"/><br><br>

        Contraseña:
        <br><input type="password" name="contrasena" 
        value="<?php 
                    if(isset($_COOKIE['contrasena'])) { 
                        echo $_COOKIE['contrasena']; } ?>"/><br><br>

        <input type="checkbox" name="recordar" 
            <?php 
                if(isset($_COOKIE['recordar'])) { 
                    echo "checked"; } ?>> 
        Recuérdame :) <br>

        <input type="checkbox" name="abierta" 
            <?php 
                if(isset($_COOKIE['abierta'])) { 
                    echo "checked"; } ?>> 
        Mantener la sesión abierta… ;) <br><br>

        <?php
            // En caso de obtenerse uno de los tres errores especificados, se mostrará el mensaje correspondiente.
            if(isset($_GET['error'])) {
                if($_GET['error']=="datos") {
                    echo '<div class="alert alert-danger" style="margin-top:5px;">'
                    ."Tu usuario o/y tu contraseña no son correctos!! :( <br/>".'</div>';
                } else if($_GET['error']=="fuera") {
                    echo '<div class="alert alert-danger" style="margin-top:5px;">'
                    ."No puede acceder directamente en esta página, ha de loguearse!! :O <br/>".'</div>';
                } else if($_GET['error']=="vacio") {
                    echo '<div class="alert alert-danger" style="margin-top:5px;">'
                    ."Debes introducir un usuario o/y una contraseña!! >:( <br/>".'</div>';
                }
            }
        ?>

        <input type="submit" value="Enviar" name="submit" class="btn btn-success"/>
    </form>
</main><br>