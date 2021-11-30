<main style="text-align:center" class="marco">
    <?php require 'includes/Conexion.php'; ?>

    <h1><i><b> Login de usuario </b></i></h1>

    <form action="IndexLogin.php" method="post" enctype="multipart/form-data">
        Usuario: 
        <br><input type="text" name="usuario"/><br><br>

        Contraseña:
        <br><input type="password" name="contrasena"/><br><br>

        <input type="checkbox" name="recordar"> Recuérdame :)<br><br>

        <?php
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