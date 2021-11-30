<?php
    session_start();
    
    if(!isset($_SESSION['logueado'])) {
        header ("Location: IndexLogin.php?error=fuera");
    }
?>