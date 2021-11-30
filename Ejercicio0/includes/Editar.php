<?php
    $dbHost='localhost';
    $dbName='bdusuarios';
    $dbUser='root';
    $dbPass='';

    // Se intenta realizar la conexión con la base de datos asignada previamente.
    try {
        $conexion=new PDO("mysql:host=$dbHost; dbname=$dbName", $dbUser, $dbPass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Estas variables servirán para almacenar los valores tanto a mostrar al principio como luego actualizados.
        $valNombre="";
        $valApellidos="";
        $valEmail="";
        $valImagen="";

        // Una vez se pulse el botón de actualizar, se introducen los nuevos valores en nuevas variables.
        if(isset($_POST['datos'])) {      
            $id=$_POST['id'];
            $nuevoNombre=$_POST['nombre'];
            $nuevoApellidos=$_POST['apellidos'];
            $nuevoEmail=$_POST['email'];
            $nuevoImagen;

            // Si existe una imagen que no está vacía, se cargará la nueva imagen a la variable asignada.
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
                    $nuevoImagen=$nombreImagen;
                }

                // Si por lo que fuese no se carga la imagen bien, el programa lo avisará.
                if($moverImagen) {
                    $imagenCargada=true;
                } else {
                    $imagenCargada=false;
                    $fallos["imagen"]="Error: La imagen no se cargó correctamente! :(";
                }
            }

            // Se conecta a la base de datos para actualizar la tabla del usuario según su ID con los nuevos datos actualizados.
            $sql="UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, email=:email, imagen=:imagen WHERE id=:id;";
            $query=$conexion->prepare($sql);
            $query->execute(['id'=>$id, 'nombre'=>$nuevoNombre, 'apellidos'=>$nuevoApellidos, 'email'=>$nuevoEmail, 
                                'imagen'=>$nuevoImagen]);

            // Si se lleva a cabo la actualización o no, se indicará en pantalla.
            if($query) {
                echo '<div class="alert alert-success">'."El usuario se actualizó correctamente!! :)".'</div>';
            } else {
                echo '<div class="alert alert-danger">'."El usuario no pudo actualizarse!! :(".'</div>';
            }

            // A las variables declaradas inicialmente se les asigna las recogidas para actualizar los datos.
            $valNombre=$nuevoNombre;
            $valApellidos=$nuevoApellidos;
            $valEmail=$nuevoEmail;
            $valImagen=$nuevoImagen;

            // Todas las variables a continuación permiten actualizar la base de datos de logs con la operación realizada.
            $operacion="Usuario actualizado";

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

        // Si se detecta una ID numérica, se seleccionan todos los datos de la tabla de usuarios que coincidan con la ID.
        if(isset($_GET['id']) && (is_numeric($_GET['id']))) {
            $id=$_GET['id'];

            $sql="SELECT * FROM usuarios WHERE id=:id;";
            $query=$conexion->prepare($sql);
            $query->execute(['id'=>$id]);

            // Si la selección es correcta, se asignan los valores a las variables iniciales para mostrarlas en pantalla.
            if($query) {
                echo '<div class="alert alert-success">'."Los datos del usuario se obtuvieron correctamente!! :)".'</div>';
                $fila=$query->fetch(PDO::FETCH_ASSOC);

                $valNombre=$fila['nombre'];
                $valApellidos=$fila['apellidos'];
                $valEmail=$fila['email'];
                $valImagen=$fila['imagen'];
            } else {
                echo '<div class="alert alert-danger">'."No se pudieron obtener los datos de usuario!!:(".'</div>';
            }
        }
    // En caso contrario, mostrará un mensaje de error indicando que no ha sido posible realizar la conexión.
    } catch(PDOException $error) {
        echo '<div class="alert alert-danger" style="text-align:center">'."No se pudo conectar a la BD de usuarios!! :(<br/>"
                .$error->getMessage().'</div>'; 
    }
?>