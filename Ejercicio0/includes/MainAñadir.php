<main style="text-align:center" class="marco">
    <?php require 'includes/Registrar.php'; ?>

    <h2><i><b>Datos de usuario</b></i></h2>

    <!-- El formulario recoge los datos introducidos en los campos y se traspasan al script del archivo antes llamado. -->
    <form action="Añadir.php" method="post" enctype="multipart/form-data">
        Nombre 
        <br><input type="text" name="nombre"
            <?php
                if(isset($_POST["nombre"])){
                    echo "value='{$_POST["nombre"]}'";
                }
            ?>
        /><br><br>

        <!-- Si el valor introducido no es válido, se llama al método que así lo indica. -->
        <?php echo alertar($fallos, "nombre"); ?>

        Apellidos 
        <br><input type="text" name="apellidos"
            <?php
                if(isset($_POST["apellidos"])){
                    echo "value='{$_POST["apellidos"]}'";
                }
            ?>
        /><br><br>

        <?php echo alertar($fallos, "apellidos"); ?>

        Biografía 
        <br><textarea name="biografia">
            <?php
                if(isset($_POST["biografia"])){
                    echo $_POST["biografia"];
                }
            ?>
        </textarea><br><br>

        <?php echo alertar($fallos, "biografia"); ?>

        E-mail 
        <br><input type="email" name="email"
            <?php
                if(isset($_POST["email"])){
                    echo "value='{$_POST["email"]}'";
                }
            ?>
        /><br><br>

        <?php echo alertar($fallos, "email"); ?>

        Contraseña 
        <br><input type="password" name="contrasena"
            <?php
                if(isset($_POST["contrasena"])){
                    echo "value='{$_POST["contrasena"]}'";
                }
            ?>
        /><br><br>

        <?php echo alertar($fallos, "contrasena"); ?>

        Imagen — 
        <input type="file" name="imagen"/>
        <?php echo alertar($fallos, "imagen"); ?><br><br>

        <input type="submit" value="Enviar" name="submit"/>
    </form><br>

    <!-- Este enlace devuelve a la tabla de usuarios, véase la página principal. -->
    <a style="color: #BC1717" href="Index.php"> Listar usuarios </a>
</main><br>