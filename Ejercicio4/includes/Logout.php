<?php
    session_start(); // Se invoca al método relativo a la sesión iniciada.
    session_unset(); // Se desactivan los datos que permiten iniciar sesión...
    session_destroy(); // ...y se destruyen, acabando así con la sesión.
    header("location:../IndexLogin.php"); // Se envía al usuario directamente de vuelta a la página de login.
?>