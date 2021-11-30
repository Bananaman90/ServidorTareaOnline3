<?php
    $dbHost='localhost';
    $dbName='bdusuarios';
    $dbUser='root';
    $dbPass='';
    
    // Se intenta realizar la conexión con la base de datos asignada previamente.
    try {
        $conexion=new PDO("mysql:host=$dbHost; dbname=$dbName", $dbUser, $dbPass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Si se detecta una ID numérica, se seleccionan todos los datos de la tabla de usuarios que coincidan con la ID.
        if(isset($_GET['id']) && (is_numeric($_GET['id']))) {
            $id=$_GET['id'];
            
            $sql="SELECT * FROM usuarios WHERE id=:id;";
            $query=$conexion->prepare($sql);
            $query->execute(['id'=>$id]);
        }
    // En caso contrario, mostrará un mensaje de error indicando que no ha sido posible realizar la conexión.
    } catch(PDOException $error) {
        echo '<div class="alert alert-danger" style="text-align:center">'."No se pudo conectar a la BD de usuarios!! :(<br/>"
                .$error->getMessage().'</div>'; 
    }
?>