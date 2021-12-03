<?php
    session_start(); // Se inicia la sesión en base a los datos recogidos en el archivo Conexion.php.
    
    // Si no existiera una sesión iniciada, sea de forma normal o con cookies, devuelve a la página de login avisando del intento de acceso no autorizado.
    if(!isset($_SESSION['logueado']) && (!isset($_COOKIE['abierta']))) {
        header ("Location: IndexLogin.php?error=fuera");
    }
?>