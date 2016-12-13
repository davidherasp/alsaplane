<?php
include("modelo.php"); //Con la ruta donde esta
session_start();


$idVuelo    = $_SESSION['idVuelo'];
$idCliente  = $_SESSION['dni'];
$precioR    = $_SESSION['precioV'];
$asiento    = $_SESSION['asiento'];
$tipoCli    = $_SESSION['tipoCli'];

//Hacemos la rebaja del precio si el tipo del cliente es premium.
if(strcmp($tipoCli,"premium")==0){
    $precioR = $precioR * 0.9;
}

echo '--->'.$idVuelo.'-'.$idCliente.'-'.$precioR.'-'.$asiento;

$modelo = new Modelo();
$result = $modelo->insertReserva($idVuelo,$idCliente,$precioR,$asiento);

//window.location.href='resumenReserva.php';
//window.location.href='index.php';

if($result != NULL){
    
    //Muestro alert reserva confirmada
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Se ha realizado la reserva con éxito')
                        window.location.href='index.php';
                    </SCRIPT>");
                $_SESSION['confirmacionReserva'] = "true";
}else{
    
    //Muestro alert
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Se ha producido un error al realizar la reserva')
                        window.location.href='index.php';
                    </SCRIPT>");
    
}

?>        