<?php
include("modelo.php");
$modelo = new Modelo();
$enum = $modelo -> selectEnumValues("clientes","tipoCli");

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro cliente</title>
    </head>
    <body>
        <form action="insertCliente.php" method="POST">
            
            Nombre: <input type="text" name="nombreCli"><br/>
            DNI: <input type="text" name="dni"><br/>
            E-mail: <input type="text" name="emailCli"><br/>
            Fecha nacimiento <input type="date" name="fechaNacCli"><br/>
            Password: <input type="password" name="password"><br/>
            Tipo de cuenta:
            <select name="tipoCli">
                <?php 
                foreach ($enum as $e){
                    ?><option value="<?php echo $e?>"><?php echo $e?><?php
                }

                ?>
            </select>

            <input type="submit" value="Enviar">
        </form>
        
    </body>
</html>



