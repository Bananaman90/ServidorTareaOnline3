<?php
    $valUsuario="bananaman";
    $valContrasena="banana";
    
    if(isset($_POST['submit'])) {
        if((isset($_POST['usuario']) && isset($_POST['contrasena'])) && ((!empty($_POST['usuario'])) && (!empty($_POST['usuario'])))) {
            if($_POST['usuario']==$valUsuario && $_POST['contrasena']==$valContrasena) {
                session_start();
                $_SESSION['logueado']=1;
                $_SESSION['usuario']=$valUsuario;

                if(isset($_POST['recordar']) && ($_POST['recordar']=="on")) {
                    setcookie('usuario', $_POST['usuario'], time()+(15*24*60*60));
                    setcookie('contrasena', $_POST['contrasena'], time()+(15*24*60*60));
                } else {
                    if(isset($_COOKIE['usuario'])) {
                        setcookie('usuario', ""); 
                    }
                    
                    if(isset($_COOKIE['contrasena'])) {
                        setcookie('contrasena', ""); 
                    }
                }

                header ("Location: IndexInicio.php");
            } else {
                header ("Location: IndexLogin.php?error=datos");
            }
        } else {
            header ("Location: IndexLogin.php?error=vacio");
        }
    }
?>