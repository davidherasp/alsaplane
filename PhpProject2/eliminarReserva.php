<?php
session_start();
include("modelo.php");

$idVuelo = $_GET['idVuelo'];
$idCliente = $_GET['idCliente'];

echo '--->'.$idVuelo." - ".$idCliente;
$modelo = new Modelo();
$result = $modelo->eliminarReserva($idVuelo, $idCliente);

if($result != NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha eliminado la reserva')
                    window.location.href='reservas.php';
           </SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Se ha producido un error al eliminar la reserva')
                    window.location.href='reservas.php';
           </SCRIPT>");
}