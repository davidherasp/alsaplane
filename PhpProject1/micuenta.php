<?php

session_start();
include("modelo.php");

$modelo = new Modelo();
$dni = $_SESSION['dni'];

$reservas = $modelo->selectReservasFromCliente($dni);
$enum = $modelo -> selectEnumValues("clientes","tipoCli");
?><html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
if ($reservas != NULL) {
        ?>
            <h1>Mis reservas</h1>
            <table>
            <tr>
                <th>Identificador</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Asiento</th>
                <th>Precio</th>
            </tr>
            <?php 
            foreach ($reservas as $r) {
                
                //Creamos la url para cada vuelo
                $urlModificar = "modificarReserva.php?idVuelo=".$r['idVuelo'];
                $urlEliminar = "eliminarReserva.php?idVuelo=".$r['idVuelo'];
                $urlImprimir = "imprimirReserva.php?idVuelo=".$r['idVuelo'];
                ?>
            
            <tr>
                
                    <td><?php echo $r['idVuelo']?></td>
                    <td><?php echo $r['origen']?></td>
                    <td><?php echo $r['destino']?></td>
                    <td><?php echo $r['fechaVuelo']?></td>
                    <td><?php echo $r['asiento']?></td>
                    <td><?php echo $r['precioR']?></td>
                    <td><a href="<?php echo $urlModificar ?>"><button  name = "btnModificar" value="Modificar">Modificar</button></a></td>
                    <td><a href="<?php echo $urlEliminar ?>"><button  name = "btbnEliminar" value="Eliminar" onclick="return confirm('¿Realmente desea eliminar la reserva?')">Eliminar</button></a></td>
                    <td><a href="<?php echo $urlImprimir ?>"><button  name = "btbnImprimir" value="Imprimir">Imprimir</button></a></td>
                    
            </tr>
                 <?php    
            }
            ?>
            </table>
            <?php 
        
    
    
} else {
    
    //No tiene reservas
}?>

            <h1>Mis datos</h1>
            <form action="updateUsuario.php" method="POST">
            
            Nombre: <input type="text" name="nombreCli" value="<?php echo $_SESSION['nombreCli']?>" readonly="readonly"><br/>
            DNI: <input type="text" name="dni" value="<?php echo $_SESSION['dni']?>" readonly="readonly"><br/>
            E-mail: <input type="text" name="emailCli" value="<?php echo $_SESSION['emailCli']?>"><br/>
            Fecha nacimiento <input type="date" name="fechaNacCli" value="<?php echo $_SESSION['fechaNacCli']?>" readonly="readonly"><br/>
            Password: <input type="password" id="password" name="password" value="<?php echo $_SESSION['password']?>">
            <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show password<br/>
            Tipo de cuenta:
            <select name="tipoCli">
                <?php 
                foreach ($enum as $e){
                    ?><option value="<?php echo $e?>"><?php echo $e?><?php
                }

                ?>
            </select>

            <br/><input type="submit" value="Actualizar">
        </form>
        


</body>
</html>        
    






