<?php
    $fallos=[]; // En este array se recogen los mensajes de fallos que se mostrarán si los datos ingresados no son válidos.
    $nombre="";
    $apellidos="";
    $biografia="";
    $email="";
    $contrasena="";

    // Esta función devolverá un mensaje de alerta con el fallo en cuestión si se detecta.
    function alertar($fallos, $dato){
        $alerta="";

        if(isset($fallos[$dato]) && !empty($dato)){
            $alerta='<div class="alert alert-danger">'.$fallos[$dato].'</div>';
        }

        return $alerta;
    }

    // Esta función filtrará la sintaxis del dato introducido, permitiendo carácteres especiales entre otros.
    function filtrar($datos){
        $datos=trim($datos);
        $datos=stripslashes($datos);
        $datos=htmlspecialchars($datos);

        return $datos;
    }

    // Esta función validará el formulario cuando se pulse el botón de registrar, siempre que el array de fallos esté vacío.
    function validar($fallos){
        if(isset($_POST["submit"]) && count($fallos)==0){
            return true;
        } else {
            return false;
        }
    }

    // Cuando se pulse el botón de registrar, se evaluará para cada campo una serie de condiciones que lo validen.
    if(isset($_POST["submit"])) {
        if(!empty($_POST["nombre"]) && !is_numeric($_POST["nombre"]) && strlen($_POST["nombre"])<=20) {
            $nombre=filtrar($_POST["nombre"]);
            $nombre=filter_var($nombre, FILTER_SANITIZE_STRING);
        } else if(is_numeric($_POST["nombre"])) {
            $fallos["nombre"]="El nombre no debe ser numérico.";
        } else if(!strlen($_POST["nombre"])<=20) {
            $fallos["nombre"]="El nombre debe tener menos de 20 caracteres.";
        } else {
            $fallos["nombre"]="No se puede dejar este campo en blanco.";
        }

        if(!empty($_POST["apellidos"]) && !is_numeric($_POST["apellidos"])) {
            $apellidos=filtrar($_POST["apellidos"]);
            $apellidos=filter_var($apellidos, FILTER_SANITIZE_STRING);
        } else if(is_numeric($_POST["apellidos"])) {
            $fallos["apellidos"]="Los apellidos no deben ser numéricos.<br/>";
        } else {
            $fallos["apellidos"]="No se puede dejar este campo en blanco.<br/>";
        }

        if(strlen(trim($_POST["biografia"]))) {
            $biografia=filtrar($_POST["biografia"]);
        } else {
            $fallos["biografia"]="No se puede dejar este campo en blanco.<br/>";
        }

        if(!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        } else {
            $fallos["email"]="No se puede dejar este campo en blanco.<br/>";
        }

        if(!empty($_POST["contrasena"]) && strlen($_POST["contrasena"])>=6) {
            $contrasena=sha1($_POST["contrasena"])."<br/>";
        } else if(!strlen($_POST["contrasena"])>=6) {
            $fallos["contrasena"]="La contraseña debe tener más de 6 caracteres.<br/>";
        } else {
            $fallos["contrasena"]="No se puede dejar este campo en blanco.<br/>";
        }

        if(!isset($_FILES["imagen"]) || empty($_FILES["imagen"]["tmp_name"])) {
            $fallos["imagen"]="No se ha subido ninguna imagen.";
        }
    }
?>