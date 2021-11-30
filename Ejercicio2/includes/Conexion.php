<?php
    $valUsuario="bananaman";
    $valContrasena="banana";
    
    if(isset($_POST['submit'])) {
        if((isset($_POST['usuario']) && isset($_POST['contrasena'])) && ((!empty($_POST['usuario'])) && (!empty($_POST['usuario'])))) {
            if($_POST['usuario']==$valUsuario && $_POST['contrasena']==$valContrasena) {
                session_start();
                $_SESSION['logueado']=1;
                $_SESSION['usuario']=$valUsuario;
                header ("Location: IndexInicio.php");
            } else {
                header ("Location: IndexLogin.php?error=datos");
            }
        } else {
            header ("Location: IndexLogin.php?error=vacio");
        }
    }
?>