<?php
    $dbHost='localhost';
    $dbName='bdusuarios';
    $dbUser='root';
    $dbPass='';

    // Se intenta realizar la conexión con la base de datos asignada previamente.
    try {
        $conexion=new PDO("mysql:host=$dbHost; dbname=$dbName", $dbUser, $dbPass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        validar($fallos); // Se llama al método que valida posibles fallos antes de asignarlos a la base de datos.

        // Si se pulsa el botón y el método anterior no recoge ningún falo, asignará los datos a las variables correspondientes.
        if(isset($_POST["submit"]) && validar($fallos)==true) {
            $nombre=$_POST["nombre"];
            $apellidos=$_POST["apellidos"];
            $biografia=$_POST["biografia"];
            $email=$_POST["email"];
            $contrasena=sha1($_POST["contrasena"]);
            $imagen=$_FILES["imagen"]["tmp_name"];

            // Si existe una imagen que no está vacía, se cargará la imagen a la variable asignada.
            if(isset($_FILES["imagen"]) && (!empty($_FILES["imagen"]["tmp_name"]))) {
                // Si no existe un directorio donde guardar las imágenes, se creará uno.
                if(!is_dir("imagenes")) {
                    $dir=mkdir("imagenes", 0777, true);
                } else {
                    $dir=true;
                }

                // Si existe el directorio, se moverá el archivo a éste y se asignará a la variable en cuestión.
                if($dir) {
                    $nombreImagen=time()." — ".$_FILES["imagen"]["name"];
                    $moverImagen=move_uploaded_file($_FILES["imagen"]["tmp_name"], "imagenes/".$nombreImagen);
                    $imagen=$nombreImagen;
                }

                // Si por lo que fuese no se carga la imagen bien, el programa lo avisará.
                if($moverImagen) {
                    $imagenCargada=true;
                } else {
                    $imagenCargada=false;
                    $fallos["imagen"]="Error: La imagen no se cargó correctamente! :(";
                }
            }

            // Se conecta a la base de datos para insertar en la tabla del usuario según su ID los datos recogidos.
            $stmt="INSERT INTO usuarios VALUES (NULL, :nombre, :apellidos, :biografia, :email, :contrasena, :imagen);";

            $query=$conexion->prepare($stmt);

            $query->execute(['nombre'=>$nombre, 'apellidos'=>$apellidos, 'biografia'=>$biografia, 'email'=>$email, 
                                    'contrasena'=>$contrasena, 'imagen'=>$imagen]);

            // Si se lleva a cabo el registro o no, se indicará en pantalla.
            if($query) {
                echo '<div class="alert alert-success" style="text-align:center">'."El usuario se registró correctamente!! :)".'</div>';
            } else {
                echo '<div class="alert alert-success" style="text-align:center">'."El usuario no pudo registrarse!! :(".'</div>';
            }

            // Todas las variables a continuación permiten actualizar la base de datos de logs con la operación realizada.
            $operacion="Usuario añadido";

            $fecha=getdate();

            $horas=$fecha['hours'];
            $minutos=$fecha['minutes'];
            $hora=$horas.":".$minutos;

            $dia=$fecha['mday'];
            $mes=$fecha['mon'];
            $ano=$fecha['year'];
            $fechaActual=$dia."-".$mes."-".$ano;
            
            $stmt2="INSERT INTO logs VALUES (NULL, :operacion, :hora, :fecha);";

            $query2=$conexion->prepare($stmt2);

            $query2->execute(['operacion'=>$operacion, 'hora'=>$hora, 'fecha'=>$fechaActual]);
        }
    // En caso contrario, mostrará un mensaje de error indicando que no ha sido posible realizar la conexión.
    } catch(PDOException $error) {
        echo '<div class="alert alert-danger" style="text-align:center">'."No se pudo conectar a la BD de usuarios!! :(<br/>"
                .$error->getMessage().'</div>'; 
    }
?>