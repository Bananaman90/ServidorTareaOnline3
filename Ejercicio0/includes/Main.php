<main style="text-align:center" class="lista">
    <?php require 'includes/Listar.php'; ?>

    <h2><i><b>Lista de usuarios</b></i></h2>

    <table class="table table-striped">
        <tr>
            <th> Nombre </th>
            <th> Apellidos </th>
            <th> E-mail </th>
            <th> Imagen </th>
            <th> Operaciones </th>
        </tr>
        
        <?php
            // El bucle recorre toda la tabla de la base de datos, tomando los valores de cada una para asignarlos a la tabla previa.
            foreach($sql as $fila) {
                echo'<tr>';
                    echo'<td>'.$fila['nombre'].'</td>';
                    echo '<td>'.$fila['apellidos'].'</td>';
                    echo'<td>'.$fila['email'].'</td>';
    
                    // Si la fila de imagen no está vacía, mostrará tanto su nombre como una versión en miniatura de ésta.
                    if($fila['imagen']!=null){
                        echo '<td><img src="imagenes/'.$fila['imagen'].'" width="40"/><br>'.$fila['imagen'].'</td>';
                    }
                    
                    // Estos tres botones permitirán acceder a las operaciones trasladando consigo el usuario correspondiente.
                    echo'<td>'.'<a style="color: #BC1717" href="Actualizar.php?id='.$fila['id'].'"> Editar </a>
                    &emsp;<a style="color: #BC1717" href="Eliminar.php?id='.$fila['id'].'"> Eliminar </a>
                    <br/><a style="color: #BC1717" href="Detalles.php?id='.$fila['id'].'"> Detalles </a>'.'</td>';
                echo'</tr>';
            }
        ?>
    </table>

    <section>
        <nav aria-label="Page navigation example">
            <ul class="pagination" style="justify-content:center">
                <!-- Si la página es la primera, el botón de previo no funcionará, sino llevará al número de página anterior. -->
                <?php if($pagina==1) { ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="page-item active">
                        <a class="page-link" href="?pagina=<?php echo $pagina-1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php } ?>

                <!-- El bucle recorre las páginas que surjan según la extensión de la tabla, con sus botones correspondientes. -->
                <?php
                    for($i=1; $i<=$numPagina; $i++) {
                        if($pagina==$i) {
                            echo "<li class='page-item active'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                        }
                    }
                ?>

                <!-- Si la página es la última, el botón de siguiente no funcionará, sino llevará al número de página posterior. -->
                <?php if($pagina==$numPagina) { ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#!" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="page-item active">
                        <a class="page-link" href="?pagina=<?php echo $pagina+1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </section>

    <!-- Estos enlaces llevan a otras opciones para interactuar con la tabla: añadirle usuarios o imprimirla como PDF. -->
    <a style="color: #BC1717" href="Añadir.php"> Añadir usuarios </a><br>
    <a style="color: #BC1717" href="GenerarPDF.php" target="blank"> Generar PDF </a>
</main><br>