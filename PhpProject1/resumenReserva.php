<?php
include("modelo.php"); //Con la ruta donde esta
session_start();

$modelo = new Modelo();
//Con el idVuelo que pasamos en la URL consultamos todos los datos
$vuelo = $modelo->selectVuelo($_GET['idVuelo']);

$_SESSION['idVuelo']    = $vuelo['idVuelo'];
$_SESSION['idAvion']    = $vuelo['idAvion'];
$_SESSION['origen']     = $vuelo['origen'];
$_SESSION['destino']    = $vuelo['destino'];
$_SESSION['fechaVuelo']    = $vuelo['fechaVuelo'];
$_SESSION['precioV']    = $vuelo['precioV'];

$nombreCli  = $_SESSION['nombreCli'];
$dni        = $_SESSION['dni'];
$tipoCli    = $_SESSION['tipoCli'];

$_SESSION['asiento']    = $_GET['asiento'];


?>        
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        
        //Comprobamos si existe la variable de sesion nombreCli
        //Que nos indica si ya se ha registrado el cliente
        if (isset($_SESSION['nombreCli'])) {
            ?>
                
                <p>Nombre Cliente: <?php echo $nombreCli?></p>
                <p>DNI: <?php echo $dni?></p>
                <p>Tipo Cliente: <?php echo $tipoCli?></p>
                <p>ID Avion: <?php echo $_SESSION['idAvion']?></p>
                <p>ID Vuelo: <?php echo $_SESSION['idVuelo']?></p>
                <p>Origen: <?php echo $_SESSION['origen']?></p>
                <p>Destino: <?php echo $_SESSION['destino']?></p>
                <p>Fecha: <?php echo $_SESSION['fechaVuelo']?></p>
                <p>Asiento: <?php echo $_SESSION['asiento']?></p>
                
                <?php 
                
                    if(strcmp($tipoCli, "premium")==0){//SI EL CLIENTE ES DE TIPO PREMIUM       
                        ?><p>Precio especial premium (-10%): <?php echo $_SESSION['precioV']*0.9?></p><?php
                    }else{
                        ?><p>Precio: <?php echo $_SESSION['precioV']?></p><?php
                    }
                ?>
                    <a href="confirmarReserva.php"><button  name = "confirmarReserva" value="Confirmar">Confirmar</button></a>
            <?php
                    
        }else{
                //Muestro alert
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Para hacer una reserva tiene que registrarse')
                        window.location.href='acceso.html';
                    </SCRIPT>");
        }?>

    </body>
</html>
