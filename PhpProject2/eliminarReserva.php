<?php
session_start();
include("modelo.php");

$idReserva = $_GET['idReserva'];

echo '--->'.$idReserva;
$modelo = new Modelo();
$result = $modelo->eliminarReserva($idReserva);

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