<?php
    $dbHost='localhost';
    $dbName='bdusuarios';
    $dbUser='root';
    $dbPass='';

    // Se intenta realizar la conexión con la base de datos asignada previamente.
    try {
        $conexion=new PDO("mysql:host=$dbHost; dbname=$dbName", $dbUser, $dbPass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Si existe un número de página, se toma el primer número de filas indicadas como inicio de página.
        $pagina=isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $filasPagina=3;
        $inicio=($pagina>1) ? ($pagina*$filasPagina-$filasPagina) : 0;

        // Se seleccionan las filas de la tabla limitadas por el número de páginas y filas asignado previamente.
        $sql=$conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM usuarios LIMIT $inicio, $filasPagina;");
        $sql->execute();
        $sql=$sql->fetchAll();

        // De no poder realizarse la conexión, mostrará igualmente el índice de página inicial.
        if(!$sql) {
            header('Location: Index.php');
        }

        // Se recogen el número de filas que, divididas por el total de filas, permitirá asignar un número de página por cantidad.
        $totalFilas=$conexion->query('SELECT FOUND_ROWS() as total');
        $totalFilas=$totalFilas->fetch()['total'];
        $numPagina=ceil($totalFilas/$filasPagina);

        // Si la conexión anterior se realiza, se mostrará en pantalla si la conexión se ha realizado o no.
        if($totalFilas) {
            echo '<div class="alert alert-success">'."La consulta se realizó correctamente!! :)".'</div>';
        } else {
            echo '<div class="alert alert-danger">'."La consulta no pudo realizarse correctamente!! :(".'</div>';
        }
    // En caso contrario, mostrará un mensaje de error indicando que no ha sido posible realizar la conexión.
    } catch(PDOException $error) {
        echo '<div class="alert alert-danger" style="text-align:center">'."No se pudo conectar a la BD de usuarios!! :(<br/>"
                .$error->getMessage().'</div>'; 
    }
?>