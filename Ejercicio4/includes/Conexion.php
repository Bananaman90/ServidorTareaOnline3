<?php
    // En estas variables se almacenan los datos para realizar correctamente el login.
    $valUsuario="bananaman";
    $valContrasena="banana";
    
    // Si se pulsa el botón de Enviar...
    if(isset($_POST['submit'])) {
        // ...los campos han sido rellenados...
        if((isset($_POST['usuario']) && isset($_POST['contrasena'])) && ((!empty($_POST['usuario'])) && (!empty($_POST['usuario'])))) {
            // ...y los valores se corresponden a los de las variables...
            if($_POST['usuario']==$valUsuario && $_POST['contrasena']==$valContrasena) {
                session_start(); // Se inicia la sesión.
                $_SESSION['logueado']=$_POST['usuario']; // Asignando a dicha sesión el nombre del usuario.
                $_SESSION['usuario']=$_POST['usuario'];

                // Si se ha pinchado la casilla de Recuérdame se asignan cookies a los campos correspondientes.
                if(isset($_POST['recordar']) && ($_POST['recordar']=="on")) {
                    setcookie('usuario', $_POST['usuario'], time()+(15*24*60*60)); // Un tiempo de quince días, veinticuatro horas, sesenta minutos y sesenta segundos.
                    setcookie('contrasena', $_POST['contrasena'], time()+(15*24*60*60));
                    setcookie('recordar', $_POST['recordar'], time()+(15*24*60*60));
                // De lo contrario se buscan dichas cookies y se asignan valores vacíos para eliminarlas.
                } else {
                    if(isset($_COOKIE['usuario'])) {
                        setcookie('usuario', ""); 
                    }
                    
                    if(isset($_COOKIE['contrasena'])) {
                        setcookie('contrasena', ""); 
                    }

                    if(isset($_COOKIE['recordar'])) {
                        setcookie('recordar', ""); 
                    }
                }

                // Del mismo modo se comprueba si se ha pinchado en la casilla de Mantener la sesión abierta para asignarle una cookie.
                if(isset($_POST['abierta']) && ($_POST['abierta']=="on")) {
                    setcookie('abierta', $_POST['usuario'], time()+(15*24*60*60));
                } else {
                    if(isset($_COOKIE['abierta'])) {
                        setcookie('abierta', ""); 
                    }
                }

                // Iniciada la sesión, pedimos que nos lleve a la página de inicio.
                header ("Location: IndexInicio.php");
            } else {
                // De no iniciarse correctamente, nos devuelve a la página de login con un mensaje de error.
                header ("Location: IndexLogin.php?error=datos");
            }
        } else {
            // De pulsarse el botón sin rellenar los campos, nos devuelve a la página de login avisándonos sobre eso.
            header ("Location: IndexLogin.php?error=vacio");
        }
    }
?>