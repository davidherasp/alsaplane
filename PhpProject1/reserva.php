<?php
include("modelo.php");
session_start();

$modelo = new Modelo();
//Con el idVuelo que pasamos en la URL consultamos todos los datos
$vuelo = $modelo->selectVuelo($_GET['idVuelo']);

$_SESSION['idVuelo'] = $vuelo['idVuelo'];
$_SESSION['idAvion']= $vuelo['idAvion'];
$_SESSION['origen'] = $vuelo['origen'];
$_SESSION['destino'] = $vuelo['destino'];
$_SESSION['fechaVuelo'] = $vuelo['fechaVuelo'];
$_SESSION['precioV'] = $vuelo['precioV'];

//Una vez que tenemos el idAvion podemos saber sus asientos
$avion = $modelo->selectAsientosAvion($_SESSION['idAvion']);

$modeloAvion = $avion['modelo'];
$numAsientosTotalesAvion = $avion['numAsientos'];


//Comprobamos las reservas que hay para un el idVuelo
$asientosReservados = $modelo ->selectNumerosAsientosVuelo($_SESSION['idVuelo']);
$nAsientosReservados = count($asientosReservados);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
        <h4>Origen: <?php echo $_SESSION['origen']?></h4>
        <h4>Destino: <?php echo $_SESSION['destino']?></h4>
        <h4>Fecha del vuelo: <?php echo $_SESSION['fechaVuelo']?></h4>
        <h4>Precio: <?php echo $_SESSION['precioV']?></h4>
        <h4>Avión: <?php echo $_SESSION['idAvion']?></h4>
        <h4>Modelo: <?php echo $modeloAvion?></h4>
        <h4>Asientos totales: <?php echo $numAsientosTotalesAvion?></h4>
        <h4>Numero total de asientos reservados: <?php echo $nAsientosReservados?></h4>
        
       
        <table>
            <tr>
            <?php 
            
            for(    $i=1;   $i<=$numAsientosTotalesAvion;   $i++) {
                
                if(!$asientosReservados==NULL)
                {
                    foreach ($asientosReservados as $ar) {
                        if($i == $ar['asiento'])//Ocupado
                        {
                            ?><td><img src="css/images/butacaRoja.png"/></td><?php
                            if($i % 3 == 0){
                                ?><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php
                             } 
                            if($i % 6 == 0){
                                ?></tr><?php
                             }
                            $i++;
                        }
                    }
                
                }
                ?><td><a href=resumenReserva.php?idVuelo=<?php echo $_SESSION['idVuelo']?>&asiento=<?php echo $i?>><img src="css/images/butacaVerde.png"/></a></td><?php
                if($i % 3 == 0){
                    ?><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php
                         }
                if($i % 6 == 0){
                    ?></tr><?php
                }
                
            }?>   
            
                
        </table>        
        
        
        
        
    </body>
</html>