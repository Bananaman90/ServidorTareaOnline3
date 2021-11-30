<!DOCTYPE HTML>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <title> Ejercicio 11 </title>
    </head>
    
    <body>
        <div style="text-align:center" class="lista">
            <h1> EJERCICIO 11 </h1>

            <?php require 'includes/ListarPDF.php'; ?>

            <h2><i><b>Lista de usuarios</b></i></h2>

            <table border="1" style="justify-content:center">
                <tr>
                    <th> Nombre </th>
                    <th> Apellidos </th>
                    <th> E-mail </th>
                    <th> Imagen </th>
                </tr>
                
                <?php
                    // El bucle recorre toda la tabla de la base de datos, tomando los valores de cada una para asignarlos a la tabla previa.
                    foreach($resultsquery as $fila) {
                        echo'<tr>';
                            echo'<td>'.$fila['nombre'].'</td>';
                            echo '<td>'.$fila['apellidos'].'</td>';
                            echo'<td>'.$fila['email'].'</td>';

                            if($fila['imagen']!=null){
                                echo '<td>'.$fila['imagen'].'</td>';
                            }
                        echo'</tr>';
                    }
                ?>
            </table><br>

            <b> Desarrollo Web en Entorno Servidor - Tarea Online U2 </b>
        </div>
    </body>
</html>

<style type="text/css">
    .lista {
        border-radius: 10px;
        width: 600px;
        border: 7px solid #BC1717;
        margin: auto;
        padding: 10px;
        background-color: #C7CBD3;
        font-family: 'Times';
        font-size: large;
    }
</style>